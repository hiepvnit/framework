<?php
namespace Mage2\Framework\AdminMenu;

use Illuminate\Support\Collection;

class AdminMenuBuilder
{
    protected $adminMenu;

    public function __construct()
    {
        $this->adminMenu = Collection::make([]);
    }

    public function registerMenu($menuKey, $adminMenu)
    {
        if ($this->adminMenu->has($menuKey)) {

            $item = $this->adminMenu->get($menuKey);
            $mergeMenuItems = array_merge_recursive($item, $adminMenu);

            if($menuKey == 'mage2-catalog') {
                //var_dump($adminMenu);
                //var_dump($item);
                //var_dump($adminMenu);
                //dd($mergeMenuItems);
                //dd($this->adminMenu);
            }
            $this->adminMenu->put($menuKey, $mergeMenuItems);
        } else {
            $this->adminMenu->put($menuKey, $adminMenu);
        }
    }

    public function getMenuItems()
    {
        //dd($this->adminMenu);
        return $this->adminMenu->all();
    }
}
