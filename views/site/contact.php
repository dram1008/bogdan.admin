<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;

$page = \app\models\Page::find(2);
?>
<div class="box">

    <h1 class="title"><?= $page->getField('header') ?></h1>

    <div class="one-third">
        <div class="outer none"><span class="inset"><img src="<?= $page->getField('image') ?>" ></span></div>
    </div>

    <div class="two-third last">
        <?= $page->getField('content') ?>
    </div>
    <div class="clear"></div>

</div>
