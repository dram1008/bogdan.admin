<?php

namespace app\models\Form;

use app\models\NewsItem;
use app\models\User;
use app\services\GsssHtml;
use cs\services\Str;
use cs\services\Url;
use cs\services\VarDumper;
use Yii;
use yii\base\Model;
use cs\Widget\FileUpload2\FileUpload;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * ContactForm is the model behind the contact form.
 */
class Article extends \cs\base\BaseForm
{
    const TABLE = 'rod_article_list';

    public $id;
    public $header;
    public $sort_index;
    public $content;
    public $date_insert;
    public $image;
    public $id_string;
    public $view_counter;
    public $description;
    public $date;
    /** @var  int маска которая содержит идентификаторы разделов к которому принадлежит ченелинг */
    public $tree_node_id_mask;
    public $is_added_site_update;
    /** @var  bool */
    public $is_add_image = true;
    public $video;

    function __construct($fields = [])
    {
        static::$fields = [
            [
                'header',
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
                'date',
                'Дата',
                0,
                'default',
                'widget' => [
                    'cs\Widget\DatePicker\DatePicker', [
                        'dateFormat' => 'php:d.m.Y',
                    ]
                ],
            ],
                [
                'video',
                'Youtube ролик',
                0,
                'url', [],
                'в формате https://www.youtube.com/embed/jQCfBYYO0XI'
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
                            'small'    => \app\services\GsssHtml::$formatIcon,
                            'original' => [1010, 500, \cs\Widget\FileUpload2\FileUpload::MODE_THUMBNAIL_CUT],
                        ]
                    ]
                ]
            ],
        ];
        parent::__construct($fields);
    }

    public function insert($fieldsCols = null)
    {
        $row = parent::insert([
            'beforeInsert' => function ($fields) {
                $fields['date_insert'] = gmdate('YmdHis');
                $fields['id_string'] = Str::rus2translit($fields['header']);

                return $fields;
            },
        ]);

        $item = \app\models\Article::find($row['id']);
        $fields = [];
        if ($item->getField('description') == '') {
            $fields['description'] = GsssHtml::getMiniText($item->getField('content'));
        }
        if (count($fields) > 0) {
            $item->update($fields);
        }

        return $item;
    }

    public function update($fieldsCols = null)
    {
        parent::update();

        $item = \app\models\Article::find($this->id);
        $fields = [];
        if ($item->getField('description') == '') {
            $fields['description'] = GsssHtml::getMiniText($item->getField('content'));
        }
        if (count($fields) > 0) {
            $item->update($fields);
        }

        return true;
    }

}
