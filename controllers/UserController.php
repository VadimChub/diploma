<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use Yii;
use app\models\forms\SignupForm;
use yii\data\ActiveDataProvider;
use app\models\Product;

class UserController extends \yii\web\Controller
{

    /**
     * @return string|\yii\web\Response
     */
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

    /**
     * @return string|\yii\web\Response
     */
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

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/index']);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return Yii::$app->controller->redirect(['site/index']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['owner_id' => Yii::$app->user->getId()]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     */
    public function actionDialogs()
    {
        if (Yii::$app->user->isGuest){
            return Yii::$app->controller->redirect(['site/index']);
        }
        return $this->render('dialogs');
    }



}
