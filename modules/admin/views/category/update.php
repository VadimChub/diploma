<?php

use app\widgets\adminMenu\AdminMenu;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = 'Update Category: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-sm-3">
        <?= AdminMenu::widget(); ?>
    </div>
    <div class="col-sm-9">
        <div class="category-update">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
