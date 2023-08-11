<?php

namespace Kumi\Kanri\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Section;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Kumi\Kanri\Filament\Resources\TicketResource\Pages;
use Kumi\Kanri\Filament\Resources\TicketResource\Pages\ViewTicket;
use Kumi\Kanri\Filament\Resources\TicketResource\Pipelines\Query\CheckForHumanCapitalTicket;
use Kumi\Kanri\Filament\Resources\TicketResource\Pipelines\Query\CheckForLeaveRequestTicket;
use Kumi\Kanri\Filament\Resources\TicketResource\Pipelines\Query\DumpQueryWithBindings;
use Kumi\Kanri\Filament\Resources\TicketResource\RelationManagers;
use Kumi\Kanri\Filament\Resources\TicketResource\Schemas\InteractsWithLeaveRequestSchemas;
use Kumi\Kanri\Filament\Resources\TicketResource\Schemas\InteractsWithSalaryAdvanceSchemas;
use Kumi\Kanri\Models\Ticket;
use Kumi\Kanri\Support\DefaultPermissions;
use Kumi\Kiosk\Actions\CalculateAge;
use Kumi\Kiosk\Models\TicketCategory;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Livewire\Component as Livewire;

class TicketResource extends Resource
{
    use InteractsWithSalaryAdvanceSchemas;
    use InteractsWithLeaveRequestSchemas;

    protected static ?string $modelLabel = 'Ticket';

    protected static ?string $model = Ticket::class;

    protected static ?string $navigationGroup = 'kanri';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 8001;

