<?php

namespace Mage2\Framework\Foundation\Provider;

use Illuminate\Support\ServiceProvider;
use Mage2\Framework\Database\Console\Commands\Mage2MakeMigrate;
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

        $this->app->singleton('command.make.mage2migration', function ($app) {

            $creator = $app['migration.creator'];
            $composer = $app['composer'];

            return new Mage2MakeMigrate($creator, $composer);
        });
        $this->commands('command.make.mage2migration');
    }

}
