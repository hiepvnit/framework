<?php

namespace Mage2\Framework;

use Illuminate\Support\ServiceProvider;

class Mage2ServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() {

        $this->registerRoutes();
        $this->registerMigrationPath();
        $this->registerTranslationPath();
        $this->registerViewPath();

    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register() {

    }


    /**
     * Register routes for this admin app.
     *
     * @return void
     */
    public function registerRoutes() {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }


    /**
     * Register migration path for this admin app.
     *
     * @return void
     */
    public function registerMigrationPath() {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register translation path for this admin app.
     *
     * @return void
     */
    public function registerTranslationPath()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mage2-framework');
    }


    /**
     * Register view path for this admin app.
     *
     * @return void
     */
    public function registerViewPath()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mage2-framework');
    }

}
