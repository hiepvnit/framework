<?php

namespace Mage2\Framework\Database\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Database\ConnectionResolverInterface as Resolver;

class Mage2Seed extends Command {

    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mage2:seed {--database=}';

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Resolver $resolver) {
        parent::__construct();
        $this->resolver = $resolver;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        if (!$this->confirmToProceed()) {
            return;
        }



        $this->resolver->setDefaultConnection($this->getDatabase());


        $modules = config('module');

        foreach($modules as $namespace =>  $path ) {
            $this->moduleNamespace = $namespace;
            Model::unguarded(function () {
                $seederClass = $this->getSeeder($this->moduleNamespace);
                if(NULL !== $seederClass) {
                    $seederClass->run();
                }

            });
        }

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
     * Get a seeder instance from the container.
     *
     * @return \Illuminate\Database\Seeder
     */
    protected function getSeeder($nameSpace)
    {


        $className = $nameSpace . "Database\\Seeds\\DatabaseSeeder";

        if(!class_exists($className)) {
            return null;
        }
        $class = $this->laravel->make($className);

        return $class->setContainer($this->laravel)->setCommand($this);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed'],
        ];
    }

}
