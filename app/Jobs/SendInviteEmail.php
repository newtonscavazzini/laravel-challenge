<?php

namespace App\Jobs;

use App\Event;
use App\Mail\InviteParticipant;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendInviteEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $event;
    private $email;
    private $sender;

    public function __construct(Event $event, string $sender, string $email)
    {
        $this->event = $event;
        $this->sender = $sender;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payload = array(
            "iss" => "laravel-challenge",
            "iat" => Carbon::now()->timestamp,
            'exp' => Carbon::now()->addDays(7)->timestamp,
            'event' => $this->event->id,
            'invited' => $this->email,
        );

        $token = JWT::encode($payload, env('APP_KEY'));

        Mail::to($this->email)
            ->queue(new InviteParticipant($this->event, $this->sender, $token));
    }
}
