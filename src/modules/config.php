<?php

// DI
Yii::$container->set(
    'gitlab',
    function () {
        $gitlab = new \Gitlab\Client(Yii::$app->settings->get('url', 'api.gitlab'));
        $gitlab->authenticate(Yii::$app->settings->get('token', 'api.gitlab'), \Gitlab\Client::AUTH_URL_TOKEN);
        return $gitlab;
    }
);

Yii::$container->set(
    'github',
    function () {
        $client = new \Github\Client(
            new \Github\HttpClient\CachedHttpClient(array('cache_dir' => '/tmp/github-api-cache'))
        );
        $client->authenticate(Yii::$app->settings->get('token', 'api.github'), true);
        return $client;
    }
);


// return configuration overrides for modules
return [
    'defaultRoute' => 'frontend',
    'aliases' => [
        '@modules/frontend' => '@app/modules/frontend',
        '@dmstr/widgets/github' => '@app/modules/yii2-github-widgets/src',
    ],
    'controllerMap' => [
        'app:migrate' => [
            'class' => 'dmstr\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/_migrations',
            'templateFile' => '@dmstr/db/mysql/templates/file-migration.php'
        ]
    ],
    'components' => [
        'assetManager' => [
            'dirMode' => 0775,
            // Hashing for distributed systems
            'hashCallback' => \dmstr\helpers\AssetHash::byFileTimeAndLess(),
            // Note: You need to bundle asset with `yii asset` for development/debugging
            #'bundles' => $bundles,
            'basePath' => '@app/../web/assets',
        ],
        'urlManager' => [
            'rules' => [
                'docs/guide/<file:[a-zA-Z0-9_\-\./\+]+>' => 'docs/default/index',
                'docs/api/<file:[a-zA-Z0-9_\-\./\+]*>.html' => 'docs/html/index',
                'docs/api/<file:[a-zA-Z0-9_\-\./\+]*>' => 'docs/html/index',
                'docs/help/<file:[a-zA-Z0-9_\-\./\+]+>' => 'help/default/index',
                #'docs/help' => 'help/default/index',
            ]
        ],
        'view' => [
            'class' => 'yii\web\View',
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/modules/frontend/views',
                ],
            ],
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'globals' => [
                        'Url' => '\yii\helpers\Url',
                    ],
                    'extensions' => (getenv('TWIG_DEBUG_MODE')) ? [new Twig_Extension_Debug()] : null,
                    'options' => [
                        'debug' => (getenv('TWIG_DEBUG_MODE')) ? true : false,
                    ],
                ],
            ],
        ],
    ],
    'modules' => [
        'frontend' => [
            'class' => 'modules\frontend\Module',
        ],
        'docs' => [
            'class' => 'schmunk42\markdocs\Module',
            'layout' => '@app/views/layouts/container-fluid',
            'enableEmojis' => true
        ],
        'help' => [
            'class' => 'schmunk42\markdocs\Module',
            'layout' => '@app/views/layouts/container-fluid',
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
