<?php

use yii\helpers\Url;
use app\services\GsssHtml;
use yii\helpers\Html;

$this->title = 'Заказы';

$this->registerJs(<<<JS
$('.buttonDelete').click(function (e) {
        e.preventDefault();
        if (confirm('Подтвердите удаление')) {
            var id = $(this).data('id');
            ajaxJson({
                url: '/admin/articleList/' + id + '/delete',
                success: function (ret) {
                    infoWindow('Успешно', function() {
                        $('#newsItem-' + id).remove();
                    });
                }
            });
        }
    });

    // Сделать рассылку
    $('.buttonAddSiteUpdate').click(function (e) {
        e.preventDefault();
        if (confirm('Подтвердите')) {
            var buttonSubscribe = $(this);
            var id = $(this).data('id');
            ajaxJson({
                url: '/admin/articleList/' + id + '/subscribe',
                success: function (ret) {
                    infoWindow('Успешно', function() {
                        buttonSubscribe.remove();
                    });
                }
            });
        }
    });

    $('.rowTable').click(function() {
        window.location = '/admin/requests/' + $(this).data('id');
    });
JS
);
?>

<div class="container">
    <h1 class="page-header">Заказы</h1>


    <?= \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query'      => \app\models\Shop\Request::query()->orderBy(['is_answer_from_client' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]),
        'tableOptions' => [
            'class' => 'table table-hover table-striped'
        ],
        'rowOptions' => function($item) {
            return [
                'role' => 'button',
                'data-id' => $item['id'],
                'class' => 'rowTable'
            ];
        },
        'columns' =>
        [
            [
                'class' => 'yii\grid\SerialColumn', // <-- here
                // you may configure additional properties here
            ],
            'address',
            [
                'header' => 'Время',
                'content' => function ($model, $key, $index, $column) {
                    return Yii::$app->formatter->asDatetime($model['date_create']);
                },
            ],
            [
                'header' => 'Комментарий',
                'content' => function ($model, $key, $index, $column) {
                    return Html::tag('pre', nl2br($model['comment']));
                },
            ],
            'is_answer_from_client',
        ]
    ]) ?>

</div>