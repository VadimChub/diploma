<?php
/* @var $dialogsList array */
foreach ($dialogsList as $dialog):
    ?>

    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= $dialog['last_message']; ?>
            <span class="badge badge-primary badge-pill"><?= \app\models\Messages::getNumberOfUserUnreadMessages($dialog['id']); ?></span>
        </li>
    </ul>

<?php endforeach; ?>