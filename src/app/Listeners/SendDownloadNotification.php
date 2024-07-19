<?php

namespace App\Listeners;

use App\Events\DownloadTableData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendDownloadNotification
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
    public function handle(DownloadTableData $event): void
    {

        Log::info('The event has been executed');

    }
}
