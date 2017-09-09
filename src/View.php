<?php
namespace Mage2\Framework;

use Illuminate\View\Factory;

class View  extends  Factory{


    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    public function make($view, $data = [], $mergeData = [])
    {
        //$materialThemePath = base_path('themes/mage2/material/views');
        //$this->finder->prependLocation($materialThemePath);
        
        $path = $this->finder->find(
            $view = $this->normalizeName($view)
        );


        // Next, we will create the view instance and call the view creator for the view
        // which can set any data, etc. Then we will return the view instance back to
        // the caller for rendering or performing other view manipulations on this.
        $data = array_merge($mergeData, $this->parseData($data));

        return tap($this->viewInstance($view, $path, $data), function ($view) {
            $this->callCreator($view);
        });
    }


}