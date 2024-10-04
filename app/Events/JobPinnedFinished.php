<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobPinnedFinished implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($listingId)
    {
        $this->listingId = $listingId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('job-pinned-finished'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'JobPinnedFinished';
    }

    public function failed(\Exception $exception)
    {
    Log::error('UploadToIPFS job failed', [
        'listing_id' => $this->listingId,
        'error' => $exception->getMessage(),
    ]);
    }
}
