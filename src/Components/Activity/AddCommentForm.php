<?php

namespace Code4\Platform\Components\Activity;

use Code4\Forms\AbstractForm;

class AddCommentForm extends AbstractForm {

    public function __construct() {
        parent::__construct();
        $this->input('message')->rules('required|min:3')->title('Komentarz');
        $this->input('threadId')->rules('required');
    }



}
