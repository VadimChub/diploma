<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use Yii;
use app\models\forms\SignupForm;

class UserController extends \yii\web\Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->redirect(['site/index']);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $user = $model->save()){
            Yii::$app->user->login($user);
            Yii::$app->session->setFlash('success','You have been registred');
            return $this->redirect(['site/index']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/index']);
    }

}