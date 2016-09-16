<?php
namespace Mage2\Framework\Foundation;

use Illuminate\Foundation\Application as LaravelApplication;

class Application extends LaravelApplication
{
  
    public function __construct($basePath = null)
    {
        parent::__construct($basePath);
    }
    
      /**
     * Get the path to the application "app" directory.
     *
     * @return string
     */
    public function path()
    {
        //return $this->basePath.DIRECTORY_SEPARATOR.'app';
        return $this->basePath.DIRECTORY_SEPARATOR.'modules/base';
    }
    /**
     * Get the path to the cached services.php file.
     *
     * @return string
     */
    public function getCachedServicesPath()
    {
        return $this->storagePath().'/app/services.php';
    }
    
     /**
     * Get the application namespace.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getNamespace()
    {
        return "Mage2\\Common";
    }
}
