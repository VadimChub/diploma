<?php

/* @var $model /models/Messages */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'message')->textarea(['rows' => 5]) ?>

<?= $form->field($model, 'sender')->hiddenInput(['value' => Yii::$app->user->identity->getId()])->label(false); ?>

<?= $form->field($model, 'receiver')->hiddenInput(['value' => Yii::$app->request->cookies['receiver']])->label(false); ?>

<div class="form-group">
    <?= Html::submitButton('Send message', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
</div>

<?php ActiveForm::end(); ?>
