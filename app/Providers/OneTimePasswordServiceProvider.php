<?php

namespace App\Providers;

use App\Helpers\OneTimePassword\OneTimePasswordGenerator;
use Illuminate\Support\ServiceProvider;

class OneTimePasswordServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/one-time-password.php' => config_path('one-time-password.php'),
            ], 'config');

            $migrationFileName = 'create_one_time_passwords_table.php';
            if (!$this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }
        }
    }

    public function register()
    {
        $this->app->alias(OneTimePasswordGenerator::class, 'one-time-password');
        $this->mergeConfigFrom(__DIR__ . '/../../config/one-time-password.php', 'one-time-password');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
