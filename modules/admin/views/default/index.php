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
       <h1>Here could be some statistic information..</h1>
        <hr>
    </div>
</div>
