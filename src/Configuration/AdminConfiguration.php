<?php

namespace Mage2\Framework\Configuration;

class AdminConfiguration
{
    protected $adminConfiguration;

    public function registerConfiguration($adminConfiguration)
    {
        $this->adminConfiguration[] = $adminConfiguration;
    }

    public function All()
    {
        return $this->adminConfiguration;
    }
}
