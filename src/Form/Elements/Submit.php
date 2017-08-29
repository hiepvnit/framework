<?php
namespace Mage2\Framework\Form\Elements;

use Illuminate\Support\Collection;
use Mage2\Framework\Form\Element;

class Submit extends Element {

    public function render() {
        return view('mage2-framework::form.submit')->with('element', $this);
    }
}