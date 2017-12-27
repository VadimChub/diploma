<?php

namespace app\models\forms;

use Yii;
use app\models\User;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['password', 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            $user = User::findByUserName($this->username);
            return Yii::$app->user->login($user);
        }
    }

    public function validatePassword($attribute, $params)
    {
        $user = User::findByUserName($this->username);

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect password');
        }
    }
}