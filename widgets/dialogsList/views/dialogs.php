<?php
/* @var $dialogsList array */
use yii\helpers\Html;
foreach ($dialogsList as $dialog):
    ?>

    <ul class="list-group">
        <?= Html::beginTag('a', ['href' => \yii\helpers\Url::to(['user/dialog', 'id' => $dialog['id']])])?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= Html::encode($dialog['last_message']); ?>
            <span class="badge badge-primary badge-pill"><?= \app\models\Messages::getNumberOfUserUnreadMessagesInDialog($dialog['id']); ?></span>
        </li>
        <?= Html::endTag('a') ?>
    </ul>

<?php endforeach; ?>