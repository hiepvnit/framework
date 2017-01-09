<?php

namespace Mage2\Framework\Module\Console;

use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Migrations\Migrator;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use Mage2\Framework\Database\Console\Migrations\BaseCommand;
use Mage2\Framework\Module\Facades\Module;

class InstallCommand extends BaseCommand {

    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'mage2:module:install {modulename}';

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
     * The migrator instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $fileSystem;

  

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
        $this->fileSystem = $fileSystem;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire() {
       
        $moduleName = trim($this->input->getArgument('modulename'));

        $files = $this->getInstallFilePaths($moduleName);


        $this->migrator->run($files);





    }
    /**
     * Get all of the migration paths.
     *
     * @return array
     */
    protected function getInstallFilePaths($moduleName) {

        $module =  Module::get($moduleName);

        $file = $module->getPath() . DIRECTORY_SEPARATOR . "database";

        $this->migrator->path($file);

        return $this->migrator->paths();

    }
}