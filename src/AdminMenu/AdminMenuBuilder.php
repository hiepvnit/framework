<?php

namespace Mage2\Framework\AdminMenu;

class AdminMenuBuilder
{
    protected $adminMenu;

    public function registerMenu($adminMenu)
    {
        $this->adminMenu[] = $adminMenu;
    }

    public function getMenuItems()
    {
        return $this->adminMenu;
    }
}
