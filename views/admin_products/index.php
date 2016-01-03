<?php

use yii\helpers\Url;
use app\services\GsssHtml;
use yii\helpers\Html;

$this->title = 'Генераторы';

$this->registerJs(<<<JS
$('.buttonDelete').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var b = $(this);
        if (confirm('Подтвердите удаление')) {
            var id = $(this).data('id');
            ajaxJson({
                url: '/admin/products/' + id + '/delete',
                success: function (ret) {
                    showInfo('Успешно', function() {
                        b.parent().parent().remove();
                    });
                }
            });
        }
    });

    $('.rowTable').click(function() {
        window.location = '/admin/products/' + $(this).data('id');
    });


JS
);

?>

<div class="container">
    <h1 class="page-header">Продукты</h1>


    <?= \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query'      => \app\models\Shop\Product::query()->orderBy(['price' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]),
        'tableOptions' => [
            'class' => 'table table-hover table-striped'
        ],
        'rowOptions'   => function ($item) {
            return [
                'role'    => 'button',
                'data-id' => $item['id'],
                'class'   => 'rowTable'
            ];
        },
        'columns'      => [
            'id',
            [
                'header' => 'Картинка',
                'content' => function($item) {
                    if (\yii\helpers\ArrayHelper::getValue($item, 'image', '') == '') return '';
                    return Html::img($item['image'], ['width'=>50,'class' => 'thumbnail', 'style' => 'margin-bottom: 0px;']);
                },
            ],
            'name',
            'price',

        ]
    ]) ?>


    <div class="col-lg-6">
        <div class="row">
            <!-- Split button -->
            <div class="btn-group">
                <a href="<?= Url::to(['admin_products/add']) ?>" class="btn btn-default">Добавить</a>

            </div>
        </div>
    </div>
</div>