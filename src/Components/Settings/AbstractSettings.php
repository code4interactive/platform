<?php

namespace Code4\Platform\Components\Settings;

use Code4\Forms\AbstractForm;
use Code4\Settings\Settings;

class AbstractSettings {

    private $blockName = '';
    private $globalSettingsForm = null;
    private $userSettingsForm = null;

    public function __construct($blockName) {
        $this->blockName = $blockName;
        $this->globalSettingsForm = new AbstractForm();
        $this->userSettingsForm = new AbstractForm();
    }

    /**
     * Returns form fields
     * @param bool|false $user
     * @return AbstractForm
     */
    public function fields($user = false) {
        if ($user) {
            return $this->uSettings();
        } else {
            return $this->gSettings();
        }
    }

    /**
     * Access to global settings form
     * @return AbstractForm
     */
    public function gSettings() {
        return $this->globalSettingsForm;
    }

    /**
     * Access to user settings form
     * @return AbstractForm
     */
    public function uSettings() {
        return $this->userSettingsForm;
    }

}