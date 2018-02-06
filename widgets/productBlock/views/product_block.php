<?php

/* @var $products array */
/* @var $pages \yii\data\Pagination */

use yii\helpers\Html;
use app\assets\BlockAsset;
use yii\widgets\LinkPager;
?>

<head>
<?php BlockAsset::register($this); ?>
</head>

<?php foreach ($products as $item): ?>
<div class="col-sm-3">
    <div class="product-block"
         style="background: url(<?= '/images/thumbnail-200x300/'. $item['image_main'] ?>) no-repeat center top; width: 200px; height: 300px;">
        <?php echo Html::beginTag('a', ['href' => \yii\helpers\Url::to(['site/product', 'id' => $item['product_id']])]); ?>
        <div class="product-block-info">
            <div class="product-block-title"><h3><?= $item['title'] ?></h3></div>
            <div class="product-block-desc"><p><?= $item['short_description'] ?></p></div>
            <div class="product-block-price"><h4><?= $item['price'] ?> UAH</h4></div>
            <div class="product-block-brand"><h3><?= $item['name'] ?></h3></div>
            <div class="product-block-size"><?= $item['size'] ?></div>
        </div>
        <?= Html::endTag('a') ?>
    </div>
</div>

<?php endforeach; ?>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]);?>
