<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use slavkovrn\imagegalary\ImageGalaryWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Approve', ['approve', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-sm-7">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'short_description',
                    'description:ntext',
                    'category_id',
                    'brand_id',
                    'owner_id',
                    'price',
                    'size',
                    'color',
                    'constitution',
                    'views',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>
        </div>

        <div class="col-sm-5">
            <?= ImageGalaryWidget::widget([
                'id' => 'imagegalary',       // id of plugin should be unique at page
                'class' => 'imagegalary',    // class of div to define style
                'css' => 'border:white;',   // css commands of class (for example - border-radius:5px;)
                'image_width' => 300,       // height of image visible in pixels
                'image_height' => 400,      // width of image visible in pixels
                'thumb_width' => 60,        // height of thumb images in pixels
                'thumb_height' => 80,       // width of thumb images in pixels
                'items' => 3,               // number of thumb items
                'images' => [               // images of gallery
                    [
                        'src' => Yii::getAlias('@web/images/') . $images['image_main'],
                        'title' => 'Image visible in widget',
                    ],
                    [
                        'src' => Yii::getAlias('@web/images/') . $images['image_side1'],
                        'title' => 'image 1',
                    ],
                    [
                        'src' => Yii::getAlias('@web/images/') . $images['image_side2'],
                        'title' => 'image 2',
                    ],
                    [
                        'src' => Yii::getAlias('@web/images/') . $images['image_brand'],
                        'title' => 'image 3',
                    ],
                ]
            ]) ?>
        </div>

    </div>
</div>
