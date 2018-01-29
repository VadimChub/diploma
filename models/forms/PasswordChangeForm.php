<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\User;
use Yii;

class PasswordChangeForm extends Model
{
    public $old_password;
    public $new_password;
    public $new_password_repeat;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['old_password', 'required'],
            ['old_password', 'string', 'min' => 6],
            ['new_password', 'required'],
            ['new_password', 'string', 'min' => 6],
            ['new_password_repeat', 'required'],
            ['new_password_repeat', 'compare', 'compareAttribute'=>'new_password', 'message'=>"Passwords don't match" ],
        ];
    }

    public function changePassword($user_id)
    {
        if ($this->validate()) {
            $user = User::findOne($user_id);
            if ($user->validatePassword($this->old_password)) {
               $user->password_hash = Yii::$app->security->generatePasswordHash($this->new_password);
               if ($user->save()){
                  return $user;
               }
            }
        }
    }


}