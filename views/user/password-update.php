<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\User */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'password_hash')->passwordInput()->label('New password') ?>

        <div class="form-group">
            <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>