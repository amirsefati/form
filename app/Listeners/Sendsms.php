<?php

namespace App\Listeners;

use App\Event\Sendsms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Sendsms
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
     * @param  Sendsms  $event
     * @return void
     */
    public function handle(Sendsms $event)
    {
        //
    }
}
