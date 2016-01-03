<?php

/** @var $this \yii\web\View */
/** @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'Генератор Теслы Купить, Арендовать, Бестопливный генератор, Вечный двигатель, Диллерская программа, Доставка в любую точку планеты, Сервисное обслуживание']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Генератор Теслы Купить, Арендовать, Бестопливный генератор, Вечный двигатель, Диллерская программа, Доставка в любую точку планеты, Сервисное обслуживание']);
$this->registerMetaTag(['name' => 'title', 'content' => $this->title]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='yandex-verification' content='6721c497dd2fba14'/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> :: Агентство Сохранения Рода</title>
    <link rel="shortcut icon" href="/images/icon32.png">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= \yii\helpers\Url::to(['admin_article/main']) ?>" style="padding: 5px 15px 5px 5px;">
                    <img src="/images/icon.png" height="40">
                </a>
                <a class="navbar-brand" href="<?= \yii\helpers\Url::to(['admin_article/main']) ?>">
                        Административный модуль
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?= Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items'   => [
                        ['label' => 'Заказы', 'url' => ['admin_requests/index']],
                        ['label' => 'Продукты', 'url' => ['admin_products/index']],
                        ['label' => 'Картинки', 'url' => ['admin_pictures/index']],
                    ],
                ]);
                ?>

                <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <?php if (Yii::$app->user->isGuest) { ?>
                                <a
                                    href="<?= \yii\helpers\Url::to(['site/login'])?>"
                                    style="padding: 5px 10px 5px 10px;"
                                    >
                                <?= Html::img('/images/RM_Symbol_Blue.png', [
                                    'height' => '40px',
                                    'class'  => 'img-circle'
                                ]) ?>
                                    </a>
                            <?php } else { ?>
                            <a
                                href="#"
                                class="dropdown-toggle"
                                data-toggle="dropdown"
                                aria-expanded="false"
                                role="button"
                                style="padding: 5px 10px 5px 10px;"
                                >
                                <?= Html::img(Yii::$app->user->identity->getAvatar(), [
                                    'height' => '40px',
                                    'class'  => 'img-circle'
                                ]) ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <?php if (Yii::$app->user->identity->isAdmin()) { ?>
                                    <li><a href="<?= \yii\helpers\Url::to(['admin_requests/index']) ?>">Заказы</a></li>
                                    <li><a href="<?= \yii\helpers\Url::to(['admin_products/index']) ?>">Продукты</a></li>
                                    <li><a href="<?= \yii\helpers\Url::to(['admin_pictures/index']) ?>">Картинки</a></li>
                                <?php } ?>

                                <li class="divider"></li>
                                <li><a
                                        href="<?= \yii\helpers\Url::to(['cabinet/change_email']) ?>"><i
                                            class="glyphicon glyphicon-asterisk"
                                            style="padding-right: 5px;"
                                            ></i>Сменить
                                        логин/email</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['cabinet/password_change']) ?>"><i class="glyphicon glyphicon-asterisk" style="padding-right: 5px;"></i>Сменить пароль</a></li>
                                <li class="divider"></li>

                                <li><a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" data-method="post"><i
                                            class="glyphicon glyphicon-off" style="padding-right: 5px;"></i>Выйти</a>
                                </li>
                            </ul>
                            <?php } ?>
                        </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <div class="container">
        <?= $content ?>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="modalInfo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Информация</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <a href="/">Авиалинии БогДан</a> 2016</p>
    </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
