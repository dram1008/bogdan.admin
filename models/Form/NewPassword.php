<?php

namespace app\models\Form;

use cs\base\BaseForm;
use cs\base\DbRecord;
use cs\Widget\FileUpload2\FileUpload;
use yii\base\Model;

class NewPassword extends Model
{
    public $password1;
    public $password2;


    public function rules()
    {
        return [
            [
                [
                    'password1',
                    'password2'
                ],
                'required',
                'message' => 'Это поле должно быть заполнено обязательно'
            ],
            [
                [
                    'password1',
                    'password2'
                ],
                'passwordValidate',
            ],
        ];
    }

    public function passwordValidate($attribute, $params)
    {
        if ($this->password1 != '' and $this->password2 != '') {
            if ($this->password1 != $this->password2) {
                $this->addError($attribute, 'Пароли должны совпадать');
            }
        }
    }

    /**
     * @param \app\models\User $user
     *
     * @return bool
     * @throws \yii\base\InvalidParamException
     */
    public function update($user)
    {
        if ($this->validate()) {
            $user->setPassword($this->password1);

            return true;
        } else {
            return false;
        }
    }
}
