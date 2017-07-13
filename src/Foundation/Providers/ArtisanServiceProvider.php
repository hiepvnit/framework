<?php

namespace Mage2\Framework\Foundation\Providers;

use Illuminate\Queue\Console\TableCommand;
use Illuminate\Auth\Console\MakeAuthCommand;
use Illuminate\Foundation\Console\UpCommand;
use Illuminate\Foundation\Console\DownCommand;
use Illuminate\Auth\Console\ClearResetsCommand;
use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Cache\Console\CacheTableCommand;
use Illuminate\Queue\Console\FailedTableCommand;
use Illuminate\Foundation\Console\TinkerCommand;
use Illuminate\Foundation\Console\JobMakeCommand;
use Illuminate\Foundation\Console\AppNameCommand;
use Illuminate\Foundation\Console\OptimizeCommand;
use Illuminate\Foundation\Console\TestMakeCommand;
use Illuminate\Foundation\Console\MailMakeCommand;
use Illuminate\Foundation\Console\RouteListCommand;
use Illuminate\Foundation\Console\EventMakeCommand;

use Illuminate\Foundation\Console\ViewClearCommand;
use Illuminate\Session\Console\SessionTableCommand;
use Illuminate\Foundation\Console\RouteCacheCommand;
use Illuminate\Foundation\Console\RouteClearCommand;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Foundation\Console\ConfigCacheCommand;
use Illuminate\Foundation\Console\ConfigClearCommand;
use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Illuminate\Foundation\Console\EnvironmentCommand;
use Illuminate\Foundation\Console\KeyGenerateCommand;
use Illuminate\Foundation\Console\ListenerMakeCommand;
use Illuminate\Foundation\Console\ProviderMakeCommand;
use Illuminate\Foundation\Console\ClearCompiledCommand;
use Illuminate\Foundation\Console\EventGenerateCommand;
use Illuminate\Foundation\Console\VendorPublishCommand;
use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Illuminate\Foundation\Console\NotificationMakeCommand;
use Illuminate\Notifications\Console\NotificationTableCommand;


use Mage2\Framework\Module\Console\InstallCommand;
use Mage2\Framework\Module\Console\UninstallCommand;
use Mage2\Framework\Foundation\Console\PolicyMakeCommand;
use Mage2\Framework\Foundation\Console\RequestMakeCommand;
use Mage2\Framework\Foundation\Console\ModelMakeCommand;
use Mage2\Framework\Routing\Console\ControllerMakeCommand;
use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $devCommands = [
        'Mage2ModuleInstall' => 'command.mage2.module.install',
        'Mage2ModuleUninstall' => 'command.mage2.module.uninstall',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands($this->commands);

        $this->registerCommands($this->devCommands);
    }

    /**
     * Register the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            $method = "register{$command}Command";

            call_user_func_array([$this, $method], []);
        }

        $this->commands(array_values($commands));
    }
    
    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMage2ModuleInstallCommand()
    {
        
        $this->app->singleton('command.mage2.module.install', function ($app) {
            return new InstallCommand( $app['files']);
        });
    }
    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMage2ModuleUninstallCommand()
    {
        
        $this->app->singleton('command.mage2.module.uninstall', function ($app) {
            return new UninstallCommand( $app['files']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        if ($this->app->environment('production')) {
            return array_values($this->commands);
        } else {
            return array_merge(array_values($this->commands), array_values($this->devCommands));
        }
    }
}
