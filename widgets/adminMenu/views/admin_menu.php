<?php use yii\helpers\Html; ?>
<div class="list-group">
    <?= Html::beginTag('a', ['href' => \yii\helpers\Url::to(['product/index']), 'class' => 'list-group-item list-group-item-action list-group-item-dark']) ?>
    Products <span class="badge badge-primary badge-pill"><?= \app\models\Product::countAllCheckingProducts();?></span>
    <?= Html::endTag('a')?>
    <?= Html::a('Categories manage', ['category/index'], ['class' => 'list-group-item list-group-item-action list-group-item-dark']) ?>
    <?= Html::a('Brands manage', ['brand/index'], ['class' => 'list-group-item list-group-item-action list-group-item-dark']) ?>
</div>