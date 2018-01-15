<?php

/* @var this views/user/View*/
/* @var $dialogsList array */

use yii\helpers\Html;

?>

<div class="row">

    <div class="col-sm-3">
        <?php echo \app\widgets\userMenu\UserMenu::widget(); ?>
    </div>

    <div class="col-sm-6">
            <?php echo \app\widgets\dialogsList\DialogsList::widget(); ?>
    </div>

    <div class="col-sm-3">
        <?php echo \app\widgets\userMenu\UserInfo::widget(); ?>
    </div>

</div>
