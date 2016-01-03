<?php

namespace app\models\Shop;

use app\models\Union;
use app\services\Subscribe;
use cs\services\BitMask;
use yii\db\Query;
use yii\helpers\Url;

class Ticket extends \cs\base\DbRecord
{
    const TABLE = 'bog_shop_requests_tickets';


}