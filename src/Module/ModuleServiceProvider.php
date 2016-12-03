<?php

namespace Mage2\Framework\Module;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

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
    public function register() {


        $this->registerModule();
        $this->loadCommunityModule();

        $this->app->alias('module', 'Mage2\Framework\Module\ModuleManager');
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerModule() {
        $this->app->singleton('module', function ($app) {
            return new ModuleManager();
        });
    }

    public function registerModuleNameSpace() {

        /*
          $this->app->booted(function($app) {
          $modules = ModuleFacade::all($type = "community");
          dd($modules);
          });
         * 
         */
        $mage2Module = config('module');

        foreach ($mage2Module as $namespace => $path) {

            $loader = new ClassLoader();


            $loader->addPsr4($namespace, $path);
            $loader->register();

            //App::register($namespace . 'ModuleInfo');
        }
    }

    protected function loadCommunityModule() {
        $modulePath = base_path('modules/community');


        $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($modulePath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
        );

        $iterator->setMaxDepth(2);
        $iterator->rewind();

        while ($iterator->valid()) {
            if (($iterator->getDepth() > 1) && $iterator->isFile() && ($iterator->getFilename() == 'Module.php')) {
                $filePath = $iterator->getPathname();
                $providerDirName = dirname($filePath);

                include_once $filePath;
                $moduleName = basename($providerDirName);
                $companyName = basename(dirname($providerDirName));
                $namespace = $companyName . "\\" . $moduleName . "\\";


                $loader = new ClassLoader();


                $loader->addPsr4($namespace, $providerDirName);
                $loader->register();

                
                $providerClassName = $companyName. "\\" . $moduleName . "\\" ."Module";
                $this->app->register($providerClassName);
               
            }
            $iterator->next();
        }

        $this->moduleLoaded = true;

        return $this;
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['module', 'Mage2\Framework\Module\ModuleManager'];
    }

}
