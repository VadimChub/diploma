<?php

/* @var this views/user/View*/
/* @var $dataProvider */

use yii\helpers\Html;
use app\widgets\userMenu\UserInfo;
use app\widgets\userMenu\UserMenu;
use yii\grid\GridView;

?>

<div class="row">

    <div class="col-sm-3">
        <?= UserMenu::widget(); ?>
    </div>

    <div class="col-sm-7">

        <p>
            <?= Html::a('Add Product', ['product/create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'title',
                'short_description',
                //'description:ntext',
                //'brand_id',
                // 'category_id',
                'price',
                // 'size',
                // 'color',
                // 'constitution',
                'views',
                'status',
                'created_at',

                ['class' => 'yii\grid\ActionColumn', 'controller' => 'product'],
            ],
        ]); ?>
    </div>

    <div class="col-sm-2">
        <?= UserInfo::widget(); ?>
    </div>

</div>
