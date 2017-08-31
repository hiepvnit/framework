<?php
namespace Mage2\Framework\Form\Elements;

use Illuminate\Support\Collection;
use Mage2\Framework\Form\Element;

class Textarea extends Element {

    public function render() {
        return view('mage2-framework::form.textarea')->with('element', $this);
    }

    public function attributeToString($expect = []) {
        return parent::attributeToString(['value']);
    }
}