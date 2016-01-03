<?php

/** @var $request \app\models\Shop\Request */

$tickets = $request->getTickets();

?>


<p>Поздравляем вы сделали первый шаг к своему полю коллективного счастья</p>

<p>Ваши билеты:</p>

<?php foreach($tickets as $t) { ?>
    <p><?= $t['code'] ?></p>
<?php } ?>

