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
class Picture extends \cs\base\BaseForm
{
    const TABLE = 'bog_pictures';

    public $id;
    public $name;
    public $image;
    public $description;
    public $content;
    public $date;
    /** @var  int маска которая содержит идентификаторы разделов к которому принадлежит ченелинг */
    public $tree_node_id_mask;

    function __construct($fields = [])
    {
        static::$fields = [
            [
                'name',
                'Название',
                0,
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
                'image',
                'Картинка',
                0,
                'string',
                'widget' => [
                    FileUpload::className(),
                    [
                        'options' => [
                            'small'    => \app\services\GsssHtml::$formatIcon,
                        ]
                    ]
                ]
            ],
            [
                'tree_node_id_mask',
                'Категории',
                0,
                'cs\Widget\CheckBoxListMask\Validator',
                'widget' => [
                    'cs\Widget\CheckBoxListMask\CheckBoxListMask',
                    [
                        'rows' => (new Query())->select([
                            'id',
                            'name'
                        ])->from('bog_pictures_tree')->all()
                    ]
                ]
            ],
        ];
        parent::__construct($fields);
    }

    public function insert($fieldsCols = null)
    {
        $row = parent::insert();

        $item = \app\models\Picture::find($row['id']);
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

        $item = \app\models\Picture::find($this->id);
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
