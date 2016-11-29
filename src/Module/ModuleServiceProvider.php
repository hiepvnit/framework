<?php
namespace Mage2\Framework\Module;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class ModuleServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {


        $this->registerModule();

        //$this->registerModuleNameSpace();

        $this->app->alias('module', 'Mage2\Framework\Module\ModuleManager');
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerModule()
    {
        $this->app->singleton('module', function ($app) {
            return new ModuleManager();
        });
    }


    public function registerModuleNameSpace() {

        $mage2Module = config('module');

        foreach ($mage2Module as $namespace => $path) {

            $loader = new ClassLoader();


            $loader->addPsr4($namespace, $path);
            $loader->register();

            //App::register($namespace . 'ModuleInfo');

        }
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['module', 'Mage2\Framework\Module\ModuleManager'];
    }
}