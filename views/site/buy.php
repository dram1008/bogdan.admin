<?php

/* @var $this yii\web\View */
/* @var $model \cs\base\BaseForm */
/* @var $id int product_id bog_shop_product.id */

$this->title = 'Заказ';
$product = \app\models\Shop\Product::find($id);
$productPrice = $product->getField('price');
$this->registerJs(<<<JS
    $('.field-request-address').hide();
    $('input[name="Request[dostavka]"]').on('change', function() {
        var newPrice;
        if ($(this).val() == 3 || $(this).val() == 4) {
            $('.field-request-address').show();
            newPrice = productPrice + 300;
        } else {
            $('.field-request-address').hide();
            newPrice = productPrice;
        }
        $('#productPriceForm').attr('value', newPrice);
        $('#productPrice').html(newPrice);
    });
    $('.paymentType').click(function () {
        $('#paymentType').attr('value', $(this).data('value'));
        if (!$(this).hasClass('active')) {
            $('.paymentType').removeClass('active');
            $(this).addClass('active');
        }
    });
    $('.buttonSubmit').click(function() {
        // проверка формы
        var val = $('input[name="Request[dostavka]"]').val();
        if (val == 3 || val == 4) {
            if ($('textarea[name="Request[address]"]').val() == '') {
                alert('Поле нужно заполнить обязательно');
                return false;
            }
        }
        ajaxJson({
            url: '/buy/ajax',
            data: {
                id: {$product->getId()},
                comment: $('#request-comment').val(),
                dostavka: $('input[name="Request[dostavka]"]').val(),
                price: $('input[name="sum"]').val(),
                address: $('#request-address').val()
            },
            success: function(ret) {
                $('#formPayLabel').val('bogdan.' + ret);
                $('#formPay').submit();
            }

        });
    })
JS
);
$this->registerJs(<<<JS
    var productPrice = {$productPrice};
JS
    , \yii\web\View::POS_HEAD);
?>



<!-- About Section -->
<section id="about" class="container content-section" style="margin-top: 50px;margin-bottom: 100px;">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2 class="text-center">Получение подарка</h2>

            <div class="row" style="margin-bottom: 50px;">
                <div class="col-lg-12">
                    <img src="<?= $product->getImage() ?>" width="100" style="float: left; margin-right: 20px;"/>
                    <?= $product->getField('name') ?>
                </div>
            </div>


            <div class="row" id="blockLogin"<?php if (!Yii::$app->user->isGuest) echo(' style="display: none;"') ?>>
                <div class="col-lg-12" style="padding-bottom: 30px;">
                    Вы не авторизованы. Если вы в первый раз на нашем сайте, то зарегистрируйтесь. Или войдит если у вас есть логин.
                </div>
                <div class="col-lg-6">
                    Вход
