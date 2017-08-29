<?php

namespace Mage2\Framework\Form\Contracts;

interface Form {

    /**
     * Get/Set the Action for the form.
     *
     * @param string|NULL $action
     * @return string $action
     */
    public function action($action = NULL);


    /**
     * Get/Set the method for the form.
     *
     * @param null|string $method
     * @return string $post
     */
    public function method($method = null);


    /**
     * Get/Set the Form Attributes.
     *
     * @param string $key
     * @param string $value
     * @return array $attributes
     */
    public function attribute($key , $value);

}