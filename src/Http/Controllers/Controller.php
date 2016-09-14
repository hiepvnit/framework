<?php

namespace Mage2\Framework\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $websiteId;
    public $defaultWebsiteId;
    public $isDefaultWebsite;

    //public $theme;

    public function __construct() {

        //$path = realpath(base_path('themes/mage2/default'));
        //View::addLocation($path);
        $this->middleware(function ($request, $next) {
            $this->websiteId = Session::get('website_id');
            $this->defaultWebsiteId = Session::get('default_website_id');
            $this->isDefaultWebsite = Session::get('is_default_website');
            
             return $next($request);
        });
    }

}
