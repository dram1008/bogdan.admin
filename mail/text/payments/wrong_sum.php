<?php
/**
 * @var $fields array
 * @var $request \app\models\Shop\Request
 */
?>
Сумма оплаты не соответсвует зказу
Заказ:
<?= \yii\helpers\VarDumper::dumpAsString($request) ?>

Оплата:
<?= \yii\helpers\VarDumper::dumpAsString($fields) ?>