<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserRepository
{

    public function getUsersWithUpcomingEvents(int $days): Collection
    {
        $today = Carbon::today();

        $from = $today->setTimeFromTimeString('00:00:00')->toDateTimeString();
        $to = $today->addDays($days)->setTimeFromTimeString('23:59:59')->toDateTimeString();

        return User::query()
            ->whereHas('events', function($query) use ($to, $from) {
                $query->whereBetween('start_at', [$from, $to]);
            })
            ->with(['events' => function($query) use ($to, $from) {
                $query->whereBetween('start_at', [$from, $to]);
            }])
            ->get();
    }

}
