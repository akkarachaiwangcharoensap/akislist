<?php

namespace App\Listeners;

use App\SaleItem;
use App\Events\UserBanned;
use App\Events\SaleItemRemoved;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserBannedNotification
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
     * @param  UserBanned  $event
     * @return void
     */
    public function handle(UserBanned $event)
    {
        $user = $event->user;

        $saleItems = SaleItem::where('user_id', $user->id)->get();
        foreach ($saleItems as $saleItem) {
    		event(new SaleItemRemoved($saleItem));
        }

        $user->active = false;
        $user->save();
    }
}
