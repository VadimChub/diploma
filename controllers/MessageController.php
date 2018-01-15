<?php

namespace app\controllers;

class MessageController extends \yii\web\Controller
{

    public function actionSend()
    {
        return $this->render('send');
    }

}
