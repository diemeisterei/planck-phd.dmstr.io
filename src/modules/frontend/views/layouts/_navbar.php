<?php

namespace app\views\layouts;

use dmstr\modules\pages\models\Tree;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

$menuItems = [];
$languageItems = [];

// create label for dev and test environment
switch (YII_ENV) {
    case 'dev':
    case 'test':
        $envLabel = "<span class='label label-warning'>".YII_ENV.'</span>';
        break;
    default:
        $envLabel = '';
}

$debugLabel = YII_DEBUG ? "<span class='label label-danger'>DEBUG</span>" : '';

$menuItems[] = [
    'label' => $envLabel.' '.$debugLabel,
];

foreach (\Yii::$app->urlManager->languages as $language) {
    $languageItems[] = [
        'url' => ['/', \Yii::$app->urlManager->languageParam => $language],
        'label' => $language,
    ];
}

$menuItems[] = [
    'label' => '<i class="glyphicon glyphicon-globe"></i> ',
    'options' => ['id' => 'link-languages-menu'],
    'items' => $languageItems,
];

if (\Yii::$app->hasModule('user')) {
    if (\Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
        $menuItems[] = [
            'label' => 'Login',
            'url' => ['/user/security/login'],
            'linkOptions' => ['id' => 'link-login'],
        ];
    } else {
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-user"></i> '.\Yii::$app->user->identity->username,
            'options' => ['id' => 'link-user-menu'],
            'items' => [
                [
                    'label' => '<i class="glyphicon glyphicon-user"></i> Profile',
                    'url' => ['/user/profile/show', 'id' => \Yii::$app->user->id],
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-cog"></i> Settings',
                    'url' => ['/user/settings/profile'],
                ],
                '<li class="divider"></li>',
                [
                    'label' => '<i class="glyphicon glyphicon-log-out"></i> Logout',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post', 'id' => 'link-logout'],
                ],
            ],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-pencil"></i>',
            'visible' => \Yii::$app->user->can('backend_default_index', ['route' => true]),
            'items' => \Yii::$app->params['context.menuItems'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-dashboard"></i>',
            'url' => ['/backend'],
            'visible' => \Yii::$app->user->can('backend_default_index', ['route' => true]),
            'items' => Tree::getMenuItems('backend', true, Tree::GLOBAL_ACCESS_DOMAIN),
        ];
    }
}

NavBar::begin(
    [
        'brandLabel' => getenv('APP_TITLE'),
        'brandUrl' => \Yii::$app->homeUrl,
        'innerContainerOptions' => [
          'class' => 'container-fluid'
        ],
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]
);

echo Nav::widget(
    [
        'options' => ['class' => 'navbar-nav'],
        'encodeLabels' => false,
        'items' => \dmstr\modules\pages\models\Tree::getMenuItems('root'),
    ]
);

echo Nav::widget(
    [
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]
);

NavBar::end();
