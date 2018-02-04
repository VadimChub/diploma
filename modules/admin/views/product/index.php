<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\adminMenu\AdminMenu;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="row">
    <div class="col-sm-3">
        <?= AdminMenu::widget(); ?>
    </div>
    <div class="col-sm-9">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'title',
                'short_description',
                //'description:ntext',
                //'category_id',
                //'brand_id',
                //'owner_id',
                'price',
                //'size',
                //'color',
                //'constitution',
                //'views',
                'status',
                'created_at',
                //'updated_at',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view}&nbsp;&nbsp;&nbsp;{approve}&nbsp;&nbsp;&nbsp;{delete}',
                    'buttons' => [
                            'approve' => function ($url, $post){
                                return Html::a('<span class="glyphicon glyphicon-ok"></span>', ['approve', 'id' => $post->id]);
                            }
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
