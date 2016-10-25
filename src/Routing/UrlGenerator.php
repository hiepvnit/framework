<?php

namespace Mage2\Framework\Routing;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator as LaravelUrlGenerator;

class UrlGenerator extends LaravelUrlGenerator
{
    public function __construct(RouteCollection $routes, Request $request)
    {
        parent::__construct($routes, $request);
    }

    /**
     * Generate the URL to an application asset.
     *
     * @param string    $path
     * @param bool|null $secure
     *
     * @return string
     */
    public function asset($path, $secure = null)
    {
        return parent::asset($path, $secure);

        /*
        if ($this->isValidUrl($path)) {
            return $path;
        }


        // Once we get the root URL, we will check to see if it contains an index.php
        // file in the paths. If it does, we will remove it since it is not needed
        // for asset paths, but only for routes to endpoints in the application.
        $root = $this->getRootUrl($this->getScheme($secure));

        dd($this->removeIndex($root).'/'.trim($path, '/'));
        return $this->removeIndex($root).'/'.trim($path, '/');
         */
    }
}
