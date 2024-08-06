<?php

namespace App\Listeners;

use App\Events\testEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\leadAcquired;
class SendDownloadNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(testEvent $event): void
    {
        Mail::to('ernestromen1996@gmail.com')->send(new leadAcquired());
    }
}
