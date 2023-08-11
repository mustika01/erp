<?php

namespace Kumi\Yoyaku\Filament\Widgets;

use Filament\Forms;
use Kumi\Yoyaku\Models\Booking;
use Kumi\Yoyaku\Models\Bookable;
use Illuminate\Support\Facades\Auth;
use Kumi\Yoyaku\Support\DefaultPermissions;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class BookableCalendarWidget extends FullCalendarWidget
{
    public Bookable $bookable;

    // protected string $modalWidth = 'md';

    /**
     * this allows to have calendar specific config on top of global config.
     */
    protected array $fullCalendarConfig = [
        'headerToolbar' => [
            'left' => 'prev,next',
            'center' => 'title',
            'right' => 'dayGridMonth,dayGridWeek,dayGridDay',
        ],
    ];

    public function fetchEvents(array $fetchInfo): array
    {
        $start = $fetchInfo['start'];
        $end = $fetchInfo['end'];

        $bookings = $this->bookable
            ->bookings()
            ->getQuery()
            ->whereBetween('started_at', [$start, $end])
            ->get()
        ;

        return $bookings->map(function (Booking $booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->title,
                'start' => $booking->started_at,
                'end' => $booking->ended_at,
            ];
        })->toArray();
    }

    public function createEvent(array $data): void
    {
        $this->createBooking($data);
    }

    public function editEvent(array $data): void
    {
        $this->editBooking($data);
    }

    public function getCreateEventModalTitle(): string
    {
        return __('yoyaku::filament/resources/booking.modals.create.title');
    }

    public function getEditEventModalTitle(): string
    {
        return __('yoyaku::filament/resources/booking.modals.edit.title');
    }

    public function onEventClick($event): void
    {
        parent::onEventClick($event);

        $booking = Booking::find($event['id']);

        $this->editEventForm
            ->disabled(! static::canEdit($event))
            ->fill([
                'title' => $booking->title,
                'started_at' => $booking->started_at,
                'ended_at' => $booking->ended_at,
                'description' => $booking->description,
            ])
        ;
    }

    public static function canView(?array $event = null): bool
    {
        // When event is null, MAKE SURE you allow View otherwise the entire widget/calendar won't be rendered
        if ($event === null) {
            return true;
        }

        // Returning 'false' will not show the event Modal.
        return Auth::user()->can(DefaultPermissions::VIEW_ANY_BOOKINGS);
    }

    public static function canCreate(): bool
    {
        // Returning 'false' will remove the 'Create' button on the calendar.
        return Auth::user()->can(DefaultPermissions::CREATE_BOOKING);
    }

    public static function canEdit(?array $event = null): bool
    {
        // Returning 'false' will disable the edit modal when clicking on a event.
        return Auth::user()->can(DefaultPermissions::UPDATE_BOOKING);
    }

    protected static function getCreateEventFormSchema(): array
    {
        return static::getBookingFormSchema();
    }

    protected static function getEditEventFormSchema(): array
    {
        return static::getBookingFormSchema();
    }

    protected function createBooking(array $data): void
    {
        $booking = new Booking([
            'employee_id' => Auth::user()->employee->id,
            ...$data,
        ]);

        $this->bookable->bookings()->save($booking);
    }

    protected function editBooking(array $data): void
    {
        $booking = Booking::find($this->event_id);

        if ($booking) {
            $booking->update($data);
        }
    }

    protected static function getBookingFormSchema(): array
    {
        return [
            Forms\Components\Grid::make(1)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('yoyaku::filament/resources/booking.fields.title.label'))
                        ->required(),
                    Forms\Components\DateTimePicker::make('started_at')
                        ->label(__('yoyaku::filament/resources/booking.fields.started_at.label'))
                        ->displayFormat('d F Y / H:i')
                        ->minDate(now())
                        ->withoutSeconds()
                        ->required(),
                    Forms\Components\DateTimePicker::make('ended_at')
                        ->label(__('yoyaku::filament/resources/booking.fields.ended_at.label'))
                        ->displayFormat('d F Y / H:i')
                        ->minDate(now())
                        ->withoutSeconds()
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label(__('yoyaku::filament/resources/booking.fields.description.label'))
                        ->nullable(),
                ]),
        ];
    }
}
