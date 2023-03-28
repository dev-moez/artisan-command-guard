<?php

namespace DevMoez\ArtisanCommandGuard\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class InstallArtisanCommandGuardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisan-command-guard:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Artisan Command Guard package into your laravel application';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $config_file = 'artisan-command-guard.php';

        // Publish config
        if (File::exists(config_path($config_file))) {
            if ($this->confirm("artisan-command-guard.php config file already exist. Do you want to overwrite it?")) {
                $this->info("Overwriting config file...");
                $this->publishConfig();
                $this->info("artisan-command-guard.php overwrite finished.");
            } else {
                $this->info("Skipped config file publish.");
            }
        } else {
            $this->publishConfig();
            $this->info("Config file published.");
        }
    }

    private function publishConfig()
    {
        $this->call('vendor:publish', [
            '--provider' => "DevMoez\ArtisanCommandGuard\Services\ArtisanCommandGuardServiceProvider",
            '--tag'      => 'artisan-command-guard-config',
            '--force'    => true
        ]);
    }
}
