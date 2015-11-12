<?php
return [

    'paths' => [
        'production' => [
            public_path() . '/platform/prod' => '/platform/prod',
            public_path() . '/prod' => '/prod',
            public_path() . '' => ''
        ],
        'default' => [
            public_path() . '/platform/build' => '/platform/build',
            public_path() . '/build' => '/build',
            public_path() . '' => ''
        ]
    ]

];