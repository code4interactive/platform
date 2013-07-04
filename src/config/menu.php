<?php

return array(

    'topmenu' => array(
        'root' => array(
            1 => array(
                'id' => 'main',
                'name' => 'Strona główna',
                'url' => '#',//action('HomeController@getIndex'),
                'icon' => 'icon-home',
                'roles' => array('all'),
                'style' => 'purple',
                'sub-style' => 'navbar-pink'
            ),
            1000 => array (
                'id' => 'admin',
                'name' => 'Administracja',
                'url' => '#',
                'icon' => 'icon-cog',
                'roles' => array('all'),
                'style' => 'grey'
            )
        ),
        'admin' => array(
            1 => array(
                'id' => 'head',
                'name' => 'Header',
                'type' => 'sub-header',
                'icon' => '',
                'roles' => array('all')
            ),
            10 => array(
                'id' => 'userManagment',
                'name' => 'Użytkownicy',
                'url' => '',
                'icon' => 'icon-user',
                'roles' => array('all')
            )
        )
    ),

    'leftmenu' => array(
        'root' => array(
            1 => array(
                'id' => 'main',
                'name' => 'Strona główna',
                'url' => '#',//action('HomeController@getIndex'),
                'icon' => 'icon-home',
                'roles' => array('all'),
                'style' => 'purple',
                'sub-style' => 'navbar-pink'
            ),
            1000 => array (
                'id' => 'admin',
                'name' => 'Administracja',
                'url' => '#',
                'icon' => 'icon-cog',
                'roles' => array('all'),
                'style' => 'grey'
            )
        ),
        'admin' => array(
            1 => array(
                'id' => 'head',
                'name' => 'Header',
                'type' => 'sub-header',
                'icon' => '',
                'roles' => array('all')
            ),
            10 => array(
                'id' => 'userManagment',
                'name' => 'Użytkownicy',
                'url' => '',
                'icon' => 'icon-user',
                'roles' => array('all')
            )
        )
    )

);
