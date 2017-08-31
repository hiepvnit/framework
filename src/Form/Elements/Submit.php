<?php
namespace Mage2\Framework\Form\Elements;

use Illuminate\Support\Collection;
use Mage2\Framework\Form\Element;

class Submit extends Element
{


    /**
     * Callable function for submit button
     *
     * @string
     */
    protected $callable;


    public function __construct($name = NULL, $callable = NULL)
    {
        parent::__construct($name);

        if(is_callable($callable)) {
            $this->isCallable(true);
        }
        $this->callable = $callable;
    }

    public function executeCallback()
    {

        $return = $this->callable;

        if (is_callable($return)) {
            return $return();
        }

        return "";
    }

    public function render()
    {
        return view('mage2-framework::form.submit')->with('element', $this);
    }
}