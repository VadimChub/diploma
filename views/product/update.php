<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use app\assets\ProductUpdateAsset;

/* @var $this yii\web\View */
/* @var $model app\models\forms\ProductAddForm */
/* @var $data app\models\Product */
/* @var $brands array */
/* @var $categories array */
/* @var $images app\models\Images */


$this->title = 'Update Product: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

ProductUpdateAsset::register($this);

?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-sm-3"> <img id="blah1" src="<?= Yii::getAlias('@web/images/').$images->image_main?>" height="380" width="285"><?= $form->field($images, 'image_main')->fileInput() ?></div>
        <div class="col-sm-3"> <img id="blah2" src="<?= Yii::getAlias('@web/images/').$images->image_side1?>" height="380" width="285"> <?= $form->field($images, 'image_side1')->fileInput() ?></div>
        <div class="col-sm-3">  <img id="blah3" src="<?= Yii::getAlias('@web/images/').$images->image_side2?>" height="380" width="285"><?= $form->field($images, 'image_side2')->fileInput() ?></div>
        <div class="col-sm-3">  <img id="blah4" src="<?= Yii::getAlias('@web/images/').$images->image_brand?>" height="380" width="285"><?= $form->field($images, 'image_brand')->fileInput() ?></div>
    </div>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true])->hint('This text will be on main image') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'brand_id')->textInput()->dropDownList($brands) ?>

    <?= $form->field($model, 'category_id')->textInput()->dropDownList($categories) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
        'options' => ['placeholder' => 'Select color ...'],
    ])->hint('Click on the button to select color') ?>

    <?= $form->field($model, 'constitution')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
