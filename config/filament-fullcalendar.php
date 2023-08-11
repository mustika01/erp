<?php

/**
 * Consider this file the root configuration object for FullCalendar.
 * Any configuration added here, will be added to the calendar.
 *
 * @see https://fullcalendar.io/docs#toc
 */

return [
    'timeZone' => config('app.timezone'),

    // 'locale' => config('app.locale'),
    'locale' => 'en-GB',

    'headerToolbar' => [
        'left' => 'prev,next',
        'center' => 'title',
        'right' => 'dayGridMonth,dayGridWeek',
    ],

    'navLinks' => true,

    'editable' => false,

    'selectable' => false,

    'dayMaxEvents' => true,

    'eventOrder' => 'id',

    'eventOrderStrict' => true,

    'eventTimeFormat' => [
        'hour' => '2-digit',
        'minute' => '2-digit',
        'hour12' => false,
    ],
];
