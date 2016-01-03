<?php

namespace app\controllers;

use app\models\Form\NewPassword;
use app\models\Form\Request;
use app\models\Log;
use app\models\Product;
use app\models\User;
use cs\base\BaseController;
use cs\services\VarDumper;
use cs\web\Exception;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;

class Site_cabinetController extends BaseController
{
    public $layout = 'landing';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionRequests()
    {
        return $this->render([
            'items' => \app\models\Shop\Request::query(['user_id' => \Yii::$app->user->id])->all(),
        ]);
    }

    public function actionRequest($id)
    {
        $item = \app\models\Shop\Request::find($id);
        if (is_null($item)) {
            throw new Exception('Заказ не найден');
        }

        return $this->render([
            'request' => $item,
        ]);
    }

    /**
     * AJAX
     * Отправляет сообщение к заказу для клиента
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id  идентификатор заказа gs_users_shop_requests.id
     *
     * @return \yii\web\Response json
     */
    public function actionOrder_item_message($id)
    {
        $text = self::getParam('text');
        $request = \app\models\Shop\Request::find($id);
        if ($request->getField('user_id') != Yii::$app->user->id) {
            return self::jsonErrorId(101, 'Это не ваш заказ');
        }
        $request->addMessageToShop($text);

        return self::jsonSuccess();
    }

    /**
     * Заготовка для отправки статуса с сообщением
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id  идентификатор заказа gs_users_shop_requests.id
     * @param int $status  статус
     *
     * @return \yii\web\Response json
     */
    private function sendStatus($id, $status)
    {
        $text = self::getParam('text');
        $request = \app\models\Shop\Request::find($id);
        if ($request->getField('user_id') != Yii::$app->user->id) {
            return self::jsonErrorId(101, 'Это не ваш заказ');
        }
        $request->addStatusToShop([
            'message' => $text,
            'status'  => $status,
        ]);

        return self::jsonSuccess();
    }

    /**
     * AJAX
     * Отправляет сообщение для клиента: Заказ получен
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id  идентификатор заказа gs_users_shop_requests.id
     *
     * @return \yii\web\Response json
     */
    public function actionOrder_item_done($id)
    {
        return $this->sendStatus($id, \app\models\Shop\Request::STATUS_FINISH_CLIENT);
    }

    /**
     * AJAX
     * Отправляет сообщение для клиента: Оплата сделана
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id  идентификатор заказа gs_users_shop_requests.id
     *
     * @return \yii\web\Response json
     */
    public function actionOrder_item_answer_pay($id)
    {
        return $this->sendStatus($id, \app\models\Shop\Request::STATUS_PAID_CLIENT);
    }

}
