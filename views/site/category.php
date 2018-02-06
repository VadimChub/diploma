<?php

/* @var $this yii\web\View */
/* @var $category_name string GET param */
/* @var $category_id integer */

use app\widgets\productBlock\ProductBlock;
use app\models\Product;

$this->title = 'My Yii Application';
?>
<div class="main-container">
    <div class="row>">
        <h2><?= $category_name ?>:</h2>
        <br>
    </div>
    <div class="row">
        <?php $object = new ProductBlock();
        $object->setCondition(['status' => Product::PRODUCT_STATUS_SELLING, 'category_id' => $category_id])
        ?>
        <?= $object->run(); ?>
    </div>
</div>
