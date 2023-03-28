<?php

namespace DevMoez\ArtisanCommandGuard\Listeners;

use Illuminate\Console\Events\CommandStarting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class ArtisanCommandListener
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
    public function handle(CommandStarting $event): void
    {
        $appEnv = app()->environment();
        $commands = config('artisan-command-guard');
        if (isset($commands[$appEnv]))
        {
            if (in_array($event->command, $commands[$appEnv]))
            {
                die("$event->command is blocked from running in $appEnv environment.");
            }
        }
    }
}
