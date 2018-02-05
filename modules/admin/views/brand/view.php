<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\adminMenu\AdminMenu;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Brand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-3">
        <?= AdminMenu::widget(); ?>
    </div>
    <div class="col-sm-4">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
            ],
        ]) ?>
    </div>
    <div class="col-sm-5">
        <?= Html::img(Yii::getAlias('@web/images/brands/').$model->image, ['height' => 100, 'width' => 200])?>
    </div>
</div>

