<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use app\assets\ProductUpdateAsset;


/* @var $this yii\web\View */
/* @var $model app\models\forms\ProductAddForm */
/* @var $brands array */
/* @var $categories array */

\app\assets\ProductAddAsset::register($this);

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row">
    <div class="col-sm-3"><img id="blah1" src="<?= Yii::getAlias('@web/images/default/')?>image_main.png" height="380" width="285"> <?= $form->field($model, 'image_main')->fileInput() ?></div>
    <div class="col-sm-3"><img id="blah2" src="<?= Yii::getAlias('@web/images/default/')?>image_side1.png" height="380" width="285"> <?= $form->field($model, 'image_side1')->fileInput() ?></div>
    <div class="col-sm-3"><img id="blah3" src="<?= Yii::getAlias('@web/images/default/')?>image_side2.png" height="380" width="285"> <?= $form->field($model, 'image_side2')->fileInput() ?></div>
    <div class="col-sm-3"><img id="blah4" src="<?= Yii::getAlias('@web/images/default/')?>image_brand.png" height="380" width="285"> <?= $form->field($model, 'image_brand')->fileInput() ?></div>
</div>

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
