<?php

/** @var $this \yii\web\View */
/** @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

\app\assets\MainLayout\Asset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="/images/icon32.png">
    <title><?= Html::encode($this->title) ?> :: Авиалинии БогДан</title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-color: #0042ae;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="<?php if (\yii\helpers\Url::current() != '/') echo '/'; ?>#page-top" style="padding: 0px;  margin: 0px 10px 0px 10px;">
                <img src="/images/logo4.png" height="50">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="<?php if (\yii\helpers\Url::current() != '/') echo '/'; ?>#about">О проекте</a>
                </li>
                <li>
                    <a class="page-scroll" href="<?php if (\yii\helpers\Url::current() != '/') echo '/'; ?>#download">Попробовать</a>
                </li>
                <li>
                    <a class="page-scroll" href="<?php if (\yii\helpers\Url::current() != '/') echo '/'; ?>#contact">Контакты</a>
                </li>
                <li<?php if (\yii\helpers\Url::current() == \yii\helpers\Url::to(['site/media'])) echo " class='active'" ?>>
                    <a href="/media">Медиа</a>
                </li>
                <li<?php if (\yii\helpers\Url::current() == \yii\helpers\Url::to(['site/about'])) echo " class='active'" ?>>
                    <a href="/about">О нас</a>
                </li>
                <li style="padding-top: 6px;" id="blockProfileLi">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <?php
                        $this->registerJs(<<<JS
                            $('.buttonMain').click(function() {
                                window.location = '/login';
                            });
JS
                        );
                        ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/registration">Регистрация</a></li>
                                <li><a href="/password/recover">Восстановить пароль</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <?php
                        $this->registerJs(<<<JS
                            $('.buttonMain').click(function() {
                                window.location = '/requests';
                            });
JS
);
                        ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default buttonMain"><span class="glyphicon glyphicon-user"></span></button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/requests">Заказы</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/logout">Выход</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div style="display: none;" id="menuProfile">
    <div class="btn-group">
        <button type="button" class="btn btn-default buttonMain"><span class="glyphicon glyphicon-user"></span></button>
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="/requests">Заказы</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/logout">Выход</a></li>
        </ul>
    </div>
</div>


<?= $content ?>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p><a href="/copyright">&copy;</a> bog-dan.com <?= date('Y') ?> & Birdly® of <a href="http://somniacs.co/" target="_blank">Somniacs</a><br><span style="font-size: 80%">При участии богов <a href="https://ru.wikipedia.org/wiki/%D0%A0%D0%B0" target="_blank">РА</a>, <a target="_blank" target="_blank" href="https://ru.wikipedia.org/wiki/%D0%A1%D1%83%D1%80%D1%8C%D1%8F">Сурья</a>, <a target="_blank" href="https://ru.wikipedia.org/wiki/%D0%9D%D0%B0%D1%80%D0%B0%D1%8F%D0%BD%D0%B0">Нараяна</a>, <a href="https://ru.wikipedia.org/wiki/%D0%9F%D0%B5%D1%80%D1%83%D0%BD" target="_blank">Перун</a></span></p>
        <p><a href="/hologram"><img src="/images/holo.png" style="opacity: 0.3" onmouseover="$(this).css('opacity', 1);" onmouseout="$(this).css('opacity', 0.3);"></a></p>

        <p style="font-size: 90%"><a href="http://www.galaxysss.ru/" target="_blank">Галактичский Союз Сил Света</a><br><a
                href="http://www.galaxysss.ru/vasudev/login" target="_blank">Элитный Клуб Фрактального Бизнеса «Vasudev
                Bagavan»</a></p>
    </div>
</footer>


<?php if (YII_ENV_PROD) { ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter34505705 = new Ya.Metrika({
                        id:34505705,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/34505705" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
<?php } ?>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
