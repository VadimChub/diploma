<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;


/* @var $this yii\web\View */
/* @var $model app\models\forms\ProductAddForm */
/* @var $brands array */
/* @var $categories array */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true])->hint('This text will be on main image') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'brand')->textInput()->dropDownList($brands, ['prompt' => 'Select brand of your product']) ?>

    <?= $form->field($model, 'category')->textInput()->dropDownList($categories, ['prompt' => 'Select category of your product']) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'Select color ...'],
    ])->hint('Click on the button to select color') ?>

    <?= $form->field($model, 'constitution')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
