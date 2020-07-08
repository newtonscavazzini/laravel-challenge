<?php

namespace App\Models;

use Carbon\Carbon;

class Calendar
{
    private $month;
    private $year;
    private $events;

    public function __construct($month, $year, $events)
    {
        $this->month = $month;
        $this->year = $year;
        $this->events = $events;
    }

    public function toJson()
    {
        $date = Carbon::createFromDate($this->year, $this->month)->firstOfMonth();
        $previousDate = $date->copy()->subMonth();
        $nextDate = $date->copy()->addMonth();

        return [
            'month' => $date->format('F'),
            'month_numerical' => $date->format('n'),
            'year' => $date->format('Y'),
            'links' => [
                'previousMonth' => [
                    'month' => $previousDate->format('F'),
                    'month_numerical' => $previousDate->format('n'),
                    'year' => $previousDate->format('Y'),
                    'href' => route('month_calendar', ['month' => $previousDate->format('n'), 'year' => $previousDate->format('Y')]),
                ],
                'nextMonth' => [
                    'month' => $nextDate->format('F'),
                    'month_numerical' => $nextDate->format('n'),
                    'year' => $nextDate->format('Y'),
                    'href' => route('month_calendar', ['month' => $nextDate->format('n'), 'year' => $nextDate->format('Y')]),
                ]
            ],
            'calendar' => $this->events,
        ];
    }
}