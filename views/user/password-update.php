<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\User */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin([
            'id' => 'update-form',
            'enableAjaxValidation' => true,
            'validateOnSubmit' => true,
        ]); ?>

        <?= $form->field($model, 'old_password')->passwordInput()->label('Old password') ?>

        <?= $form->field($model, 'new_password')->passwordInput()->label('New password') ?>

        <?= $form->field($model, 'new_password_repeat')->passwordInput()->label('New password repeat') ?>

        <div class="form-group">
            <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>