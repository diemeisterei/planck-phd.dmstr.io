<?php

use dmstr\widgets\Alert;
use modules\frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title = $this->title.' - '.getenv('APP_TITLE');

switch (Yii::$app->settings->get('registerPrototypeAsset', 'app.assets')) {
    case true:
        \dmstr\modules\prototype\assets\DbAsset::register($this);
        break;
    case null:
        Yii::$app->settings->set('registerPrototypeAsset', true, 'app.assets');
        Yii::$app->settings->deactivate('registerPrototypeAsset', 'app.assets');
    case false:
        AppAsset::register($this);
}

\rmrevin\yii\fontawesome\AssetBundle::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">

    <?= $this->render('_navbar') ?>
    <div class="alert-wrapper"><?= Alert::widget() ?></div>

    <?= $content ?>
</div>

<footer class="footer">

    <?= \dmstr\modules\prototype\widgets\TwigWidget::widget([
        'key' => '_footer',
    ]) ?>

    <div class="container">
        <p class="pull-right">
            <span class="label label-default"><?= YII_ENV ?></span>
        </p>
        <p class="pull-left">
            <?= Html::a(
                '<i class="fa fa-heartbeat"></i>',
                '#',
                ['data-toggle' => 'modal', 'data-target' => '#infoModal']
            ) ?>
        </p>
    </div>
</footer>

<!-- Info Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <?= $this->render('_modal') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
