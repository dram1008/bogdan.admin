<?php

namespace app\models\Form;

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
class Page extends \cs\base\BaseForm
{
    const TABLE = 'rod_pages';

    public $id;
    public $header;
    public $content;
    public $date_insert;
    public $image;

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
                'image',
                'Картинка',
                0,
                'string',[],'288х443',
                'widget' => [
                    FileUpload::className(),
                    [
                        'options' => [
                            'small' => [288, 443, \cs\Widget\FileUpload2\FileUpload::MODE_THUMBNAIL_CUT],
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

                return $fields;
            },
        ]);

        return $row;
    }
}
