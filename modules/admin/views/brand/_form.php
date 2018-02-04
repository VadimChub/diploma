<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\adminMenu\AdminMenu;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="brand-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>