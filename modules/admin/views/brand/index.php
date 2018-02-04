<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\adminMenu\AdminMenu;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">
    <div class="row>">
        <div class="col-sm-3">
            <?= AdminMenu::widget(); ?>
        </div>
        <div class="col-sm-9">
                <?= Html::a('Add new Brand', ['create'], ['class' => 'btn btn-success']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'name',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
