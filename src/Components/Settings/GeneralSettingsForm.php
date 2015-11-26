<?php

namespace Code4\Platform\Components\Settings;

use Code4\Forms\AbstractForm;

class GeneralSettingsForm extends AbstractForm {

    public function __construct() {
        parent::__construct();
        $this->loadFromConfigYaml(__DIR__ . '/../../../config/general-settings.yaml');
    }

}