<!--                    <input class="form-control" type="text" width="100%" name="login" id="formLoginUserName">-->
<!--                    <input class="form-control" type="password" width="100%" name="password" id="formLoginPassword">-->
                    <?php
                    $form = \yii\bootstrap\ActiveForm::begin([
                        'id'                 => 'login-form',
                        'enableClientScript' => false,
                    ]);
                    $model2 = new \app\models\Auth\Login();
                    ?>

                    <?= $form->field($model2, 'username', ['inputOptions' => ['placeholder' => 'Логин']])->label('', ['class' => 'hide']) ?>
                    <?= $form->field($model2, 'password', ['inputOptions' => ['placeholder' => 'Пароль']])->label('', ['class' => 'hide'])->passwordInput() ?>

                    <?php \yii\bootstrap\ActiveForm::end(); ?>
                    <button class="btn btn-default" id="buttonLogin" style="width: 100%;">Войти</button>

                    <?php
                    $this->registerJs(<<<JS
                        $('#buttonLogin').click(function(){
                            if ($('#login-username').val() == '') {
                                $('.field-login-username').addClass('has-error');
                                $('.field-login-username .help-block').show().html('Нужно заполнить логин');

                                return false;
                            }
                            if ($('#login-password').val() == '') {
                                $('.field-login-password').addClass('has-error');
                                $('.field-login-password .help-block').show().html('Нужно заполнить пароль');

                                return false;
                            }
                            ajaxJson({
                                url: '/loginAjax',
                                data: {
                                    login: $('#login-username').val(),
                                    password: $('#login-password').val()
                                },
                                success: function(ret) {
                                    $('#blockLogin').hide();
                                    $('#blockOrder').show();
                                    $('#blockProfileLi').html($('#menuProfile').clone().show().removeAttr('id'));
                                    $('#blockProfileLi .buttonMain').click(function() {
                                        window.location = '/requests';
                                    });
                                },
                                errorScript: function(ret) {
                                    if (ret.id == 101) {
                                        $('.field-login-username').addClass('has-error');
                                        $('.field-login-username .help-block').show().html(ret.data);
                                    }
                                    if (ret.id == 102) {
                                        $('.field-login-password').addClass('has-error');
                                        $('.field-login-password .help-block').show().html(ret.data);
                                    }
                                }
                            });

                        });
                        $('#login-username').on('focus', function() {
                            $('.field-login-username').removeClass('has-error');
                            $('.field-login-username .help-block').hide();
                        });
                        $('#login-password').on('focus', function() {
                            $('.field-login-password').removeClass('has-error');
                            $('.field-login-password .help-block').hide();
                        });
JS
);
                    ?>
                </div>
                <div class="col-lg-6">
                    Регистрация
                    <?php
                    $form = \yii\bootstrap\ActiveForm::begin([
                        'id'                 => 'rigistration-form',
                        'enableClientScript' => false,
                    ]);
                    $model2 = new \app\models\Auth\Regisration();
                    ?>

                    <?= $form->field($model2, 'name', ['inputOptions' => ['placeholder' => 'Имя (Фамилия)']])->label('', ['class' => 'hide']) ?>
                    <?= $form->field($model2, 'username', ['inputOptions' => ['placeholder' => 'Логин/почта']])->label('', ['class' => 'hide']) ?>

                    <?php \yii\bootstrap\ActiveForm::end(); ?>
                    <button class="btn btn-default" id="buttonRegister" style="width: 100%;">Войти</button>
                    <?php
                    $this->registerJs(<<<JS
                        $('#buttonRegister').click(function(){
                            if ($('#regisration-name').val() == '') {
                                $('.field-regisration-name').addClass('has-error');
                                $('.field-regisration-name .help-block').show().html('Нужно заполнить имя');

                                return false;
                            }
                            if ($('#regisration-username').val() == '') {
                                $('.field-regisration-username').addClass('has-error');
                                $('.field-regisration-username .help-block').show().html('Нужно заполнить логин');

                                return false;
                            }

                            ajaxJson({
                                url: '/registrationAjax',
                                data: {
                                    login: $('#regisration-username').val(),
                                    name: $('#regisration-name').val()
                                },
                                success: function(ret) {
                                    $('#blockLogin').hide();
                                    $('#blockOrder').show();
                                    $('#blockProfileLi').html($('#menuProfile').clone().show().removeAttr('id'));
                                    $('#blockProfileLi .buttonMain').click(function() {
                                        window.location = '/requests';
                                    });

                                },
                                errorScript: function(ret) {
                                    if (ret.id == 101) {
                                        $('.field-regisration-username').addClass('has-error');
                                        $('.field-regisration-username .help-block').show().html(ret.data);
                                    }
                                }
                            });

                        });
                        $('#regisration-username').on('focus', function() {
                            $('.field-regisration-username').removeClass('has-error');
                            $('.field-regisration-username .help-block').hide();
                        });
                        $('#regisration-name').on('focus', function() {
                            $('.field-regisration-name').removeClass('has-error');
                            $('.field-regisration-name .help-block').hide();
                        });
JS
                    );
                    ?>
                </div>
            </div>

            <div id="blockOrder"<?php if (Yii::$app->user->isGuest) echo(' style="display: none;"') ?>>
                <?php $form = \yii\bootstrap\ActiveForm::begin([
                    'id'                 => 'contact-form',
                    'options'            => ['enctype' => 'multipart/form-data'],
                    'enableClientScript' => false,
                ]); ?>
                <?= $model->field($form, 'dostavka')->radioList([
                    1 => "На месте полета",
                    2 => "Самовывоз",
                    3 => "Доставка по Москве",
                    4 => "Доставка по России",
                ]) ?>
                <?= $model->field($form, 'address')->textarea(['rows' => 10]) ?>
                <?= $model->field($form, 'comment')->textarea(['rows' => 10]) ?>
                <?php \yii\bootstrap\ActiveForm::end(); ?>
                Оплата:
                <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml" name="form2" id="formPay">
                    <input type="hidden" name="receiver" value="410011473018906">
                    <input type="hidden" name="formcomment" value="Авиалинии «БогДан»">
                    <input type="hidden" name="short-dest" value="<?= $product->getField('name') ?>">
                    <input type="hidden" name="label" value="" id="formPayLabel">
                    <input type="hidden" name="quickpay-form" value="donate">
                    <input type="hidden" name="targets" value="<?= $product->getField('name') ?>">
                    <input type="hidden" name="sum" value="<?= $product->getField('price') ?>" data-type="number"
                           id="productPriceForm">
                    <input type="hidden" name="comment" value="">
                    <input type="hidden" name="need-fio" value="false">
                    <input type="hidden" name="need-email" value="false">
                    <input type="hidden" name="need-phone" value="false">
                    <input type="hidden" name="need-address" value="false">
                    <input type="hidden" name="paymentType" value="AC" id="paymentType">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" class="btn btn-default paymentType" data-value="PC">
                                    Яндекс.Деньгами
                                </button>
                                <button type="button" class="btn btn-default paymentType active" data-value="AC">
                                    Банковской картой
                                </button>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            Итого: <span
                                id="productPrice"><?= Yii::$app->formatter->asDecimal($product->getField('price'), 0) ?></span>
                            руб
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="margin-top: 30px;">
                            <div class="btn-group" role="group" aria-label="...">

                                <input type="button" value="Перейти к оплате"
                                       class="btn btn-default btn-lg buttonSubmit" style="width: 400px;">
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>



