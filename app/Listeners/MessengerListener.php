<?php

namespace App\Listeners;

use App\Events\MessengerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessengerListener
{

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessengerEvent $event): void
    {
        //
    }
}
