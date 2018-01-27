<?php
use yii\bootstrap\Modal;
use app\assets\UserAsset;
use yii\helpers\Html;
UserAsset::register($this);
?>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?= $user->username;?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?= $user->email;?></h6>

        <!--Modal window to change e-mail|password -->
        <?php

        Modal::begin([
            'header' => 'Change',
            'id'     => 'model',
            'size'   => 'model-lg',
        ]);

        echo "<div id='modelContent'></div>";

        Modal::end();

        ?>

        <p><?= Html::button('Change e-mail', ['class' => 'want-button btn btn-light', 'id' => 'modelButton', 'value' => \yii\helpers\Url::to(['user/email-update', 'user_id' => $user->id])]) ?></p>

        <p><?= Html::button('Change password', ['class' => 'want-button btn btn-light', 'id' => 'modelButton2', 'value' => \yii\helpers\Url::to(['user/password-update', 'user_id' => $user->id])]) ?></p>
    </div>
</div>