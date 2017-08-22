<?php
namespace Mage2\Framework\Attribute;


use Illuminate\Support\Collection;

class Attribute {

    public $attributes = NULL;


    public function __construct() {
        $this->attributes = Collection::make([]);
    }

    public function all($type) {

        $attributes = $this->attributes->filter(function ($item, $key) use ($type) {
            if($item->type == $type) {
                return true;
            }
        });

        return $attributes;
    }
}