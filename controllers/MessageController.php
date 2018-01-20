<?php

namespace app\controllers;

use app\models\Dialogs;
use app\models\Messages;
use Yii;

class MessageController extends \yii\web\Controller
{

    public function actionSend()
    {
        $model = new Messages();

        if ($model->load(Yii::$app->request->post())){

            if ($dialog_info = Dialogs::getUsersDialog($model->sender, $model->receiver)){
                $dialog_id = $dialog_info['id'];
            } else {
               Dialogs::createNewDialog($model->sender, $model->receiver, $model->message);
               $dialog_info = Dialogs::getUsersDialog($model->sender, $model->receiver);
               $dialog_id = $dialog_info['id'];
            }
            $model->sender = intval($model->sender);
            $model->receiver = intval($model->receiver);
            $model->dialog_id = $dialog_id;
            $model->created_at = date('Y-m-d H:i:s');
            $model->status = $model::MESSAGE_STATUS_UNREADED;
            $model->is_deleted_sender = $model::MESSAGE_STATUS_OKAY;
            $model->is_deleted_receiver = $model::MESSAGE_STATUS_OKAY;

            if(!$model->save()){ var_dump($model->getErrors()); die;}
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $dialog = Dialogs::findOne($dialog_id);
            $dialog->last_message = $model->message;
            $dialog->save();
            Yii::$app->session->setFlash('success','Your message have been sent');
            return $this->redirect(Yii::$app->request->referrer);

        } else {
            return $this->renderAjax('send', [
                'model' => $model,
            ]);
        }
    }

}
