<?php

namespace app\widgets\dialogsList;

use yii\base\Widget;
use Yii;
use app\models\Dialogs;

class DialogsList extends Widget
{
    public function run()
    {
        $user_id = Yii::$app->user->identity->getId();
        $dialogsList = Dialogs::getDialogsByUserId($user_id);

        return $this->render('dialogs',[
            'dialogsList' => $dialogsList,
        ]);

    }

}