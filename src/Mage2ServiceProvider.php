<?php

namespace Mage2\Framework;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

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
        $this->extendView();

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

    public function extendView() {

        App::extend('view',function() {
            $app = app();
            // Next we need to grab the engine resolver instance that will be used by the
            // environment. The resolver will be used by an environment to get each of
            // the various engine implementations such as plain PHP or Blade engine.
            $resolver = $app['view.engine.resolver'];

            $finder = $app['view.finder'];

            $env = new \Mage2\Framework\View($resolver, $finder, $app['events']);

            // We will also set the container instance on this view environment since the
            // view composers may be classes registered in the container, which allows
            // for great testable, flexible composers for the application developer.
            $env->setContainer($app);

            $env->share('app', $app);

            return $env;

        });

    }

}
