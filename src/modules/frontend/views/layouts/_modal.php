<?php

use yii\helpers\Html;

?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
            <div class="">

                <h3><?= getenv('APP_NAME') ?></h3>

                <p>
                    Application Version <b><?= getenv('APP_NAME') ?>-<?= APP_VERSION ?></b><br>
                    Virtual Host <b><?= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '' ?></b><br/>
                    Hostname <b><?= getenv('HOSTNAME') ?: 'local' ?></b>
                </p>

                <p class="small">
                    Build with <?= Html::a('phd5', 'http://phd.dmstr.io') ?>
                </p>

                <hr/>

                <div class="pull-right">
                    <?= Html::a('Backend', ['/backend'], ['class' => 'btn btn-default btn-xs']) ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
