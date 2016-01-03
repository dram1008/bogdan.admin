<?php

namespace app\commands;

use app\models\SubscribeMailItem;
use yii\console\Controller;
use yii\console\Response;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * Занимается рассылкой писем
 */
class SubscribeController extends Controller
{
    /**
     * Делает рассылку писем из списка рассылки
     */
    public function actionSend()
    {
        $time = microtime(true);
        $list = SubscribeMailItem::query()
            ->limit(10)
            ->orderBy(['date_insert' => SORT_DESC])
            ->all();
        if (count($list) > 0) {
            \Yii::info('Всего писем для рассылки: ' . count($list), 'tg\\app\\commands\\SubscribeController::actionSend');
            \Yii::info('Список писем: ' . VarDumper::dumpAsString(ArrayHelper::getColumn($list, 'mail')), 'tg\\app\\commands\\SubscribeController::actionSend');

            foreach($list as $mailItem) {
                $mail = \Yii::$app->mailer
                    ->compose()
                    ->setFrom(\Yii::$app->params['mailer']['from'])
                    ->setTo($mailItem['mail'])
                    ->setSubject($mailItem['subject'])
                    ->setHtmlBody($mailItem['html']);
                if (isset($mailItem['text'])) {
                    if ($mailItem['text'] != '') {
                        $mail->setTextBody($mailItem['text']);
                    }
                }
                $mail->send();
            }

            \Yii::info('Список писем для удаления: ' . VarDumper::dumpAsString(ArrayHelper::getColumn($list, 'id')), 'tg\\app\\commands\\SubscribeController::actionSend');
            SubscribeMailItem::deleteByCondition([
                'in', 'id', ArrayHelper::getColumn($list, 'id')
            ]);
            \Yii::info('Осталось после рассылки: ' . SubscribeMailItem::query()->count(), 'tg\\app\\commands\\SubscribeController::actionSend');
            $time = microtime(true) - $time;
            \Yii::info('Затраченное время на расылку: ' . $time, 'tg\\app\\commands\\SubscribeController::actionSend');
        }

        \Yii::$app->end();
    }
}
