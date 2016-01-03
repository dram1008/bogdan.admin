<?php

/* @var $this yii\web\View */
/* @var $list array */

$this->title = 'ТПК';
?>
<div class="intro">Nulla vitae elit libero, a pharetra augue. Vivamus sagittis lacus augue laoreet rutrum faucibus
    dolor auctor. Cras mattis consectetur purus sit amet fermentum, Vestibulum id ligula porta.
</div>

<!-- Begin Blog Grid -->
<div class="blog-wrap">
    <!-- Begin Blog -->
    <div class="blog-grid">

        <?php foreach ($list as $item) { ?>
            <?php $article = new \app\models\Article($item) ?>
            <?php if ($article->getField('video')) { ?>
                <div class="post format-video box">
                    <div class="video frame">
                        <iframe width="100%" height="281" src="<?= $article->getField('video') ?>"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <h2 class="title"><a href="<?= $article->getLink() ?>"><?= $item['header'] ?></a></h2>

                    <p><?= $item['description'] ?></p>

                    <div class="details">
                        <span class="icon-image"><a href="#"><?= Yii::$app->formatter->asDate($item['date']) ?></a></span>
                    </div>

                </div>
            <?php } else { ?>
                <div class="post format-image box">
                    <div class="frame">
                        <a href="<?= $article->getLink() ?>">
                            <img src="<?= $item['image'] ?>" alt=""/>
                        </a>
                    </div>
                    <h2 class="title"><a href="<?= $article->getLink() ?>"><?= $item['header'] ?></a></h2>

                    <p><?= $item['description'] ?></p>

                    <div class="details">
                        <span class="icon-image"><a href="#"><?= Yii::$app->formatter->asDate($item['date']) ?></a></span>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

    </div>
    <!-- End Blog -->
</div>
<!-- End Blog Grid -->

