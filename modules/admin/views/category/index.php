<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\adminMenu\AdminMenu;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index">
    <div class="row>">
        <div class="col-sm-3">
            <?= AdminMenu::widget(); ?>
        </div>
        <div class="col-sm-9">
            <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '&nbsp;{update}&nbsp;&nbsp;&nbsp;{delete}'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
