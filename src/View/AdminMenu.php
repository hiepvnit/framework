<?php

namespace Mage2\Framework\View;

class AdminMenu
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
