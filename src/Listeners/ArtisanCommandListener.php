<?php

namespace DevMoez\ArtisanCommandGuard\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Console\Events\CommandStarting;

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
        $config = config('artisan-command-guard');
        $message = "$event->command is blocked from running in $appEnv environment.";

        if (isset($config['environments'][$appEnv])) {
            if (in_array($event->command, $commands['environments'][$appEnv])) {
                # log system user to log file
                if ($config['enable_log_user']) {
                    $process = new Process(['whoami']);
                    $process->run();
                    // $user = $process->getOutput();

                    Log::critical($message, [
                        'user'  => $process->getOutput(),
                        'command'   => $event->command
                    ]);
                }

                die($message);
            }
        }
    }
}
