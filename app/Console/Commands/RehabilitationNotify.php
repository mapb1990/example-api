<?php

namespace App\Console\Commands;

use App\Models\Rehabilitation;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class RehabilitationNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:rehabilitations {--days=15}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to professional with rehabilitations to end in the coming days';

    /**
     * @var \Illuminate\Mail\Mailer
     */
    protected $mailer;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Mail\Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        parent::__construct();
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $rehabilitations = Rehabilitation::where('reminder', 0)
            ->endedInNextDays($this->option('days'))
            ->get();

        /**
         * @var $rehabilitation Rehabilitation
         */
        foreach ($rehabilitations as $rehabilitation) {
            $this->mailer->send(
                'emails.rehabilitation-reminder',
                ['rehabilitation' => $rehabilitation],
                function (Message $message) use ($rehabilitation) {
                    $message->to($rehabilitation->professional->user->email, $rehabilitation->professional->user->name)
                        ->subject('Reminder');
                }
            );

            $rehabilitation->reminder = true;
            $rehabilitation->save();
        }
    }
}
