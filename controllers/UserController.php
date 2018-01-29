<?php

namespace app\controllers;

use app\models\Dialogs;
use app\models\forms\LoginForm;
use app\models\forms\PasswordChangeForm;
use app\models\Messages;
use app\models\User;
use Yii;
use app\models\forms\SignupForm;
use yii\data\ActiveDataProvider;
use app\models\Product;
use yii\helpers\Url;

class UserController extends \yii\web\Controller
{

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('login', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
           $url =  (Yii::$app->request->referrer == Url::to(['user/login'], true)) ? Url::to(['site/index']) : Yii::$app->request->referrer;
            return $this->redirect($url);
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
                Messages::saveMessage($model, $id);
                $model = new Messages();
        }

        $messages = Messages::find()->where(['dialog_id' => $id])->orderBy('created_at')->asArray()->all();
        $my_id = Yii::$app->user->getId();

        if ($messages) {
            $sender_id = ($messages[0]['sender'] == $my_id) ? $messages[0]['receiver'] : $messages[0]['sender'];
            $sender = User::findIdentity($sender_id);

            Messages::updateUnreadMessageStatus($id, $my_id);

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

    /**
     * @param $user_id integer
     * @return string|\yii\web\Response
     */
    public function actionEmailUpdate($user_id)
    {
        // This checking code needs optimisation
        if (Yii::$app->user->isGuest){
            return Yii::$app->controller->redirect(['site/index']);
        }

        $model = User::findOne($user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
           return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('email-update',[
            'model' => $model,
        ]);
    }

    /**
     * @param $user_id integer
     * @return string|\yii\web\Response
     */
    public function actionPasswordUpdate($user_id)
    {
        // This checking code needs optimisation
        if (Yii::$app->user->isGuest) {
            return Yii::$app->controller->redirect(['site/index']);
        }

        $model = new PasswordChangeForm();

        if ($model->load(Yii::$app->request->post()) && $model->changePassword($user_id)) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('password-update', [
            'model' => $model,
        ]);
    }


}
