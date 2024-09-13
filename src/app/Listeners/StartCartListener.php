<?php

namespace App\Listeners;

use App\Events\cartCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Cart;

class StartCartListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(cartCreated $event): void
    {
        $id = $event->user->id;
        $cart = new Cart();
        $cart->user_id = $id;
        $cart->save();
    }
}
