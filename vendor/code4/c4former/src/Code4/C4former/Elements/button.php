<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 21:00
 */

namespace Code4\C4former\Elements;

use Code4\C4former\BaseElement;
use Code4\C4former\ElementInterface;

class button extends BaseElement implements ElementInterface {

    protected $type = "button";

    public function render() {
        return \View::make('c4former::button', array('el'=>$this->attributes));
    }
}