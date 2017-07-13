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

    public function registerTab()
    {
       dd('here');
    }

    public function getMenuItems()
    {
        return $this->adminTabs->all();
    }
}
