<?php

namespace app\widgets\userMenu;

use app\models\User;
use Yii;
use yii\base\Widget;



class UserInfo extends Widget
{
    public function run()
    {
        $username = Yii::$app->user->identity->username;
        $user = User::findByUserName($username);

        return $this->render('user_info', [
            'user' =>$user,
        ]);
    }
}