<?php

namespace app\views\layouts;

use dmstr\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

$menuItems = [];
$menuItems[] = [
    'label' => '<i class="fa fa-rocket"></i> TL;dr',
    'url' => 'https://github.com/phundament/app',
    'linkOptions' => ['data-toggle' => 'modal', 'data-target' => '#tldrModal'],
    'visible' => true
];

$menuItems[] = [
    'label' => '<i class="fa fa-github-alt"></i> GitHub',
    'url' => 'https://github.com/phundament/app',
    'visible' => true
];

if (\Yii::$app->hasModule('user')) {
    if (\Yii::$app->user->isGuest) {
        #$menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
    } else {
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-user"></i> '.\Yii::$app->user->identity->username,
            'options' => ['id' => 'link-user-menu'],
            'items' => [
                [
                    'label' => '<i class="glyphicon glyphicon-user"></i> Profile',
                    'url' => ['/user/profile/show', 'id' => \Yii::$app->user->id],
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
            'label' => '<i class="glyphicon glyphicon-cog"></i>',
            'url' => ['/backend'],
            'visible' => \Yii::$app->user->can(
                    'backend_default'
                ) || (isset(\Yii::$app->user->identity) && \Yii::$app->user->identity->isAdmin),
        ];
    }
}

NavBar::begin(
    [
        #'brandLabel' => getenv('APP_TITLE'),
        'brandLabel' => '<i class="fa fa-heart"></i>',
        'brandUrl' => \Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]
);
echo Nav::widget(
    [
        'options' => ['class' => 'navbar-nav'],
        'encodeLabels' => false,
        'items' => \dmstr\modules\pages\models\Tree::getMenuItems('root_'.\Yii::$app->language),
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

?>

<!-- Info Modal -->
<div class="modal fade" id="tldrModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="text-center">

                    <h3>One-liner</h3>
                    <p>
                        This will download a demo stack with <code>curl</code> and pipe it directly to <code>docker-compose</code>,
                        whichmka starts the containers in a <b>tldr</b> project stack.
                    </p>
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea style="width: 100%" rows="4">curl https://raw.githubusercontent.com/phundament/playground/master/stacks/app-demo/docker-compose.yml | docker-compose -f - -p tldr up</textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

