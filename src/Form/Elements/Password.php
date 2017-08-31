<?php
namespace Mage2\Framework\Form\Elements;

use Illuminate\Support\Collection;
use Mage2\Framework\Form\Element;

class Password extends Element {

    public function render() {
        return view('mage2-framework::form.password')->with('element', $this);
    }
}