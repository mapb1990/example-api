<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Professional;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProfessionalCreated extends Event
{
    use SerializesModels;

    /**
     * @var \App\Models\Professional
     */
    protected $professional;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Professional $professional
     * @return void
     */
    public function __construct(Professional $professional)
    {
        $this->professional = $professional;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    /**
     * @return Professional
     */
    public function getProfessional()
    {
        return $this->professional;
    }
}
