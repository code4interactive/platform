<?php

return array(

        'topMenu' => array(
            'settings' => array(
                'layout_template' => 'platform::menus.topMenu.layout',
                'item_template' => 'platform::menus.topMenu.item'
            ),
            'items' => array(
                0 => array(
                    'id' => 'main',
                    'name' => 'Strona główna',
                    'type' => 'default',  //or null
                    'url' => '#',
                    'icon' => Icons::$icon_home,
                    'class' => 'purple',
                    'children' => null,
                    'childrenClass' => null
                ),
                100 => array (
                    'id' => 'admin',
                    'name' => 'Administracja',
                    'type' => null,
                    'url' => '#',
                    'icon' => Icons::$icon_cog,
                    'class' => 'grey',
                    'childrenClass' => null,
                    'children' => array(
                        1 => array(
                            'id' => 'head',
                            'name' => 'Header',
                            'type' => 'subHeader',
                            'icon' => Icons::$icon_user
                        ),
                        10 => array(
                            'id' => 'userManagment',
                            'name' => 'Użytkownicy',
                            'url' => \URL::action('Code4\Platform\Controllers\Administration_Users@getUsers'),
                            'icon' => Icons::$icon_user
                        ),
                        11 => array(
                            'id' => 'userAdd',
                            'name' => 'Add user',
                            'url' => 'addUser',
                            'icon' => Icons::$icon_user
                        ),
                    )
                )
            )
        ),
        'leftMenu' => array(
            'settings' => array(
                'layout_template' => 'platform::menus.leftMenu.layout',
                'item_template' => 'platform::menus.leftMenu.item'
            ),
            'items' => array(
                0 => array(
                    'id' => 'main',
                    'name' => 'Strona główna',
                    'type' => 'default',  //or null
                    'url' => '#',
                    'icon' => Icons::$icon_home,
                    'class' => 'purple',
                    'children' => null,
                    'childrenClass' => null
                ),
                100 => array (
                    'id' => 'admin',
                    'name' => 'Administracja',
                    'type' => null,
                    'url' => '#',
                    'icon' => Icons::$icon_cog,
                    'class' => 'grey',
                    'childrenClass' => null,
                    'children' => array(
                        1 => array(
                            'id' => 'head',
                            'name' => 'Header',
                            'type' => 'subHeader',
                        ),
                        10 => array(
                            'id' => 'userManagment',
                            'name' => 'Użytkownicy',
                            'url' => '#',
                            'icon' => Icons::$icon_user
                        )
                    )
                )
            )
        ),
        'breadcrumbs' => array(
            'settings' => array(
                'layout_template' => 'platform::menus.breadcrumbs.layout',
                'item_template' => 'platform::menus.breadcrumbs.item'
            ),
            'items' => array(
                0 => array(
                    'id' => 'home',
                    'name' => 'Home',
                    'icon' => Icons::$icon_home,
                    'url' => 'platformHome'
                )
            )
        ),
        'sidebarShortcuts' => array(
            'settings' => array(
                'layout_template' => 'platform::menus.sidebarShortcuts.layout',
                'item_template' => 'platform::menus.sidebarShortcuts.item'
            ),
            'items' => array(
                0 => array(
                    'id' => 'dashboard',
                    'name' => 'Dashboard',
                    'icon' => Icons::$icon_dashboard,
                    'url' => 'dashboard',
                    'class' => 'btn-success tooltip-success'
                ),
                1 => array(
                    'id' => 'pencil',
                    'name' => 'Pencil',
                    'icon' => Icons::$icon_pencil,
                    'url' => 'dashboard',
                    'class' => 'btn-info tooltip-info'
                ),
                2 => array(
                    'id' => 'group',
                    'name' => 'Group',
                    'icon' => Icons::$icon_group,
                    'url' => 'dashboard',
                    'class' => 'btn-warning tooltip-warning'
                ),
                3 => array(
                    'id' => 'cogs',
                    'name' => 'Cogs',
                    'icon' => Icons::$icon_cogs,
                    'url' => '#',
                    'class' => 'btn-danger tooltip-error'
                )
            )
        )
    );
