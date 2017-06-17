<?php

namespace Mage2\Framework\Search;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchManager
{

    public function indexed() {
        return $this;
        echo "DO PAGE INDEX HERE";
    }

}