<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Test;


class TestController extends Controller
{
    public function actionIndex ()
    {
        $items = Test::getNews();
       return $this->render('index',[
           'item'=>$items,
       ]);
    }

}