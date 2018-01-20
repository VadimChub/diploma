<?php

/* @var $this yii\web\View */

use app\widgets\productBlock\ProductBlock;

$this->title = 'My Yii Application';
?>
<div class="main-container">
    <div class="row>">
        <h2>Last added products:</h2>
        <br>
    </div>
    <div class="row">
        <?= ProductBlock::widget(); ?>
    </div>
</div>
