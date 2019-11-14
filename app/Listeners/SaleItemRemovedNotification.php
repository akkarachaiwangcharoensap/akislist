<?php

namespace App\Listeners;

use App\SaleItemMessage;

use App\Events\SaleItemRemoved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaleItemRemovedNotification
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
     * @param  SaleItemRemoved $event
     * @return void
     */
    public function handle(SaleItemRemoved $event)
    {
        $saleItem = $event->saleItem;

        $saleItem->active = false;
        $saleItem->live = false;

        $saleItem->conversations->each(function (SaleItemMessage $saleItemMessage) {
        	$saleItemMessage->active = false;
        	$saleItemMessage->save();
        });

        $saleItem->save();
    }
}
