<?php

namespace app\controllers;

use app\models\Article;
use app\models\Page;
use app\models\Shop\Request;
use app\models\SiteUpdate;
use app\services\Subscribe;
use cs\services\VarDumper;
use cs\web\Exception;
use Yii;
use yii\base\UserException;

class Admin_requestsController extends AdminBaseController
{

    public function actionIndex()
    {
        return $this->render([
            'items' => Request::query()->orderBy(['date_create' => SORT_DESC])->all(),
        ]);
    }

    /**
     * Показывает заказ
     *
     * @param int $id идентификатор заказа
     *
     * @return string
     * @throws \cs\web\Exception
     */
    public function actionItem($id)
    {
        $request = Request::find($id);
        if (is_null($request)) {
            throw new Exception('Не найден заказ');
        }

        return $this->render([
            'request' => $request,
        ]);
    }

    public function actionAdd()
    {
        $model = new \app\models\Form\Page();
        if ($model->load(Yii::$app->request->post()) && $model->insert()) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render([
                'model' => $model,
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = \app\models\Form\Page::find($id);
        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render([
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        \app\models\Form\Page::find($id)->delete();

        return self::jsonSuccess();
    }


    /**
     * AJAX
     * Отправляет сообщение к заказу для клиента
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id идентификатор заказа gs_users_shop_requests.id
     *
     * @return \yii\web\Response json
     */
    public function actionItem_message($id)
    {
        $text = self::getParam('text');
        $request = Request::find($id);
        if ($request->getField('user_id') != Yii::$app->user->id) {
            return self::jsonErrorId(101, 'Это не ваш заказ');
        }
        $request->addMessageToClient($text);

        return self::jsonSuccess();
    }

    /**
     * AJAX
     * Отправляет сообщение для клиента: Выставлен счет на оплату
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id идентификатор заказа gs_users_shop_requests.id
     *
     * @return \yii\web\Response json
     */
    public function actionItem_new_bill($id)
    {
        return $this->sendStatus($id, Request::STATUS_ORDER_DOSTAVKA);
    }

    /**
     * AJAX
     * Отправляет сообщение для клиента: Оплата подтверждена
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id идентификатор заказа gs_users_shop_requests.id
     *
     * @return \yii\web\Response json
     */
    public function actionItem_answer_pay($id)
    {
        $request = Request::find($id);
        if ($request->getField('user_id') != Yii::$app->user->id) {
            return self::jsonErrorId(101, 'Это не ваш заказ');
        }
        $request->paid(self::getParam('text'));

        return self::jsonSuccess();
    }

    /**
     * AJAX
     * Отправляет сообщение для клиента: Заказ выполнен
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id идентификатор заказа gs_users_shop_requests.id
     *
     * @return \yii\web\Response json
     */
    public function actionItem_send($id)
    {
        return $this->sendStatus($id, Request::STATUS_SEND_TO_USER);
    }

    /**
     * AJAX
     * Отправляет сообщение для клиента: Заказ выполнен
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id идентификатор заказа gs_users_shop_requests.id
     *
     * @return \yii\web\Response json
     */
    public function actionItem_done($id)
    {
        return $this->sendStatus($id, Request::STATUS_FINISH_SHOP);
    }

    /**
     * Заготовка для отправки статуса с сообщением
     *
     * REQUEST:
     * - text - string - текст сообщения
     *
     * @param int $id идентификатор заказа gs_users_shop_requests.id
     * @param int $status статус
     *
     * @return \yii\web\Response json
     */
    private function sendStatus($id, $status)
    {
        $text = self::getParam('text');
        $request = Request::find($id);
        if ($request->getField('user_id') != Yii::$app->user->id) {
            return self::jsonErrorId(101, 'Это не ваш заказ');
        }
        $request->addStatusToClient([
            'message' => $text,
            'status'  => $status,
        ]);

        return self::jsonSuccess();
    }
}
