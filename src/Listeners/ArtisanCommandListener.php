<?php

namespace DevMoez\ArtisanCommandGuard\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Console\Events\CommandStarting;
use Symfony\Component\Process\Process;

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

            if (in_array($event->command, $config['environments'][$appEnv])) {
                # log system user to log file
                if ($config['enable_log_user']) {
                    $process = new Process(['whoami']);
                    $process->run();

                    Log::critical($message, [
                        'command'   => $event->command,
                        'user'  => $process->getOutput(),
                    ]);
                }

                die($message);
            }
        }
    }
}
