<?php

namespace DevMoez\ArtisanCommandGuard\Providers;

use DevMoez\ArtisanCommandGuard\Console\Commands\InstallArtisanCommandGuardCommand;
use DevMoez\ArtisanCommandGuard\Listeners\ArtisanCommandListener;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Console\Events\CommandStarting;

class ArtisanCommandGuardServiceProvider extends ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/../../config/artisan-command-guard.php';

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([self::CONFIG_PATH => config_path('artisan-command-guard.php')], 'artisan-command-guard-config');
     
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: [
                    InstallArtisanCommandGuardCommand::class,
                ],
            );
        }

        Event::listen(CommandStarting::class, ArtisanCommandListener::class);
    }
}
