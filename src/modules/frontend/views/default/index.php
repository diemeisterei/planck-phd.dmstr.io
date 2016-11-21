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



<div class="site-index">

    <?= \dmstr\modules\prototype\widgets\TwigWidget::widget([
        'id' => 'base',
    ]) ?>

</div>

