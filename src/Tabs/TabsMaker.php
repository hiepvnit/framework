<?php
namespace Mage2\Framework\Tabs;

use Illuminate\Support\Collection;

class TabsMaker
{
    protected $adminTabs;

    public function __construct()
    {
        $this->adminTabs = Collection::make([]);
    }

    public function add($key) {
        $tab = new Tab();
        $this->adminTabs->put($key, $tab);

        return $tab;
    }

    public function all($type = "product") {


        $tabs = $this->adminTabs->filter(function ($item, $key) use ($type) {
            if($item->type == $type) {
                return true;
            }
        });

        return $tabs;

    }
}
