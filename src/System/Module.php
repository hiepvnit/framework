<?php

namespace Mage2\Framework\System;

use Mage2\Framework\System\Middleware\Website as WebsiteMiddleware;
use Mage2\Framework\System\View\FileViewFinder;
use Illuminate\View\ViewServiceProvider as BaseModule;

class Module extends BaseModule {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->_registerThemeFacade();
        $this->app['request']->server->set('HTTPS', 'off');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

        $this->app->bind('view.finder', function ($app) {
            $paths = $app['config']['view.paths'];

            return new FileViewFinder($app['files'], $paths);
        });
        $this->registerMiddleware();
    }

    /**
     * Register the middleware for the mage2 auth modules.
     *
     * @return void
     */
    public function registerMiddleware() {

        $router = $this->app['router'];
        $router->middleware('website', WebsiteMiddleware::class);
    }

    /**
     * Get the URL generator request rebinder.
     *
     * @return \Closure
     */
    protected function requestRebinder() {
        return function ($app, $request) {
            $app['url']->setRequest($request);
        };
    }


}
