<?php

/* @var $this yii\web\View */
/* @var $list array */
/* @var $pagesCount int */
/* @var $page int */

$this->title = 'Акселератор Мозга';
?>

<!-- Intro Header -->
<header class="intro" style="height: 600px; background: url('/images/controller/products/accelerator/1267518_649726548370820_1261685365_o.jpg')  no-repeat top scroll;">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div style="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- About Section -->
<section id="about" class="container content-section">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2 class="text-center">О продукте</h2>

            <p>«Акселератор мозга» - добавка к пище, не является лекарством, препарат внутри.

            <p>О препарате:<br>Увеличивает способности к Творчеству, открывает канал Вдохновения, дает ясное понимание вещей, развивает ясновидение, яснослышание, способности к телепатии.

            <p>Способ применения и дозы: принимайте препарат 3 раза в день перед едой или чаем (водой). Рекомендуемый курс 0,5-3 месяца в зависимости от способностей.

            <p>Противопоказания: нет.

            <p>Срок годности: 100 лет

            <p>Ограничения к применению: нет.

            <p>Меры предосторожности: нет.

            <p>На вкус совершенно нейтральные.

            <p>Побочные действия: возникают беспричинные приступы Любви к окружающим, спонтанное ощущение благодарности Миру, безконтрольно возникают признаки Счастья и Радости.

            <p>Передозировка: невозможно, главное следуйте четкой инструкции по применению, при увеличении дозы и чрезмерном употреблении могут возникать случаи телепортации или телекинеза.

            <p>После прохождения курса все признаки остаются и набирают сочность.

            <p>К препарату прилагается активатор-гармонизатор.

            <p>Стандарт качества Золотого Века соблюден: Eco, Natural, Organic, Hand Made, Pure Vegetarian, With Love.</p>

            <p>Уникальная разработка от Института Многомерный Медицины. http://www.galaxysss.ru/category/medical/344</p>

            <p>Включена в Перечень жизненно необходимых и важнейших лекарственных препаратов.</p>

            <p>Есть Лицензия и Патент.</p>

            <p>Цена: 1000 руб. за курс на 1 месяц</p>

            <p>Заказать можно по почте accelerator@galaxysss.ru</p>

            <p>Есть доставка по всему миру, таможенный контроль урегулирован.</p>

            <p>Есть дилерские условия и франшиза.</p>

            <p>Телефон: +7-925-237-45-01 Розница и Опт</p>

            <p><img src="/images/controller/products/accelerator/1.jpg" width="100%"></p>
            <p><img src="/images/controller/products/accelerator/2.jpg" width="100%"></p>
            <p><img src="/images/controller/products/accelerator/3.jpg" width="100%"></p>
            <p><img src="/images/controller/products/accelerator/4.jpg" width="100%"></p>
            <p><img src="/images/controller/products/accelerator/5.jpg" width="100%"></p>
            <p><img src="/images/controller/products/accelerator/6.jpg" width="100%"></p>
            <p><img src="/images/controller/products/accelerator/7.jpg" width="100%"></p>
            <p><img src="/images/controller/products/accelerator/8.jpg" width="100%"></p>



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

<!-- share Section -->
<section id="share" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Поделиться</h2>
            <?= $this->render('../blocks/share', [
                'url'         => \yii\helpers\Url::current([], true),
                'image'       => \yii\helpers\Url::to('/images/promo-facebook1.jpg', true),
                'title'       => 'Проект «Крылья Ангела». Летайте как птицы! Получите билет от нас в подарок!',
                'description' => 'Проект Крылья Ангела представляет собой тренажер для полетов в виртуальной реальности вместе с кристальным звуком. По факту этот тренажер является персональным кинотеатром 5D.

Он будет установлен в Москве в марте-мае 2016 г. и стоять в одном из торговых центров Москвы.

Для того чтобы испытать этот тренажер вам нужно получить билет.

Получая билет вы получите:
- 30 мин первокласного ощущения полета на Крыльях Ангела;
- измененное состояние сознания легкости после полета;
- эффект присутствия через зрение, слух, гравитацию, ощущение ветра;
- фото вашего полета на память;
- купон на скидку для вас и ваших друзей;
- специальный подарок!',
            ]) ?>



        </div>
    </div>
</section>

