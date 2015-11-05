<?php
namespace Code4\Platform\Components\Menu;

use Code4\Menu\AbstractMenu;

class ProfileMenu extends AbstractMenu {

    protected $checkRoles = false;
    protected $checkPermissions = false;
    protected $name = 'ProfileMenu';

    public function getConfig()
    {
        return $this->loadMenuFromYamlFile(app_path('../config').'/menu-profile.yaml');
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