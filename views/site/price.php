<?php

/* @var $this yii\web\View */
/* @var $list array */
/* @var $pagesCount int */
/* @var $page int */

$this->title = 'Цены';
?>

<!-- About Section -->
<section id="about" class="container content-section" style="margin-top: 50px;">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2 class="text-center">Наши подарки</h2>

            <?php foreach(\app\models\Shop\Product::query()->orderBy(['price' => SORT_ASC])->all() as $item) { ?>
                <div class="row">
                    <div class="col-lg-4">
                        <p><?= $item['name'] ?></p>
                    </div>
                    <div class="col-lg-8">
                        <?= $item['content'] ?>
                        <p>= <b style="font-family: 'courier new'"><?= Yii::$app->formatter->asCurrency($item['price']) ?></b></p>
                        <?php if ($item['price'] > 100000) { ?>
                            <p><a href="/#contact" class="btn btn-default btn-lg">Звоните</a></p>
                        <?php } else { ?>
                            <p><a href="<?= \yii\helpers\Url::to(['site/buy', 'id' => $item['id'] ])?>" class="btn btn-default btn-lg">Получить</a></p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>


<!-- Download Section -->
<section id="download" class="content-section text-center">
    <div class="download-section" style="
    border-bottom: 1px solid #87aad0;
    border-top: 1px solid #87aad0;
    ">
        <div class="container">
            <div class="col-lg-8 col-lg-offset-2" style="color: #000000">
                <p class="text-center"><img src="/images/icon.png" class="img-center"> </p>
                <h2>Попробовать</h2>
                <p>Один билет равен 1 000 благодарностей (руб.) в наш адрес</p>
                <a href="/price" class="btn btn-default btn-lg">Получить билет</a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Наши контакты</h2>
            <p>+7-925-237-45-01<br>+7-926-518-98-75</p>
            <p>
                <a href="mailto:avia@galaxysss.ru">avia@galaxysss.ru</a>
            </p>

        </div>
    </div>
</section>

