<?php

namespace app\controllers;

use app\controllers\behaviors\AccessBehavior;
use app\models\Brand;
use app\models\forms\ProductAddForm;
use app\models\Images;
use Yii;
use app\models\Product;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            AccessBehavior::className(),
        ];
    }


    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductAddForm();
        $brands = Brand::getBrands();
        $categories = Category::getCategories();

        if ( $model->load(Yii::$app->request->post())) {

            $model->image_main = UploadedFile::getInstance($model, 'image_main');
            $model->image_side1 = UploadedFile::getInstance($model, 'image_side1');
            $model->image_side2 = UploadedFile::getInstance($model, 'image_side2');
            $model->image_brand = UploadedFile::getInstance($model, 'image_brand');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Your product was successfully sent to moderating');
                return $this->redirect(['user/index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'brands' => $brands,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $brands = Brand::getBrands();
        $categories = Category::getCategories();
        $model->updated_at = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'brands' => $brands,
                'categories' => $categories,
            ]);
        }
    }


    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Images::deleteImageFilesByProductId($id);
        $this->findModel($id)->delete();

        return $this->redirect(['user/index']);
    }


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




}
