<?php

namespace  app\modules\admin\controllers\behaviors;

use yii\base\Behavior;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\User;

class AccessBehavior extends Behavior
{
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'checkAdminAccess'
        ];
    }

    public function checkAdminAccess()
    {
        if (Yii::$app->user->isGuest || !User::isAdmin(Yii::$app->user->identity->username, Yii::$app->user->identity->password_hash)){
            return Yii::$app->controller->redirect(Url::home());
        }
    }

}