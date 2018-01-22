<?php

/* @var this views/user/dialog */
/* @var $messages array */
/* @var $my_id integer id of current user */
/* @var $dialog_id integer */

use yii\helpers\Html;
use app\assets\ConversationAsset;
use app\models\Messages;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

ConversationAsset::register($this);

?>

<div class="row">

    <div class="col-sm-3">
        <?php echo \app\widgets\userMenu\UserMenu::widget(); ?>
    </div>

    <div class="col-sm-6">
        <div class="messages-block">
            <div class="conversation">
                <?php Pjax::begin(['id' => 'messages']) ?>
                <?php foreach ($messages as $message): ?>

                    <?php if ($message['sender'] == $my_id && $message['is_deleted_sender'] == Messages::MESSAGE_STATUS_OKAY) : ?>
                        <div class="sender-message alert alert-warning" role="alert">
                            <div class="message-time-sender">Me | <?= $message ['created_at']?></div>

                            <?= $message['message'] ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($message['receiver'] == $my_id && $message['is_deleted_receiver'] == Messages::MESSAGE_STATUS_OKAY) : ?>
                        <div class="receiver-message alert alert-info" role="alert">
                            <div class="message-time-receiver"><?= $sender->username?> | <?= $message ['created_at']?></div>
                            <?= $message['message'] ?>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
                <?php Pjax::end() ?>
            </div>

            <div class="message-send">
                <?php yii\widgets\Pjax::begin(['id' => 'new_message']) ?>

                <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

                <?= $form->field($model, 'message')->textarea(['rows' => 5]) ?>

                <?= $form->field($model, 'sender')->hiddenInput(['value' => $my_id])->label(false); ?>

                <?= $form->field($model, 'receiver')->hiddenInput(['value' => $sender->id])->label(false); ?>

                <div class="form-group">
                    <?= Html::submitButton('Send message', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                <?php Pjax::end(); ?>
            </div>

        </div>
    </div>

    <div class="col-sm-3">
        <?php echo \app\widgets\userMenu\UserInfo::widget(); ?>
    </div>

</div>