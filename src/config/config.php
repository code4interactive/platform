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
        )
    );
