<?php

// return configuration overrides for modules
return [
    'defaultRoute' => 'frontend',
    'aliases' => [
        '@modules/frontend' => '@app/modules/frontend'
    ],
    'controllerMap' => [
        'app:migrate' => [
            'class' => 'dmstr\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/_migrations',
            'templateFile' => '@dmstr/db/mysql/templates/file-migration.php'
        ]
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views/layouts' => '@app/modules/frontend/views/layouts',
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                'docs/guide/<file:[a-zA-Z0-9_\-\./\+]+>' => 'docs/default/index',
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
        'user' => [
            'layout' => '@app/views/layouts/container',
        ],
    ],
    'params' => [
        'yii.migrations' => [
            '@app/modules/_migrations',
        ],
    ],
];
