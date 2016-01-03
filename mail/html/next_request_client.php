<?php

/** @var $request \app\models\Request */
/** @var $user \app\models\User */

$product = \app\models\Product::find($request->getField('product_id'));
Yii::info(\yii\helpers\VarDumper::dumpAsString($request), 'tg\\request');
Yii::info(\yii\helpers\VarDumper::dumpAsString($product), 'tg\\product');
?>


<p>Вы сделали очередной заказ</p>
<p>Наименование: <?= $product->getField('name') ?></p>
<p>Цена: <?= $product->getField('price') ?></p>
