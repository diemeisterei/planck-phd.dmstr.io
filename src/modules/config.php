<?php

// return configuration overrides for modules
return [
    'defaultRoute' => 'frontend',
    'aliases' => [
        '@modules/frontend' => '@app/modules/frontend'
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views/layouts' => '@modules/frontend/views/layouts',
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                'docs/guide/<file:[a-zA-Z0-9_\-\./\+]*>.html' => 'docs/default/index',
                'docs/guide/<file:[a-zA-Z0-9_\-\./\+]*>' => 'docs/default/index',
                'docs/api/<file:[a-zA-Z0-9_\-\./\+]*>.html' => 'docs/html/index',
                'docs/api/<file:[a-zA-Z0-9_\-\./\+]*>' => 'docs/html/index',
            ]
        ]
    ],
    'modules' => [
        'frontend' => [
            'class' => 'modules\frontend\Module',
        ],
        'docs' => [
            'class' => 'schmunk42\markdocs\Module',
            'layout' => '@app/views/layouts/container',
            'enableEmojis' => true
        ],
    ],
];
