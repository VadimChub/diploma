<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\modules\admin\models\LoginAdminForm;
use yii\web\Controller;
use Yii;
use app\modules\admin\controllers\behaviors\AccessBehavior;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            AccessBehavior::className(),
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
