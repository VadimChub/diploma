<?php use yii\helpers\Html; ?>
<div class="list-group">
    <?= Html::a('My Products', ['user/index'], ['class' => 'list-group-item list-group-item-action list-group-item-dark']) ?>
    <?= Html::beginTag('a', ['href' => \yii\helpers\Url::to(['user/dialogs']), 'class' => 'list-group-item list-group-item-action list-group-item-dark']) ?>
    Dialogs <span class="badge badge-primary badge-pill"><?= \app\models\Messages::getNumberOfAllUserUnreadedMessages(Yii::$app->user->getId()); ?></span>
    <?= Html::endTag('a')?>
</div>