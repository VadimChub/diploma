<?php

namespace app\controllers;

use app\models\Dialogs;
use app\models\forms\LoginForm;
use app\models\Messages;
use app\models\User;
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

    /**
     * @param $id integer
     * @return string
     */
    public function actionDialog($id)
    {
        if (Yii::$app->user->isGuest){
            return Yii::$app->controller->redirect(['site/index']);
        }

        $model = new Messages();

        if ($model->load(Yii::$app->request->post())){

            $model->sender = intval($model->sender);
            $model->receiver = intval($model->receiver);
            $model->dialog_id = $id;
            $model->created_at = date('Y-m-d H:i:s');
            $model->status = $model::MESSAGE_STATUS_UNREADED;
            $model->is_deleted_sender = $model::MESSAGE_STATUS_OKAY;
            $model->is_deleted_receiver = $model::MESSAGE_STATUS_OKAY;

            if($model->validate()){
                $model->save();
                $model = new Messages();
            }
        }

        $messages = Messages::find()->where(['dialog_id' => $id])->orderBy('created_at')->asArray()->all();
        $my_id = Yii::$app->user->getId();

        if ($messages) {
            $sender_id = ($messages[0]['sender'] == $my_id) ? $messages[0]['receiver'] : $messages[0]['sender'];
            $sender = User::findIdentity($sender_id);

            return $this->render('dialog', [
                'messages' => $messages,
                'my_id' => $my_id,
                'sender' => $sender,
                'model' => $model,
                'dialog_id' => $id,
            ]);

        } else {
            return Yii::$app->controller->redirect(['site/index']);
        }

    }



}