    protected static ?string $slug = 'kanri/tickets';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(3)
                ->schema([
                    self::getEmployeeInformationSchema(),
                    self::getCommonTicketSchema(),
                    self::getSalaryAdvanceSidebarSchema(),
                    self::getSalaryAdvanceRecommendationSchema(),
                    self::getSalaryAdvanceApprovalSchema(),
                    self::getLeaveRequestSidebarSchema(),
                    self::getLeaveRequestRecommendationSchema(),
                    self::getLeaveRequestApprovalSchema(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('kiosk::filament/resources/ticket.columns.id.label')),
                Tables\Columns\TextColumn::make('employee.user.name')
                    ->label(__('kiosk::filament/resources/ticket.columns.employee.label'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->label(__('kiosk::filament/resources/ticket.columns.category.label'))
                    ->formatStateUsing(function (?Model $state) {
                        return __('kiosk::filament/resources/ticket-category.labels.' . $state->slug);
                    }),
                Tables\Columns\TextColumn::make('childCategory')
                    ->label(__('kiosk::filament/resources/ticket.columns.child_category.label'))
                    ->formatStateUsing(function (?Model $state) {
                        return __('kiosk::filament/resources/ticket-category.labels.' . $state->slug);
                    }),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('kiosk::filament/resources/ticket.columns.status.label'))
                    ->enum([
                        TicketStatus::PENDING => __('kiosk::filament/resources/ticket.statuses.' . TicketStatus::PENDING),
                        TicketStatus::APPROVED => __('kiosk::filament/resources/ticket.statuses.' . TicketStatus::APPROVED),
                        TicketStatus::REJECTED => __('kiosk::filament/resources/ticket.statuses.' . TicketStatus::REJECTED),
                        TicketStatus::RESOLVED => __('kiosk::filament/resources/ticket.statuses.' . TicketStatus::RESOLVED),
                        TicketStatus::UNDER_REVIEW => __('kiosk::filament/resources/ticket.statuses.' . TicketStatus::UNDER_REVIEW),
                    ])
                    ->colors([
                        'warning' => TicketStatus::PENDING,
                        'success' => TicketStatus::APPROVED,
                        'danger' => TicketStatus::REJECTED,
                        'primary' => TicketStatus::RESOLVED,
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('kiosk::filament/resources/ticket.columns.created_at.label'))
                    ->formatStateUsing(function (?Carbon $state) {
                        return $state->format('d F Y');
                    }),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            // 'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            // 'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->latest();

        if (Auth::user()->can(DefaultPermissions::VIEW_ANY_TICKETS)) {
            return $query;
        }

        return $query->where(function (Builder $query) {
            App::make(Pipeline::class)
                ->send($query)
                ->through([
                    CheckForHumanCapitalTicket::class,
                    CheckForLeaveRequestTicket::class,
                    // DumpQueryWithBindings::class,
                ])
                ->thenReturn()
            ;
        });
    }

    public static function getCommonTicketSchema(): Card
    {
        return Forms\Components\Card::make([
            Forms\Components\Select::make('category_id')
                ->label(__('kiosk::filament/resources/ticket.fields.category.label'))
                ->options(function () {
                    return TicketCategory::query()->parents()->pluck('label', 'id');
                })
                ->reactive()
                ->required()
                ->afterStateUpdated(function (\Closure $set) {
                    $set('child_category_id', null);
                }),
            Forms\Components\Select::make('child_category_id')
                ->label(__('kiosk::filament/resources/ticket.fields.child_category.label'))
                ->options(function (\Closure $get) {
                    $categoryId = $get('category_id');

                    return $categoryId ? TicketCategory::query()->withParent($categoryId)->pluck('label', 'id') : [];
                })
                ->reactive()
                ->disabled(function (\Closure $get) {
                    $categoryId = $get('category_id');

                    return $categoryId ? TicketCategory::query()->withParent($categoryId)->count() === 0 : true;
                })
                ->visible(function (Livewire $livewire, Component $component) {
                    if ($livewire instanceof ViewTicket) {
                        return $component->isDisabled();
                    }

                    return ! $component->isDisabled();
                })
                ->required(function (Livewire $livewire, Component $component) {
                    if ($livewire instanceof ViewTicket) {
                        return $component->isDisabled();
                    }

                    return ! $component->isDisabled();
                })
                ->afterStateUpdated(function (\Closure $set) {
                    $set('grand_child_category_id', null);
                }),
            Forms\Components\Select::make('grand_child_category_id')
                ->label(__('kiosk::filament/resources/ticket.fields.grand_child_category.label'))
                ->options(function (\Closure $get) {
                    $categoryId = $get('child_category_id');

                    return $categoryId ? TicketCategory::query()->withParent($categoryId)->pluck('label', 'id') : [];
                })
                ->reactive()
                ->disabled(function (\Closure $get) {
                    $categoryId = $get('child_category_id');

                    return $categoryId ? TicketCategory::query()->withParent($categoryId)->count() === 0 : true;
                })
                ->visible(function (Component $component) {
                    return ! $component->isDisabled();
                })
                ->required(function (Component $component) {
                    return ! $component->isDisabled();
                }),
            self::getSalaryAdvanceMainSchema(),
            self::getLeaveRequestMainSchema(),
            Forms\Components\Textarea::make('description')
                ->label(__('kiosk::filament/resources/ticket.fields.description.label'))
                ->columnSpan(3),
            Forms\Components\SpatieMediaLibraryFileUpload::make('attachments')
                ->label(__('kiosk::filament/resources/ticket.fields.attachments.label'))
                ->image()
                ->imageCropAspectRatio('3:2')
                ->imagePreviewHeight('256')
                ->imageResizeTargetWidth('1080')
                ->imageResizeTargetHeight('720')
                ->enableReordering()
                ->collection('attachments')
                ->multiple()
                ->columnSpan(3),
            Forms\Components\Placeholder::make('status')
                ->label(__('kiosk::filament/resources/ticket.fields.status.label'))
                ->view('kiosk::filament.resources.ticket.fields.status')
                ->content(function (?Model $record) {
                    return $record->status;
                }),
        ])->columns(3)->columnSpan(2);
    }

    protected static function getEmployeeInformationSchema(): Section
    {
        return Forms\Components\Section::make(__('kanri::filament/resources/ticket-salary-advance.headings.employee_information.label'))
            ->schema([
                Forms\Components\Grid::make(4)
                    ->schema([
                        Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('name')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.name.label'))
                                    ->content(function (?Model $record) {
                                        return $record->employee->user->name;
                                    }),
                                Forms\Components\Placeholder::make('internal_id')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.internal_id.label'))
                                    ->content(function (?Model $record) {
                                        return $record->employee->internal_id;
                                    }),
                                Forms\Components\Placeholder::make('nic_no')
                                    ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.nic_no.label'))
                                    ->content(function (?Model $record) {
                                        return $record->employee->identity_card_number;
                                    }),
                            ]),
                    ]),
                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\Placeholder::make('department')
                            ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.department.label'))
                            ->content(function (?Model $record) {
                                return $record->employee->latestActiveEmployment->department->name;
                            }),
                        Forms\Components\Placeholder::make('job_position')
                            ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.job_position.label'))
                            ->content(function (?Model $record) {
                                return $record->employee->latestActiveEmployment->position->name;
                            }),
                        Forms\Components\Placeholder::make('joined_at')
                            ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.joined_at.label'))
                            ->content(function (?Model $record) {
                                return $record->employee->latestActiveEmployment->joined_at->format('d F Y');
                            }),
                        Forms\Components\Placeholder::make('length_of_employment')
                            ->label(__('kanri::filament/resources/ticket-salary-advance.placeholders.length_of_employment.label'))
                            ->content(function (?Model $record) {
                                return CalculateAge::run($record->employee->latestActiveEmployment->joined_at);
                            }),
                    ]),
            ])
            ->columns(4)
        ;
    }

    protected static function getNavigationBadge(): ?string
    {
        $query = parent::getEloquentQuery()
            ->whereIn('status', [TicketStatus::PENDING, TicketStatus::UNDER_REVIEW])
        ;

        if (Auth::user()->can(DefaultPermissions::VIEW_ANY_TICKETS)) {
            return $query->count();
        }

        $query = $query->where(function (Builder $builder) {
            return App::make(Pipeline::class)
                ->send($builder)
                ->through([
                    CheckForHumanCapitalTicket::class,
                    CheckForLeaveRequestTicket::class,
                ])
                ->thenReturn()
            ;
        });

        return $query->count();
    }
}
