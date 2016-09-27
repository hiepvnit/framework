<?php
namespace Mage2\Framework\View;

class AdminConfiguration {
    
    protected $adminConfiguration ;
    
    public function registerConfiguration($adminConfiguration) {
        $this->adminConfiguration[] = $adminConfiguration;
    }
    
    public function getAll() {
        return $this->adminConfiguration;
    }
}