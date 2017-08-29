<?php

namespace Mage2\Framework\Form;

use Illuminate\Support\Collection;
use Mage2\Framework\Form\Contracts\Form as FormContracts;
use Illuminate\Database\Eloquent\Model;

class Form implements FormContracts {



    /**
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = NULL;



    /**
     *
     * @var boolean $put
     */
    public $put = false;



    /**
     *
     * @var boolean $delete
     */
    public $delete = false;


    /**
     *
     * @var \Illuminate\Support\Collection
     */
    protected $elements = NULL;


    /**
     *
     * @var \Illuminate\Support\Collection
     */
    protected $attributes = NULL;

    public function __construct($model = null) {
        $this->elements = Collection::make([]);
        $this->attributes = Collection::make([]);
        $this->make($model);
    }

    /**
     * Add Elements into Form
     *
     * @param object $element
     * @return $this
     */
    public function addElement($element) {

        $this->elements->push($element);

        return $this;
    }


    public function elements() {
        return $this->elements;
    }
    /**
     * Get/Set the Action for the form.
     *
     * @param string|NULL $action
     * @return string $action
     */
    public function action($action = NULL){
        if(NULL == $action) {
            return $this->attributes->get('action');
        }

        $this->attributes->put('action', $action);

        return $this;
    }


    /**
     * Get/Set the method for the form.
     *
     * @param string|null $method
     * @return string|object $method|$this
     */
    public function method($method = NULL){


        if(NULL == $method) {
            return $this->attributes->get('method');
        }

        if('put' == strtolower($method)) {
            $this->put = true;
            $this->attributes->put('method', 'post');
        } elseif('delete' == strtolower($method)) {
            $this->delete = true;
            $this->attributes->put('method', 'post');
        } else {
            $this->attributes->put('method', $method);
        }

        return $this;

    }

    /**
     * Get the element from form Elements List.
     *
     * @param string $name
     * @return string|object $method|$this
     */
    public function get($name= NULL){

        dd($this->elements);

    }

    /**
     * Get/Set the Form Attributes.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function attribute($key , $value){
        $this->attributes->put($key, $value);

        return $this;
    }

    public function render() {
        return view('mage2-framework::form.form')->with('form', $this);
    }

}
