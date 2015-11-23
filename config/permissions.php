<?php
//Uprawnienia
return [
    'users'    => [
        'name'        => 'Użytkownicy',
        'permissions' => [
            'users.index'           => 'Przeglądanie użytkowników',
            'users.create'          => 'Tworzenie użytkowników',
            'users.delete'          => 'Usuwanie użytkowników',
            'users.edit'            => 'Edycja użytkowników',
            'users.editemail'       => 'Zmień email',
            'users.editpermissions' => 'Zmień uprawnienia',
            'users.showinmenu'      => 'Pokaż w menu'
        ]
    ],
    'roles'    => [
        'name'        => 'Role',
        'permissions' => [
            'roles.index'           => 'Przeglądanie ról',
            'roles.create'          => 'Tworzenie ról',
            'roles.delete'          => 'Usuwanie ról',
            'roles.edit'            => 'Edycja ról',
            'roles.editpermissions' => 'Zmień uprawnienia',
            'roles.showinmenu'      => 'Pokaż w menu'
        ]
    ],
    'activity' => [
        'name'        => 'Komunikaty',
        'permissions' => [
            'activity.canEdit'      => 'Edycja komunikatów',
            'activity.canEditOwn'   => 'Może edytować swoje',
            'activity.canDelete'    => 'Może usuwać komunikaty',
            'activity.canDeleteOwn' => 'Może usuwać swoje'
        ]
    ]
];