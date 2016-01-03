<?php
/**
 * @var $fields array
 * @var $request \app\models\Shop\Request
 */
?>
<p>Сумма оплаты не соответсвует зказу</p>
<p>Заказ:</p>
<p><?= \yii\helpers\VarDumper::dumpAsString($request) ?></p>

<p>Оплата:</p>
<p><?= \yii\helpers\VarDumper::dumpAsString($fields) ?></p>