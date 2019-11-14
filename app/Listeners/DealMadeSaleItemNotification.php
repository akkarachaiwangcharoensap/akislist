<?php

namespace App\Listeners;

use App\SaleItemMessage;

use App\Events\SaleItemSold;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DealMadeSaleItemNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SaleItemSold  $event
     * @return void
     */
    public function handle(SaleItemSold $event)
    {
        $saleItem = $event->saleItem;
        $saleItem->active = false;
        $saleItem->live = false;

        // Clear all messages
        $saleItem->conversations->each(function (SaleItemMessage $saleItemMessage) {
        	$saleItemMessage->active = false;
        	$saleItemMessage->save();
        });

        $saleItem->save();
    }
}
