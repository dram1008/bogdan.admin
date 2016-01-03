<?php

/* @var $this yii\web\View */
/* @var $list array */
/* @var $pagesCount int */
/* @var $page int */

$this->title = 'О нас';
?>

<!-- Intro Header -->
<header class="intro"
        style="height: 600px; background: url('/images/controller/site/about/img.jpg')  no-repeat top scroll;">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div style="">
                        <!--                    </a>-->
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
            <h2 class="text-center">Соглашение о наблюдении</h2>

            <p>Компания «Авиалинии БогДан» являтся полноправным представителем Бога на планете Земля и одной из ее
                вледельцев на основании <a href="http://www.galaxysss.ru/news/2015/12/21/stali_izvestny_vladelcy_planet"
                                           target="_blank">выдачи права</a>.</p>

            <p><img src="/images/controller/site/about/1450666172_9RAcQICogZ.jpg"
                    style="width: 100%;max-width: 800px;border-radius: 20px;"></p>

            <p>Это означает, что любое взаимодействие с этой компанией на уровне поступков, слов и мыслей подпадает под
                юрисдикцию «Божественного Союза Справедливости Творца», который действует рука об руку с «Агентством
                Воздаяния Творца», то есть кто с чем придет, тот с тем же и уйдет!</p>

            <p class="text-center"><img src="/images/controller/site/copyright/avt.png" class="img-center"
                                        style="border-radius: 20px;"></p>

            <p>Любое использование и наблюдение материалов этого сайта автоматически предполагает принятие <a
                    href="http://teslagen.org/video" target="_blank">соглашения о всуплении на «Новую Землю»</a>.</p>

            <p>Все кто использует материалы или упоминает о них в любом месте этой вселенной прошлого настоящего или
                будущего подпадает под программу Воздаяния Творца, поэтому делайте это только в благих целях и с чистыми
                мыслями, соответствующие <a href="http://www.galaxysss.ru/codex" target="_blank">Стандарту Золотого Века Творца</a>. В ином случае вы будете иметь дело с Архангелом
                Михаилом и мы рассмотрим ваше право пребывать на планете Земля в одностороннем порядке.</p>

            <div class="row" style="margin-bottom: 30px;">
                <div class="col-lg-3">
                    <img src="/images/controller/site/copyright/mihail/AngelReadings.jpg" width="100%" style="border-radius: 10px;"/>
                </div>
                <div class="col-lg-3">
                    <img src="/images/controller/site/copyright/mihail/arcanglmigluz.jpg" width="100%" style="border-radius: 10px;"/>
                </div>
                <div class="col-lg-3">
                    <img src="/images/controller/site/copyright/mihail/arcc3a1ngel-miguel.jpg" width="100%" style="border-radius: 10px;"/>
                </div>
                <div class="col-lg-3">
                    <img src="/images/controller/site/copyright/mihail/archangel_mihael_by_dimasunny-d6ixqxr.jpg"
                         width="100%" style="border-radius: 10px;"/>
                </div>
            </div>

            <p>С Любовью и Светом «Авиалинии БогДан»</p>
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
                <p class="text-center"><img src="/images/icon.png" class="img-center"></p>

                <h2>Наши контакты</h2>

                <p>+7-925-237-45-01<br>+7-926-518-98-75</p>

                <p>
                    <a href="mailto:avia@galaxysss.ru" style="color: #000000;">avia@galaxysss.ru</a>
                </p>
            </div>
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
                'image'       => \yii\helpers\Url::to('/images/controller/site/about/share.jpg', true),
                'title'       => 'Авиалинии БогДан',
                'description' => 'Компании предоставляет людям новую технологию перелетов в пространстве при помощи «Крыльев Ангела».
                Компания включает школу по обучению, Институт Многомерной Медицины, Институт Квантовой Генетики и технологии виртуальной реальности.
                Также предоставляет перелеты на обычных самолетах. Отличительным знаком компании является Крылья Ангела.',
            ]) ?>


        </div>
    </div>
</section>

