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
 * ContactForm is the model behind the contact form.
 */
class Product extends \cs\base\BaseForm
{
    const TABLE = 'bog_shop_product';

    public $id;
    public $name;
    public $description;
    public $date_insert;
    public $sort_index;
    public $content;
    public $image;
    public $price;
    public $tickets_counter;

    function __construct($fields = [])
    {
        static::$fields = [
            [
                'name',
                'Название',
                1,
                'string'
            ],
            [
                'content',
                'Описание',
                0,
                'string',
                'widget' => [
                    'cs\Widget\HtmlContent\HtmlContent',
                    [
                    ]
                ]
            ],
            [
                'description',
                'Описание краткое',
                0,
                'string'
            ],
            [
                'tickets_counter',
                'Кол-во билетов в продукте',
                0,
                'integer'
            ],
            [
                'price',
                'Цена',
                0,
                'integer'
            ],
            [
                'image',
                'Картинка',
                0,
                'string',
                'widget' => [
                    FileUpload::className(),
                    [
                        'options' => [
                            'small' => \app\services\GsssHtml::$formatIcon
                        ]
                    ]
                ]
            ],

        ];
        parent::__construct($fields);
    }

    public function insert2($id)
    {
        $this->union_id = $id;

        return parent::insert([
            'beforeInsert' => function ($fields, \app\models\Form\Shop\Product $model) {
                $fields['date_insert'] = time();

                return $fields;
            },
        ]);
    }

    public function update($fieldsCols = null)
    {
        return parent::update([
            'beforeUpdate' => function ($fields) {
                if ($fields['description'] == '') {
                    $fields['description'] = GsssHtml::getMiniText($fields['content']);
                }

                return $fields;
            }
        ]);
    }

}
