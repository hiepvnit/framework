<?php
namespace Mage2\Framework\Form\Elements;

use Illuminate\Support\Collection;
use Mage2\Framework\Form\Element;

class Text extends Element {

    public function render() {
        return view('mage2-framework::form.text')->with('element', $this);
    }
}