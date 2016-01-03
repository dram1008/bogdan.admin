<?php

namespace app\models;

use app\services\Subscribe;
use cs\services\BitMask;
use yii\db\Query;

class Counter extends \cs\base\DbRecord
{
    const TABLE = 'bog_counter';

    public static function inc($sum)
    {
        $counterRow = self::find(1);
        $counter = $counterRow->getField('counter');
        $counterRow->update([$counter + $sum]);

        return true;
    }

}