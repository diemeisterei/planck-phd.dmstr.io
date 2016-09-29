<?php

namespace _;

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title .= 'Home';
?>

<?php

$client = new \Github\Client(new \Github\HttpClient\CachedHttpClient(['cache_dir' => '/app/runtime/github-api-cache']));
$releasePhd4 = $client->api('repo')->releases()->latest('phundament', 'app');
$releasePhd5 = $client->api('repo')->releases()->latest('dmstr', 'phd5-app');
$releaseNano = $client->api('repo')->releases()->latest('dmstr', 'planck');
\Yii::trace($releaseNano);
?>

<header>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h1>
                        phd
                    </h1>
                    <p>
                        phd is a holistic web-application template implementation, aiming on flexibility,
                        modularization, performance and security on a minimal codebase.
                    </p>
                    <p>
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=phundament&repo=app&type=star&count=true&size=large"
                            frameborder="0" scrolling="0" width="130px" height="30px"></iframe>
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=phundament&repo=app&type=fork&count=true&size=large"
                            frameborder="0" scrolling="0" width="158px" height="30px"></iframe>
                    </p>
                    <hr>
                    <h4>Project resources</h4>
                    <p class="icons">
                        <?= Html::a(FA::icon(FA::_GITHUB_ALT), 'http://github.com/dmstr') ?>
                        <?= Html::a(FA::icon(FA::_BOOK), '/docs') ?>
                        <?= Html::a(FA::icon(FA::_TWITTER), 'http://twitter.com/diemeisterei') ?>
                        <?= Html::a(
                            FA::icon(FA::_STACK_OVERFLOW),
                            'http://stackoverflow.com/questions/tagged/phundament?sort=votes&pageSize=50'
                        ) ?>
                        <!--<?= Html::a(FA::icon(FA::_GOOGLE_PLUS_SQUARE), 'http://googleplus.com/dmstr') ?>-->
                    </p>
                    <hr>
                    <h4>Technology stack</h4>
                    <div class="technology">
                        <iframe src="https://ghbtns.com/github-btn.html?user=docker&repo=docker&type=star&count=true"
                                frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        Docker
                    </div>
                    <div class="technology">
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=docker&repo=compose&type=star&count=true"
                            frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        docker-compose
                    </div>
                    <div class="technology">
                        <iframe src="https://ghbtns.com/github-btn.html?user=php&repo=php-src&type=star&count=true"
                                frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        PHP
                    </div>
                    <div class="technology">
                        <iframe src="https://ghbtns.com/github-btn.html?user=nginx&repo=nginx&type=star&count=true"
                                frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        nginx
                    </div>
                    <div class="technology">
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=composer&repo=composer&type=star&count=true"
                            frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        composer
                    </div>
                    <div class="technology">
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=yiisoft&repo=yii2&type=star&count=true"
                            frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        Yii 2.0 Framework
                    </div>

                    <div class="technology">
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=vlucas&repo=phpdotenv&type=star&count=true"
                            frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        phpdotenv
                    </div>
                    <div class="technology">
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=almasaeed2010&repo=adminlte&type=star&count=true"
                            frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        AdminLTE
                    </div>
                    <div class="technology">
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=dektrium&repo=yii2-user&type=star&count=true"
                            frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        dektrium\user
                    </div>
                    <div class="technology">
                        <iframe
                            src="https://ghbtns.com/github-btn.html?user=schmunk42&repo=yii2-giiant&type=star&count=true"
                            frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                        giiant code-generator
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-1">
                    <h2>dmstr/planck <span class="label label-default"><?= $releaseNano['tag_name'] ?></span></h2>
                    <p>
                        The zero source-code quick-starter repo
                    </p>
                    <h4>Get it.</h4>

                    <div>
                        <?= \yii\helpers\Html::a(
                            "Download",
                            $releaseNano['zipball_url'],
                            ['class' => 'btn btn-success btn-lg']
                        ) ?>
                    </div>

                    <h4>Run it.</h4>
                    <?php
                    $code = <<<CODE
cp .env-dist .env
docker-compose run --rm php yii app/setup
docker-compose up -d
CODE;

                    ?>
                    <pre><code><?= $code ?></code></pre>

                    <h4>Like it.</h4>

                    Open <code>http://docker:21080</code>

                    <hr>

                    <h2>dmstr/phd5-app <span class="label label-default"><?= $releasePhd5['tag_name'] ?></span></h2>
                    <p>
                        Template source-code
                    </p>
                    <?php
                    $code = <<<CODE
git clone https://github.com/dmstr/phd5-app
cd app
make all
CODE;
                    ?>
                    <pre><code><?= $code ?></code></pre>

                    <h2>dmstr/phd4-app <span class="label label-default"><?= $releasePhd4['tag_name'] ?></span></h2>
                    <p>
                        Template source-code
                    </p>
                    <?php
                    $code = <<<CODE
git clone https://github.com/phundament/app
cd app
make all
CODE;
                    ?>
                    <pre><code><?= $code ?></code></pre>
                    <hr>
                    <p>
                        See <?= Html::a(
                            'docs',
                            'https://github.com/phundament/docs/blob/master/6-tutorials/installation-composer.md'
                        ) ?> for alternative <code>composer</code> installation.
                    </p>
                </div>
            </div>
        </div>
</header>

<div class="site-index">

    <?= \dmstr\modules\prototype\widgets\HtmlWidget::widget(['enableFlash' => true]) ?>

</div>

<!-- Place this tag right after the last button or just before your close body tag. -->
<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>