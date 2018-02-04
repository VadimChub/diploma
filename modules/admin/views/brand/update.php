<?php

use yii\helpers\Html;
use app\widgets\adminMenu\AdminMenu;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Brand */

$this->title = 'Update Brand: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-sm-3">
        <?= AdminMenu::widget(); ?>
    </div>
    <div class="col-sm-9">
        <div class="brand-update">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
