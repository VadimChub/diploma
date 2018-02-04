<?php

use yii\helpers\Html;
use app\widgets\adminMenu\AdminMenu;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Brand */

$this->title = 'Create Brand';
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-3">
        <?= AdminMenu::widget(); ?>
    </div>
    <div class="col-sm-9">
        <div class="brand-create">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>