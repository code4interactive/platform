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
                    //'icon' => Icons::$icon_home,
                    'icon' => IconFactory::get('home', 'fa-lg'),
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
                            'name' => 'Zarządzanie użytkownikami',
                            'type' => 'subHeader',
                            'icon' => Icons::$icon_user
                        ),
                        10 => array(
                            'id' => 'userManagment',
                            'name' => 'Lista użytkowników',
                            'url' => \URL::action('Code4\Platform\Controllers\Administration_Users@getUsers'),
                            'icon' => Icons::$icon_user
                        ),
                        11 => array(
                            'id' => 'userAdd',
                            'name' => 'Dodaj użytkownika',
                            'url' => \URL::action('Code4\Platform\Controllers\Administration_Users@addUser'),
                            'icon' => Icons::$icon_plus
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
                    //'icon' => Icons::$icon_home,
                    'icon' => IconFactory::get('home', 'fa-lg'),
                    'class' => 'purple',
                    'children' => null,
                    'childrenClass' => null
                ),
                10 => array (
                    'id' => 'tests',
                    'name' => 'Testy',
                    'type' => null,
                    'url' => '#',
                    //'icon' => Icons::$icon_cog,
                    'icon' => IconFactory::get('cog', 'fa-lg'),
                    'class' => 'grey',
                    'childrenClass' => null,
                    'children' => array(
                        1 => array(
                            'id' => 'datagridtest1',
                            'name' => 'Datagrid test1',
                            'url' => '/tests/datagridTest1',
                            //'icon' => Icons::$icon_user,
                            //'icon' => IconFactory::get('user', 'fa-lg'),
                        )
                    )
                ),
                100 => array (
                    'id' => 'admin',
                    'name' => 'Administracja',
                    'type' => null,
                    'url' => '#',
                    //'icon' => Icons::$icon_cog,
                    'icon' => IconFactory::get('cog', 'fa-lg'),
                    'class' => 'grey',
                    'childrenClass' => null,
                    'children' => array(
                        1 => array(
                            'id' => 'head',
                            'name' => 'Header',
                            'type' => 'subHeader',
                            //'icon' => Icons::$icon_user,
                            'icon' => IconFactory::get('user', 'fa-lg'),
                        ),
                        10 => array(
                            'id' => 'userManagment',
                            'name' => 'Użytkownicy',
                            'url' => '#',
                            'icon' => Icons::$icon_user,
                            'children' => array(
                                1 => array(
                                    'id' => 'head2',
                                    'name' => 'Header',
                                    'url' => '#'
                                ),
                                2 => array(
                                    'id' => 'head3',
                                    'name' => 'Header',
                                    'url' => '#',
                                    'children' => array(
                                        1 => array(
                                            'id' => 'head4',
                                            'name' => 'Header',
                                            'url' => '#'
                                        ),
                                        2 => array(
                                            'id' => 'head5',
                                            'name' => 'Header',
                                            'url' => '#'
                                        )
                                    )
                                )
                            )

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
        ),
        'shortcuts' => array(
            'settings' => array(
                'layout_template' => 'platform::menus.shortcuts.layout',
                'item_template' => 'platform::menus.shortcuts.item'
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
