<?php

namespace Code4\Platform\Components\Users;

use Code4\Forms\AbstractForm;

class EditUserForm extends AbstractForm {

    public function __construct() {
        parent::__construct();

        $this->loadFromConfigYaml(__DIR__ . '/editUser.yml');
    }



}