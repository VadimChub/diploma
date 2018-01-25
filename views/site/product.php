<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $images array */

\app\assets\ProductPageAsset::register($this);

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap\Modal;
use slavkovrn\imagegalary\ImageGalaryWidget;
?>

<div class="main-container">
    <div class="row">
        <div class="col-sm-9">

            <div class="col-sm-5">
                <div class="gallery">
                    <?= ImageGalaryWidget::widget([
                        'id' =>'imagegalary',       // id of plugin should be unique at page
                        'class' =>'imagegalary',    // class of div to define style
                        'css' => 'border:black;',   // css commands of class (for example - border-radius:5px;)
                        'image_width' => 220,       // height of image visible in pixels
                        'image_height' => 340,      // width of image visible in pixels
                        'thumb_width' => 40,        // height of thumb images in pixels
                        'thumb_height' => 80,       // width of thumb images in pixels
                        'items' => 4,               // number of thumb items
                        'images' => [               // images of galary
                            [
                                'src' => Yii::getAlias('@web/images/').$images['image_main'],
                                'title' => 'Image visible in widget',
                            ],
                            [
                                'src' => Yii::getAlias('@web/images/').$images['image_side1'],
                                'title' => 'image 1',
                            ],
                            [
                                'src' => Yii::getAlias('@web/images/').$images['image_side2'],
                                'title' => 'image 2',
                            ],
                            [
                                'src' => Yii::getAlias('@web/images/').$images['image_brand'],
                                'title' => 'image 3',
                            ],
                        ]
                    ]) ?>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="product-header"><h3><?= $model->title;?></h3>
                    <h5><?= $model->short_description;?></h5>
                </div>
                <div class="product-description">

                    <h4>General info:</h4>
                    <p><?= $model->description;?></p>

                    <?php if ($model->size): ?>
                    <h5>Size:</h5>
                    <p><?= $model->size; ?></p>
                    <?php endif;?>

                    <?php if ($model->constitution): ?>
                    <h5>Constitution:</h5>
                    <p><?= $model->constitution; ?></p>
                    <?php endif; ?>

                    <h5>Producer:</h5>
                    <span id="brand"><?= $model->getBrand()->name;?></span>
                    <br>
                    <br>
                    <div class="views"><i>Views: <?= $model->views; ?> </i></div>
                </div>
            </div>

        </div>
        <div class="col-sm-3">
            <div class="row>">
                <div class="product-block-right">
                    <div class="product-price-right"><h3><?= $model->price?> UAH</h3></div>
                   <!--Modal window to send message -->
                    <?php

                    Modal::begin([
                        'header' => '<h4>Contact to seller</h4>',
                        'id'     => 'model',
                        'size'   => 'model-lg',
                    ]);

                    echo "<div id='modelContent'></div>";

                    Modal::end();

                    ?>

                    <div class="product-want-button">
                        <?= Html::button('I want', ['class' => 'want-button btn btn-danger', 'id' => 'modelButton', 'value' => \yii\helpers\Url::to(['message/send'])]) ?>
                    </div>
                    <div class="product-owner-info">
                        <h4>Here will be text about owner</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
