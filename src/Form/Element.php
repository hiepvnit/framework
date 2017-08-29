<?php

namespace Mage2\Framework\Form;

use Illuminate\Support\Collection;
use Mage2\Framework\Form\Contracts\Element as ElementContracts;

class Element implements ElementContracts
{


    /**
     *
     * @var \Illuminate\Support\Collection
     */
    public $attributes = null;


    public function __construct($name = null)
    {


        $this->attributes = Collection::make([]);
        $this->name($name);
    }

    /**
     * Get/Set the Element Name.
     *
     * @param string|NULL $name
     * @return string $name
     */
    public function name($name = NULL)
    {

        if (NULL === $name) {
            return $this->attributes->get('name');

        }
        $this->attributes->put('name', $name);

        return $this;
    }


    /**
     * Get/Set the Element Attributes.
     *
     * @param string $key
     * @param string $value
     * @return array $attributes
     */
    public function attribute($key, $value)
    {
        $this->attributes->put($key, $value);
        return $this;
    }

    /**
     * Get/Set the Element Value.
     *
     * @param string|NULL $value
     * @return string $value
     */
    public function value($value = NULL)
    {
        if (NULL === $value) {
            return $this->attributes->get('value');
        }
        $this->attributes->put('value', $value);

        return $this;

    }


    /**
     * Get/Set the Element Value.
     *
     * @param string|NULL $value
     * @return string $value
     */
    public function attributeToString()
    {
        $attributeToString = "";
        foreach($this->attributes as $key => $value) {
            $attributeToString .= $key . "=" . $value . " ";
        }

        return $attributeToString;

    }

    /**
     * Get/Set the Element Label.
     *
     * @param string|null $label
     * @return string $label
     */
    public function label($label = NULL)
    {

        if (NULL === $label) {
            return $this->attributes->get('label');
        }
        $this->attributes->put('label', $label);

        return $this;

    }
}