<?php
namespace Mage2\Framework\Attribute;


use Illuminate\Support\Collection;

class AttributeCollection {

    public $attributes = NULL;


    public function __construct() {

        $this->attributes = Collection::make([]);

    }

    public function all($type = 'product') {
        return $this->attributes;
    }
}