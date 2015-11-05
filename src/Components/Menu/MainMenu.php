<?php
namespace Code4\Platform\Components\Menu;

use Code4\Menu\AbstractMenu;

class MainMenu extends AbstractMenu {

    protected $checkRoles = false;
    protected $checkPermissions = false;
    protected $name = 'MainMenu';

    public function getConfig()
    {
        return $this->loadMenuFromYamlFile(app_path('../config').'/menu-main.yaml');
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasAccess($permission) {
        return true;
    }

    /**
     * @param $role
     * @return bool
     */
    public function inRole($role) {
        return true;
    }

}