<?php

namespace App\Listeners;

use App\Events\ProfessionalCreated;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfessionalEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var \Illuminate\Contracts\Mail\Mailer
     */
    protected $mailer;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  ProfessionalCreated  $event
     * @return void
     */
    public function onProfessionalAsCreated(ProfessionalCreated $event)
    {
        \Password::sendResetLink(
            ['email' => $event->getProfessional()->user->getEmailForPasswordReset()],
            function (Message $message) {
                $message->subject('Your Password Reset Link');
            }
        );
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(\App\Events\ProfessionalCreated::class, static::class . '@onProfessionalAsCreated');
    }
}
