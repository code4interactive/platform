<?php

return array(

    'platform' => array(
        '_description' => 'Uprawnienia platformy',
        '_permissions' => array(
            'users' => array(
                '_description' => 'Uprawnienia użytkownika',
                '_permissions' => array(
                    'create' => 'Utwórz użytkownika',
                    'edit' => 'Edytuj ...'
                )
            ),
            'settings' => array(
                '_description' => 'Uprawnienia ustawień',
                '_permissions' => array(
                    'edit' => 'Edytuj ustawienia',
                    'custom' => 'Własne upawnienie'
                )
            )
        )
    )
);