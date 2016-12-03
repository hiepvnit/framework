<?php

namespace Mage2\Framework\Database\Console\Seeds;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Database\ConnectionResolverInterface as Resolver;
use Illuminate\Filesystem\Filesystem;

class SeedCommand extends Command {

    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'mage2:dbseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with records';

    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Database\ConnectionResolverInterface
     */
    protected $resolver;
    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $fileSystem;

    /**
     * Create a new database seed command instance.
     *
     * @param  \Illuminate\Database\ConnectionResolverInterface  $resolver
     * @return void
     */
    public function __construct(Resolver $resolver, Filesystem $fileSystem) {
        parent::__construct();

        $this->resolver = $resolver;
        $this->fileSystem = $fileSystem;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire() {
        if (!$this->confirmToProceed()) {
            return;
        }

        $this->resolver->setDefaultConnection($this->getDatabase());

        Model::unguarded(function () {
            $modules = config('module');

            foreach ($modules as $nameSpace => $modulePath) {
                $seederClass = str_replace('\\', "", $nameSpace) . "Seeder";
                
                $seederClassPath =  $modulePath . DIRECTORY_SEPARATOR . 
                                    'database' . DIRECTORY_SEPARATOR . 'seeds' .DIRECTORY_SEPARATOR  .
                                    str_replace('\\', "", $nameSpace) . "Seeder.php";
             
                
                if ($this->fileSystem->exists($seederClassPath)) {
                    $this->fileSystem->requireOnce($seederClassPath);
                    $this->getSeeder($seederClass)->run();
                }
            }
        });
    }

    /**
     * Get a seeder instance from the container.
     *
     * @return \Illuminate\Database\Seeder
     */
    protected function getSeeder($seederClass) {
        
        $class = $this->laravel->make($seederClass);

        return $class->setContainer($this->laravel)->setCommand($this);
    }

    /**
     * Get the name of the database connection to use.
     *
     * @return string
     */
    protected function getDatabase() {
        $database = $this->input->getOption('database');

        return $database ? : $this->laravel['config']['database.default'];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder', 'DatabaseSeeder'],
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
        ];
    }

}
