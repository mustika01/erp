<?php

namespace Kumi\Kiosk\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Livewire\Component as Livewire;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\PersonalTicket;
use Kumi\Kiosk\Models\TicketCategory;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Component;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Kiosk\Support\Enums\TicketStatus;
use Kumi\Kiosk\Filament\Resources\PersonalTicketResource\Pages;
use Kumi\Kiosk\Filament\Resources\PersonalTicketResource\RelationManagers;
use Kumi\Kiosk\Filament\Resources\PersonalTicketResource\Pages\ViewPersonalTicket;
use Kumi\Kiosk\Filament\Resources\PersonalTicketResource\Schemas\InteractsWithLeaveRequestSchemas;
use Kumi\Kiosk\Filament\Resources\PersonalTicketResource\Schemas\InteractsWithSalaryAdvanceSchemas;

class PersonalTicketResource extends Resource
{
    use InteractsWithSalaryAdvanceSchemas;
    use InteractsWithLeaveRequestSchemas;

    protected static ?string $modelLabel = 'Ticket';

    protected static ?string $model = PersonalTicket::class;

    protected static ?string $navigationGroup = 'kiosk';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1003;

    protected static ?string $slug = 'kiosk/tickets';

    public function mount(): void
    {
        abort_unless(Auth::user()->employee && Auth::user()->employee->hasActiveEmployment(), Response::HTTP_NOT_FOUND);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(3)
                ->schema([
                    self::getCommonTicketSchema(),
                    Forms\Components\Card::make([])
                        ->extraAttributes([
                            'class' => 'h-full bg-stone-100',
                        ])
                        ->columnSpan(1)
                        ->visible(function (Closure $get) {
                            return is_null($get('category_id')) || is_null($get('child_category_id'));
                        }),
                    self::getSalaryAdvanceSidebarSchema(),
                    self::getSalaryAdvanceApprovalSchema(),
                    self::getLeaveRequestSidebarSchema(),
                ]),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('kiosk::filament/resources/ticket.columns.id.label')),
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
            'index' => Pages\ListPersonalTickets::route('/'),
            'create' => Pages\CreatePersonalTicket::route('/create'),
            'view' => Pages\ViewPersonalTicket::route('/{record}'),
            'edit' => Pages\EditPersonalTicket::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('employee_id', Auth::user()->employee->id);
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
                ->afterStateUpdated(function (Closure $set) {
                    $set('child_category_id', null);
                }),
            Forms\Components\Select::make('child_category_id')
                ->label(__('kiosk::filament/resources/ticket.fields.child_category.label'))
                ->options(function (Closure $get) {
                    $categoryId = $get('category_id');

                    return $categoryId ? TicketCategory::query()->withParent($categoryId)->pluck('label', 'id') : [];
                })
                ->reactive()
                ->disabled(function (Closure $get) {
                    $categoryId = $get('category_id');

                    return $categoryId ? TicketCategory::query()->withParent($categoryId)->count() === 0 : true;
                })
                ->visible(function (Livewire $livewire, Component $component) {
                    if ($livewire instanceof ViewPersonalTicket) {
                        return $component->isDisabled();
                    }

                    return ! $component->isDisabled();
                })
                ->required(function (Livewire $livewire, Component $component) {
                    if ($livewire instanceof ViewPersonalTicket) {
                        return $component->isDisabled();
                    }

                    return ! $component->isDisabled();
                })
                ->afterStateUpdated(function (Closure $set) {
                    $set('grand_child_category_id', null);
                }),
            Forms\Components\Select::make('grand_child_category_id')
                ->label(__('kiosk::filament/resources/ticket.fields.grand_child_category.label'))
                ->options(function (Closure $get) {
                    $categoryId = $get('child_category_id');

                    return $categoryId ? TicketCategory::query()->withParent($categoryId)->pluck('label', 'id') : [];
                })
                ->reactive()
                ->disabled(function (Closure $get) {
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
                })
                ->visibleOn(ViewPersonalTicket::class),
        ])->columns(3)->columnSpan(2);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->employee && Auth::user()->employee->hasActiveEmployment();
    }
}
