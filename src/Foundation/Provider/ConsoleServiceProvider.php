<?php

namespace Mage2\Framework\Foundation\Provider;

use Illuminate\Support\ServiceProvider;
use Mage2\Framework\Database\Console\Commands\Mage2Migrate;
use Mage2\Framework\Database\Console\Commands\Mage2Seed;

class ConsoleServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->registerCommand();
    }

    public function registerCommand() {
        //$this->{'register' . "" . 'Command'}();

        $this->commands('command.mage2.migrate');
        $this->app->singleton('command.mage2.migrate', function ($app) {
            return new Mage2Migrate($app['migrator']);
        });

        $this->app->singleton('command.mage2.seed', function ($app) {
            return new Mage2Seed($app['db']);
        });
        $this->commands('command.mage2.seed');
    }

}
