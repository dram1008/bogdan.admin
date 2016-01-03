<?php

/** @var $url */
/** @var $image */
/** @var $title */
/** @var $summary */
/** @var $description */

use yii\helpers\Html;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\Url;
use cs\services\Url as csUrl;

$this->registerMetaTag(['name' => 'og:image', 'content' => $image]);
$this->registerMetaTag(['name' => 'og:url', 'content' => $url]);
$this->registerMetaTag(['name' => 'og:title', 'content' => $title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $description]);

?>

<p>
    <a href="<?= (string)(new csUrl('http://www.facebook.com/sharer.php', [
        'u' => $url,
    ])) ?>" target="_blank" class="btn btn-default btn-lg">facebook</a>
</p>