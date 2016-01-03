<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Мои заказы';
?>
<div class="site-contact">
    <h1 class="page-header"><?= Html::encode($this->title) ?></h1>

    <div class="col-lg-6 row">
        <?php
        $c = 1;
        foreach ($items as $item) {
            $product = \app\models\Product::find($item['product_id']);
            ?>
            <a href="javascript:void(0);" class="list-group-item" id="newsItem-<?= $item['id'] ?>">
                <h4><?= $product->getField('name') ?></h4>

                <div class="row">
                    <div class="col-lg-3">
                        <img src="<?= $product->getField('image') ?>" class="thumbnail" width="120">
                    </div>

                    <div class="col-lg-9">
                        <p><?= \Yii::$app->formatter->asDatetime($item['datetime']) ?></p>
                        <p><span class="label label-info"><?= \app\models\Request::$statusList[$item['status']] ?></span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                <span class="sr-only">20% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php
            $c++;
        }?>
    </div>

</div>
