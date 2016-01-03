<?php

namespace app\models\Form;

use app\models\User;
use app\services\Subscribe;
use cs\Application;
use cs\base\BaseForm;
use cs\services\VarDumper;
use cs\Widget\PlaceMap\PlaceMap;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class Request extends BaseForm
{
    const TABLE = 'tg_requests';

    public $id;
    public $name;
    public $email;
    public $point;
    public $phone;
    public $comment;
    public $product_id;

    public function rules()
    {
        return ArrayHelper::merge([
            [['email'], 'validateEmail']
        ], $this->rulesAdd());
    }

    public function validateEmail($attribute, $params)
    {
        if (User::query(['email' => strtolower($this->email)])->exists()) {
            $this->addError($attribute, 'Такой пользователь уже существует, вам нужно войти сначала');
        }
    }

    /**
     *
     */
    public function __construct()
    {
        self::$fields = [
            [
                'product_id', 'Имя', 0
            ],
            [
                'name', 'Имя', 0
            ],
            [
                'email', 'Почта', 0, 'email'
            ],
            [
                'phone', 'Телефон', 0, 'default'
            ],
            [
                'comment', 'Комментарий', 0, 'default'
            ],
            [
                'point', 'Адрес доставки', 0, "default",
                'widget' => [PlaceMap::className(), [
                    'style' => [
                        'input'  => ['class' => 'form-control'],
                        'divMap' => ['style' => 'width:100%'],
                    ]
                ]]
            ],

        ];
    }

    /**
     * Делает заказ
     *
     * @param  int $id идентификатор генератора
     *
     * @return boolean whether the model passes validation
     */
    public function insert($fieldsCols = null)
    {
        $id = $fieldsCols;
        $request = parent::insert([
            'beforeInsert' => function ($fields) {
                $fields['email'] = strtolower($fields['email']);
                $fields['datetime'] = time();
                $fields['status'] = \app\models\Request::STATUS_1_WAIT;

                return $fields;
            }
        ]);
        if ($request === false) return false;
        $request['product_id'] = $id;
        $this->email = strtolower($this->email);
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
            $request = new \app\models\Request($request);
            $request->update([
                'user_id'    => Yii::$app->user->getId(),
                'product_id' => $id,
            ]);
            // письмо клиенту
            $result = \cs\Application::mail($user->getEmail(), 'Вы сделали очередной заказ', 'next_request_client', [
                'user'    => $user,
                'request' => $request,
            ]);
        } else {
            $fields = [
                'email'              => $this->email,
                'datetime_reg'       => gmdate('YmdHis'),
                'is_active'          => 1,
                'is_confirm'         => 0,
                'subscribe_is_tesla' => 1,
                'name_first'         => $this->name,
                'phone'              => $this->phone,
            ];
            $user = User::insert($fields);
            $fields = \app\services\RegistrationDispatcher::add($user->getId());

            $request = new \app\models\Request($request);
            $request->update([
                'user_id'    => $user->getId(),
                'product_id' => $id,
            ]);
            // письмо им
            \cs\Application::mail($this->email, 'Поздравляем вы сделали первый шаг к своему полю коллективного счастья', 'new_request_client', [
                'url'     => Url::to([
                    'site/activate',
                    'code' => $fields['code']
                ], true),
                'user'    => $user,
                'request' => $request,
            ]);
        }

        foreach (\Yii::$app->params['requestMailList'] as $item) {
            // письмо нам
            $result = Application::mail($item, 'Появился заказ на TeslaGen', 'new_request', [
                'request' => $request,
                'user'    => $user,
            ]);
//            VarDumper::dump([$result,$item]);

        }

        return $request;
    }
}
