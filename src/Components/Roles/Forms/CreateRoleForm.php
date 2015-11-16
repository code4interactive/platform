<?php

namespace Code4\Platform\Components\Roles\Forms;

use Code4\Forms\AbstractForm;

class CreateRoleForm extends AbstractForm {



    public function __construct() {

        parent::__construct();

        $this->loadFromConfigYaml(__DIR__ . '/createRole.yml');

    }


}