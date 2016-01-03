<?php
/**
 * Created by PhpStorm.
 * User: Бог-Творец
 * Date: 03.01.2016
 * Time: 2:49
 */
/** @var $ticket \app\models\Shop\Ticket */
/** @var $request \app\models\Shop\Request */

$this->title = $ticket->getId();

$client = $request->getClient();

$kod = [ // штрих-код цифр (3 исполнения)
    "0" => ["a" => "0001101", "b" => "0100111", "c" => "1110010"],
    "1" => ["a" => "0011001", "b" => "0110011", "c" => "1100110"],
    "2" => ["a" => "0010011", "b" => "0011011", "c" => "1101100"],
    "3" => ["a" => "0111101", "b" => "0100001", "c" => "1000010"],
    "4" => ["a" => "0100011", "b" => "0011101", "c" => "1011100"],
    "5" => ["a" => "0110001", "b" => "0111001", "c" => "1001110"],
    "6" => ["a" => "0101111", "b" => "0000101", "c" => "1010000"],
    "7" => ["a" => "0111011", "b" => "0010001", "c" => "1000100"],
    "8" => ["a" => "0110111", "b" => "0001001", "c" => "1001000"],
    "9" => ["a" => "0001011", "b" => "0010111", "c" => "1110100"]
];
$isp = [ // исполнение левой части кода в зависимости от первой цифры
    "0" => ["2" => "a", "3" => "a", "4" => "a", "5" => "a", "6" => "a", "7" => "a"],
    "1" => ["2" => "a", "3" => "a", "4" => "b", "5" => "a", "6" => "b", "7" => "b"],
    "2" => ["2" => "a", "3" => "a", "4" => "b", "5" => "b", "6" => "a", "7" => "b"],
    "3" => ["2" => "a", "3" => "a", "4" => "b", "5" => "b", "6" => "b", "7" => "a"],
    "4" => ["2" => "a", "3" => "b", "4" => "a", "5" => "a", "6" => "b", "7" => "b"],
    "5" => ["2" => "a", "3" => "b", "4" => "b", "5" => "a", "6" => "a", "7" => "b"],
    "6" => ["2" => "a", "3" => "b", "4" => "b", "5" => "b", "6" => "a", "7" => "a"],
    "7" => ["2" => "a", "3" => "b", "4" => "a", "5" => "b", "6" => "a", "7" => "b"],
    "8" => ["2" => "a", "3" => "b", "4" => "a", "5" => "b", "6" => "b", "7" => "a"],
    "9" => ["2" => "a", "3" => "b", "4" => "b", "5" => "a", "6" => "b", "7" => "a"]
];

// Здесь все понятно, не так ли? Теперь пишем функцию для контрольной суммы:

function get_control_digit($nomer)
{ // расчет контрольной суммы
    $j = 0;
    $chet = 0;
    for ($i = 1; $i < 12; $i = $i + 2) {
        $j++;
        $chet = $chet + substr($nomer, $i, 1);
    };
    $j = 0;
    $nechet = 0;
    for ($i = 0; $i < 12; $i = $i + 2) {
        $j++;
        $nechet = $nechet + substr($nomer, $i, 1);
    };
    $total = $chet * 3 + $nechet;
    $contr_digit = 10 - substr($total, strlen($total) - 1, 1);
    if ($contr_digit == 10) $contr_digit = 0;

    return $contr_digit;
}

;

// Теперь задаем двенадцать цифр кода (первая цифра определяет исполнение):

$nomer = "481027900007";
$nomer = "123332111212";
$nomer .= get_control_digit($nomer); // добавка контрольной суммы
$first = substr($nomer, 0, 1);

// Определимся с будущим изображением:

$height = 75; // высота поля
$wight = 105; // ширина поля
$im = imagecreate($wight, $height); // создание изображения
$p = imagecolorallocate($im, 255, 255, 255); // цвет поля
$s = imagecolorallocate($im, 0, 0, 0); // цвет символов (штрихов и букв)
imagefill($im, 0, 0, $p); // окраска поля
$isp_ = "";
for ($j = 2; $j < 8; $j++) $isp_ .= $isp[ $first ][ $j ]; // "исполнение" цифр в первой шестерке (слева)

// Теперь формируем сам код:

imagefilledrectangle($im, 6, 0, 6, $height - 5, $s);
imagefilledrectangle($im, 8, 0, 8, $height - 5, $s);
for ($i = 1; $i < strlen($nomer) - 6; $i++) {
    $curr = substr($nomer, $i, 1);
    $is = substr($isp_, $i - 1, 1);
    $curr_code = $kod["$curr"]["$is"];
    $nach = 9 + 7 * ($i - 1);
    for ($j = 1; $j < 8; $j++) {
        if (substr($curr_code, $j - 1, 1) == "1")
            imagefilledrectangle($im, $nach + ($j - 1), 0, $nach + ($j - 1), $height - 10, $s);
    };
    imagestring($im, 2, $nach + 1, 64, $curr, $s);
};
imagefilledrectangle($im, 52, 0, 52, $height - 5, $s);
imagefilledrectangle($im, 54, 0, 54, $height - 5, $s);
for ($i = 7; $i < strlen($nomer); $i++) {
    $curr = substr($nomer, $i, 1);
    $curr_code = $kod["$curr"]["c"];
    $nach = 14 + 7 * ($i - 1);
    for ($j = 1; $j < 8; $j++) {
        if (substr($curr_code, $j - 1, 1) == "1")
            imagefilledrectangle($im, $nach + ($j - 1), 0, $nach + ($j - 1), $height - 10, $s);
    };
    imagestring($im, 2, $nach + 1, 64, $curr, $s);
};
imagefilledrectangle($im, 98, 0, 98, $height - 5, $s);
imagefilledrectangle($im, 100, 0, 100, $height - 5, $s);
imagestring($im, 2, 0, 64, $first, $s);

// Выводим полученный код:
$f = new \cs\services\SitePath('/upload');
$f->addAndCreate('tempPng');
$f->add(\cs\services\Security::generateRandomString() . '.png');
imagepng($im, $f->getPathFull()); // в файл
$data = base64_encode(file_get_contents($f->getPathFull()));
$f->deleteFile();
imagedestroy($im);
?>
<table width="600">
    <tr>
        <td>
            <img src="/images/mail/header.jpg" width="600">
        </td>
    </tr>
    <tr>
        <td style="padding: 30px;">
            <p>Билет №<?= $ticket->getId() ?></p>

            <p>Дата получения: <?= Yii::$app->formatter->asDatetime($ticket->getField('date_insert')) ?></p>

            <p>Получатель: <?= $client->getField('name_first') ?> (<?= $client->getEmail() ?>)</p>
            <p>Проверочный код:</p>
            <p><img src="data:image/png;base64,<?= $data ?>"/></p>
            <p>Ваш вылет состоится в Москве в марте-мае 2016 г.</p>
            <p>Сохраняйте этот билет до начала полета</p>
            <p>Билет может быть подрен другому человеку</p>
            <p>Если у вас возникнут вопросы вы можете всегда можете обратиться в службу поддержки начинающих Ангелов: +7-925-237-45-01, +7-926-518-98-75</p>
            <p>Служба поддержки Ангелов курирутся Архангелами и Серафимами</p>
            <p>Желаем вам приятного полета</p>
            <hr>
            <p>С Любовью и Светом Авиалинии БогДан</p>
            <p style="font-family: 'Courier New', Monospace; font-size: 70%"><a href="http://www.bog-dan.com/">http://www.bog-dan.com/</a></p>
        </td>
    </tr>
</table>