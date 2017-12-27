<?php
/**
 * Created by PhpStorm.
 * User: vadimchub
 * Date: 26.12.2017
 * Time: 15:23
 */

namespace app\models\forms;

use Yii;
use app\models\User;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['username'], 'unique', 'targetClass' => User::className()],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['email'], 'unique', 'targetClass' => User::className()],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * save user
     * @return User|bool
     */
    public function save()
    {
        if ($this->validate()){

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->created_at = $time = time();
            $user->updated_at = $time;
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);

            if ($user->save()){
                return $user;
            }
        }
        return false;
    }
}