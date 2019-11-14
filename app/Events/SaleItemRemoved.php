<?php

namespace App\Events;

use App\SaleItem;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SaleItemRemoved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Sale Item
     * @var SaleItem $saleItem
     */
    public $saleItem;

    /**
     * Create a new event instance.
     *
     * @param SaleItem $saleItem
     * @return void
     */
    public function __construct(SaleItem $saleItem)
    {
    	$this->saleItem = $saleItem;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
