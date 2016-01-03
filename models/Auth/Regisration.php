<?php

namespace app\models\Auth;

use app\models\User;
use cs\base\BaseForm;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * LoginForm is the model behind the login form.
 */
class Regisration extends BaseForm
{
    public $name;
    public $username;
    private $_user = false;


    public function __construct($config = [])
    {
        self::$fields = [
            [
                'username', 'Логин', 1, 'string'
            ],
            [
                'name', 'Имя', 1, 'string'
            ],
        ];
        parent::__construct($config);
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return ArrayHelper::merge([
            // password is validated by validatePassword()
            ['username', 'validateUser'],
        ], $this->rulesAdd());
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUser($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (is_null($user)) {
                $this->addError($attribute, 'Пользователя нет');
                return;
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
