<?php

namespace Mage2\Framework\Module;

use Illuminate\Support\Collection;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class ModuleManager
{
    public $moduleList;
    public $moduleLoaded = false;

    public function __construct()
    {
        $this->moduleList = Collection::make([]);
    }

    public function all()
    {
        if ($this->moduleLoaded === false) {
           // $this->loadModule();
        }

        return $this->moduleList;
    }

    protected function loadModule()
    {
        $modulePath = base_path('modules');


        $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($modulePath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
        );

        $iterator->setMaxDepth(2);
        $iterator->rewind();

        while ($iterator->valid()) {
            if (($iterator->getDepth() > 1) && $iterator->isFile() && ($iterator->getFilename() == 'Module.php')) {
                $filePath = $iterator->getPathname();
                $moduleInfo = include_once $filePath;
                $this->moduleList->put($moduleInfo['name'], $moduleInfo);
            }
            $iterator->next();
        }

        $this->moduleLoaded = true;

        return $this;
    }

    public function put($identifier, $moduleContainer)
    {

        $this->moduleList->put($identifier, $moduleContainer);

        return $this;
    }

    public function get($identifier)
    {
        return $this->moduleList->pull($identifier);
    }

    public function getByPath($path)
    {
        foreach ($this->moduleList as $module =>  $moduleInfo) {
            $path1 = $this->pathSlashFix($path);
            $path2 = $this->pathSlashFix($moduleInfo['path']);

            if ($path1 == $path2) {
                $actualModule = $this->moduleList[$module];
                break;
            }
        }

        return $actualModule;
    }

    public function pathSlashFix($path)
    {
        return (DIRECTORY_SEPARATOR === '\\') ? str_replace('/', '\\', $path) : str_replace('\\', '/', $path);
    }
}
