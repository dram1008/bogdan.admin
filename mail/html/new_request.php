<?php

/** @var $request array */
/** @var $user \app\models\User */
?>


<p>Поступил новый заказ:</p>
<p>Модель: <?= \app\models\Product::find($request->getField('product_id'))->getField('name') ?></p>
<p>Имя: <?= $user->getField('name_first') ?></p>
<p>Email: <?= $user->getField('email') ?></p>
<p>Телефон: <?= $user->getField('phone') ?></p>
<p>Комментарий: <?= nl2br($request->getField('comment'))  ?></p>
<p>Доставка: <?= $request->getField('point_address')  ?></p>
<p><a href="<?= \yii\helpers\Url::to(['site/map', 'lat' => $request->getField('point_lat'), 'lng' => $request->getField('point_lng')], true)?>"><?= \yii\helpers\Url::to(['site/map', 'lat' => $request->getField('point_lat'), 'lng' => $request->getField('point_lng')], true)?></a> </p>