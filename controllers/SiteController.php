<?php

namespace app\controllers;

use app\models\Images;
use app\models\User;
use app\modules\admin\models\Category;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\ContactForm;
use app\models\Product;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @param $category string GET param
     * @return string
     */
    public function actionCategory($category)
    {
        $category_name = $category;
        $category_id = Category::getCategoryIdByName($category);
        return $this->render('category', [
           'category_name' => $category_name,
            'category_id' => $category_id,
        ]);
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionProduct($id)
    {
        $model = $this->findProductModel($id);
        $views = $model->views;
        $model->views = ++$views;
        $model->save();

        $images = Images::getImagesByProduct($id);

        $owner = User::findOne($model->owner_id);

        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'receiver',
            'value' => $model->owner_id,
        ]));
        return $this->render('product', [
            'model' => $model,
            'images' => $images,
            'owner' => $owner,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProductModel($id)
    {
        if (($model = Product::findOne(['id' => $id, 'status' => Product::PRODUCT_STATUS_SELLING])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
