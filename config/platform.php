<?php

return [
    'registeredProviders' => [
        \Code4\Platform\Models\Role::class,
        \Code4\Platform\Models\User::class
    ],
    'settingsBlocks' => [
        'general' => [
            'title' => 'Ogólne',
            'icon' => 'fa-gear',
            'form' => \Code4\Platform\Components\Settings\GeneralSettingsForm::class
        ],
        'general_user' => [
            'title' => 'Ogólne',
            'icon' => 'fa-gear',
            'form' => \Code4\Platform\Components\Settings\GeneralSettingsFormUser::class
        ]
    ]
];