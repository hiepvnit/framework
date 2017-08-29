<?php
namespace Mage2\Framework\Form\Elements;

use Illuminate\Support\Collection;
use Mage2\Framework\Form\Element;

class Select extends Element {

    /**
     * List of Select options
     * @var null
     */
    public $options = null;

    public function options($options = []) {

        if(count($options) <= 0) {
            return $this->options;
        }

        $this->options = $options;
        return $this;
    }


    public function render() {
        return view('mage2-framework::form.select')->with('element', $this);
    }
}