<?php

namespace Code4\Platform\Components\Users;

use Code4\Forms\AbstractForm;

class CreateUserForm extends AbstractForm {

    protected $messages = [
        'email' => 'EMAIL'
    ];

    public function __construct() {
        parent::__construct();

        $this->loadFromConfigYaml(__DIR__ . '/createUser.yml');
    }



}