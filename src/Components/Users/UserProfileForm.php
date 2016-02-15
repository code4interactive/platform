<?php

namespace Code4\Platform\Components\Users;

use Code4\Forms\AbstractForm;

class UserProfileForm extends AbstractForm {

    //Opcjonalna lista nazw pól które mają pojawiać się w komunikatach
    protected $messages = [
        'email' => 'EMAIL'
    ];

    public function __construct() {
        parent::__construct();
        $this->loadFromConfigYaml(__DIR__ . '/Forms/user_profile_form.yaml');
    }
}