<?php

namespace app\models\Form\Shop;

use app\models\NewsItem;
use app\models\User;
use app\services\GsssHtml;
use cs\services\Str;
use cs\services\VarDumper;
use Yii;
use yii\base\Model;
use cs\Widget\FileUpload2\FileUpload;
use yii\db\Query;
use yii\helpers\Html;

/**
 */
class Request extends \cs\base\BaseForm
{
    const TABLE = 'bog_shop_requests';

    public $id;
    public $user_id;
    public $product_id;
    public $address;
    public $dostavka;
    public $status;
    public $date_create;
    public $comment;
    public $is_answer_from_shop;
    public $is_answer_from_client;

    function __construct($fields = [])
    {
        static::$fields = [
            [
                'address',
                'Адрес',
                1,
                'string'
            ],
            [
                'comment',
                'Комментарий',
                0,
                'string',
            ],
            [
                'dostavka',
                'Способ Доставки',
                0,
                'integer',
            ],
        ];
        parent::__construct($fields);
    }

    /**
     * @param int $id product_id
     * @return array
     */
    public function insert2($id)
    {
        $this->product_id = $id;

        $fields = parent::insert([
            'beforeInsert' => function ($fields, \app\models\Form\Shop\Request $model) {
                $fields['date_create'] = time();
                $fields['product_id'] = $model->product_id;
//                $fields['user_id'] = \Yii::$app->user->id;
                $fields['user_id'] = 1;
                $fields['is_answer_from_shop'] = 1;
                $fields['is_answer_from_client'] = 0;

                return $fields;
            },
        ]);

        $item = \app\models\Shop\Request::find($fields['id']);
        $item->addStatusToShop(\app\models\Shop\Request::STATUS_SEND_TO_SHOP);

        return $fields;
    }
}
