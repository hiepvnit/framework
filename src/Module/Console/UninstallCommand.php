<?php

namespace Mage2\Framework\Module\Console;

use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Migrations\Migrator;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use Mage2\Framework\Database\Console\Migrations\BaseCommand;


class UninstallCommand extends BaseCommand {

    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'mage2:module:uninstall {modulename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall the mage2 community Module';

    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

  

    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */

    /**
     * Create a new migration command instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator  $migrator
     * @return void
     */
    public function __construct(Migrator $migrator, Filesystem $fileSystem) {
        parent::__construct($fileSystem);

        $this->migrator = $migrator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire() {
       
        $moduleName = trim($this->input->getArgument('modulename'));
        
        dd($moduleName);
        
        

     
    }

  

    /**
     * Get all of the migration paths.
     *
     * @return array
     */
    protected function getInstallFilePath($moduleName) {
      
       
        foreach ($modules as $modulePath) {
            $migrationFilePath = $modulePath . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations';
            $this->migrator->path($migrationFilePath);
        }

        return $this->migrator->paths();
    }

}
