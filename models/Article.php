<?php

namespace app\models;

use app\services\Subscribe;
use cs\services\BitMask;
use yii\db\Query;

class Article extends \cs\base\DbRecord
{
    const TABLE = 'rod_article_list';

    public function incViewCounter()
    {
        $this->update(['view_counter' => $this->getField('view_counter') + 1]);
    }

    /**
     * Выдает элементы которые соответствуют определенной категории
     *
     * @param int $id идентификатор категории
     *
     * @return array
     */
    public static function getByTreeNodeId($id)
    {
        return self::query(['&', 'tree_node_id_mask', (new BitMask([$id]))->getMask()])
            ->orderBy(['date_insert' => SORT_DESC])
            ->select('id,header,id_string,image,view_counter,description,date_insert,content')
            ->all();
    }

    /**
     * Выдает элементы которые соответствуют определенной категории
     *
     * @param int $id идентификатор категории
     *
     * @return Query
     */
    public static function getByTreeNodeIdQuery($id)
    {
        return self::query(['&', 'tree_node_id_mask', (new BitMask([$id]))->getMask()])
            ->orderBy(['date_insert' => SORT_DESC])
            ->select('id,header,id_string,image,view_counter,description,date_insert,content')
            ;
    }

    public function getName()
    {
        return $this->getField('header');
    }

    public function getImage($isScheme = false)
    {
        $image = $this->getField('image', '');
        if ($image == '') return '';

        return \yii\helpers\Url::to($this->getField('image'), $isScheme);
    }

    /**
     * Возвращает ссылку на статью
     *
     * @param bool $isScheme надо ли добавлять полный путь
     *
     * @return string
     */
    public function getLink($isScheme = false)
    {
        $date = $this->getField('date');
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);

        return \yii\helpers\Url::to([
            'site/article',
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
            'id'    => $this->getField('id_string'),
        ], $isScheme);
    }
}