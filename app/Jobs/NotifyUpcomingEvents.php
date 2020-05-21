<?php

namespace App\Jobs;

use App\Mail\UpcomingEventsMail;
use App\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class NotifyUpcomingEvents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(UserRepository $userRepository)
    {
        $userRepository->getUsersWithUpcomingEvents(5)->each(function ($user) {
            Mail::to($user->email)->queue(new UpcomingEventsMail($user, $user->events));
        });
    }
}
