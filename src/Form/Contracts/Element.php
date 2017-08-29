<?php

namespace Mage2\Framework\Form\Contracts;

interface Element {

    /**
     * Get/Set the Element Name.
     *
     * @param string|NULL $name
     * @return string $name
     */
    public function name($name = NULL);


    /**
     * Get/Set the Element Attributes.
     *
     * @param string $key
     * @param string $value
     * @return object $this
     */
    public function attribute($key , $value);

    /**
     * Get/Set the Element Value.
     *
     * @param string|NULL $value
     * @return string $value
     */
    public function value($value = NULL);

    /**
     * Get/Set the Element Label.
     *
     * @param string|null $label
     * @return string $label
     */
    public function label($label = NULL);

}