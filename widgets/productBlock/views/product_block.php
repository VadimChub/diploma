
<?php var_dump($new);
use yii\helpers\Html;
use app\assets\BlockAsset;
?>

<head>
<?php BlockAsset::register($this); ?>
</head>

<?php foreach ($new as $item): ?>
<div class="col-sm-3">
    <div class="product-block"
         style="background: url(<?= '/' . $item['image_main'] ?>) no-repeat center top; height: 300px; width: 200px">
        <?php echo Html::beginTag('a', ['href' => \yii\helpers\Url::to(['site/index', 'id' => $item['product_id']])]); ?>
        <div class="product-block-info">
            <div class="product-block-title"><h3><?= $item['title'] ?></h3></div>
            <div class="product-block-desc"><p><?= $item['short_description'] ?></p></div>
            <div class="product-block-price"><h4>Price <?= $item['price'] ?> UAH</h4></div>
            <div class="product-block-brand"><h3><?= $item['name'] ?></h3></div>
            <div class="product-block-size"><?= $item['size'] ?></div>
        </div>
        <?= Html::endTag('a') ?>
    </div>
</div>

<?php endforeach; ?>
