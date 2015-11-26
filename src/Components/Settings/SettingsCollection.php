<?php
namespace Code4\Platform\Components\Settings;

use Illuminate\Http\Request;
use Code4\Settings\SettingsFactory;
use Illuminate\Config\Repository;
use Illuminate\Support\Collection;

class SettingsCollection extends Collection {

    private $userId;
    private $config;

    /**
     * Stored settings configuration
     * @var array
     */
    private $blocks;

    /**
     * SettingsFactory
     * @var
     */
    private $settings;

    /**
     * @param $userId
     * @param Repository $config
     */
    public function __construct($userId, Repository $config) {
        $this->userId = $userId;
        $this->config = $config;
        $this->loadSettings();
    }

    public function config() {
        return $this->config;
    }


    /**
     * Returns configuration for blocks set in platform.php config file / settingsBlocks section
     * @param bool|false $user
     * @return array
     */
    public function settingsBlockConfiguration($user = false) {
        $blocks = [];
        foreach ($this->blocks as $blockName => $block) {
            //Tylko formsy usera
            $userBlock = strpos($blockName, '_user') !== false;
            if ($user && !$userBlock) {
                continue;
            }

            //Tylko formsy globalne
            if (!$user && $userBlock) {
                continue;
            }
            $blocks[$blockName] = $block;
        }
        return $blocks;
    }

    /**
     * Checks if block exists
     * @param $blockName
     * @return bool
     */
    public function hasBlock($blockName) {
        return array_key_exists($blockName, $this->blocks);
    }

    /**
     * @return SettingsFactory
     */
    public function settings() {
        return $this->settings;
    }

    public function loadSettings() {
        $this->blocks = $this->config->get('platform.settingsBlocks');
        $blocks = array_keys($this->blocks);

        //Ładowanie settingsów z bazy
        $this->settings = new SettingsFactory($blocks, $this->userId);
    }

    /**
     * Sets values in forms and returns forms for user or global
     * @param bool|false $user
     * @param null|array $blocks
     * @return array
     */
    public function prepareForm($user = false, $blocks = null) {

        $blocks = is_null($blocks) ? array_keys($this->blocks) : $blocks;

        //Set current values to fields
        $forms = [];
        foreach ($this->blocks as $blockName => $block) {

            //Only selected blocks
            if (!in_array($blockName, $blocks)) {
                continue;
            }

            $userBlock = strpos($blockName, '_user') !== false;
            //Tylko formsy usera
            if ($user && !$userBlock) {
                continue;
            }

            //Tylko formsy globalne
            if (!$user && $userBlock) {
                continue;
            }

            $forms[$blockName] = new $block['form'];

            foreach($forms[$blockName]->all() as $field) {
                $setting = $this->settings->get($blockName, !$user)->get($field->fieldName());
                $forms[$blockName]->get($field->fieldName())->value($setting);
            }

            $settings = $this->settings->get($blockName, !$user)->all();
            $forms[$blockName]->values($settings);
        }
        return $forms;
    }

    /**
     * @param string $block
     * @param bool|false $user
     * @return \Code4\Forms\AbstractForm
     */
    public function getForm($block, $user = false) {
        $forms = $this->prepareForm($user, [$block]);
        return $forms[$block];
    }

}