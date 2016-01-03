<?php

/** @var $request \app\models\Request */
/** @var $user \app\models\User */

$product = \app\models\Product::find($request->getField('product_id'));
Yii::info(\yii\helpers\VarDumper::dumpAsString($request), 'tg\\request');
Yii::info(\yii\helpers\VarDumper::dumpAsString($product), 'tg\\test');
?>


Вы сделали очередной заказ
Наименование: <?= $product->getField('name') ?>
Цена: <?= $product->getField('price') ?>
