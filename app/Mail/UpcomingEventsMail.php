<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class UpcomingEventsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $events;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Collection $events)
    {
        $this->user = $user;
        $this->events = $events;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('laravelchallenge@mail.com')
            ->subject('Your upcoming events')
            ->markdown('emails.events.upcoming');
    }
}
