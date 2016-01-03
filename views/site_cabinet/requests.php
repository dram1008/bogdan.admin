<?php

/* @var $this yii\web\View */
/* @var $items array */

$this->title = 'Заказ';
?>



<!-- About Section -->
<section id="about" class="container content-section" style="margin-top: 50px;">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2 class="text-center">Мои заказы</h2>

            <?php foreach($items as $item) {?>
                <p><a href="/requests/<?= $item['id']?>"><?= $item['id']?></a></p>
            <?php }?>

        </div>
    </div>
</section>


