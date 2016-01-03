<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model cs\base\BaseForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="col-lg-4 col-lg-offset-4">
        <h1 class="page-header"><?= Html::encode($this->title) ?></h1>

        <p>Пожалуйста заполните нижеследующие поля:</p>

        <?php $form = ActiveForm::begin([
            'id'                   => 'login-form',
            'enableAjaxValidation' => true,
        ]); ?>

        <?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => 'email']])->label('email', ['class' => 'hide']) ?>
        <?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => 'Пароль']])->label('Пароль', ['class' => 'hide'])->passwordInput() ?>
        <?= $model->field($form, 'rememberMe')->label('Запомнить меня') ?>

        <div class="form-group">
            <?= Html::submitButton('Войти', [
                'class' => 'btn btn-primary btn-lg',
                'name'  => 'login-button',
                'style' => 'width:100%;',
            ]) ?>
        </div>
        <hr>
        <p><a style="width: 100%;" class="btn btn-default btn-xs" href="<?= \yii\helpers\Url::to(['auth/password_recover']) ?>" >Восстановить пароль</a>

        <?php ActiveForm::end(); ?>
    </div>


</div>
