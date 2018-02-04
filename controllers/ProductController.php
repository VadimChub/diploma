<?php

namespace app\controllers;

use app\controllers\behaviors\AccessBehavior;
use app\models\forms\ProductAddForm;
use app\models\Images;
use Yii;
use app\models\Product;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\modules\admin\models\Brand;
use app\modules\admin\models\Category;
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
        $images = Images::getImagesByProduct($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'images' => $images,
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
        $images = Images::findOne(['product_id' => $id]);
        $brands = Brand::getBrands();
        $categories = Category::getCategories();
        $model->updated_at = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post())){
            $images->image_main = UploadedFile::getInstance($images, 'image_main');
            $images->image_side1 = UploadedFile::getInstance($images, 'image_side1');
            $images->image_side2 = UploadedFile::getInstance($images, 'image_side2');
            $images->image_brand = UploadedFile::getInstance($images, 'image_brand');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $images->imagesUpdate($images);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'brands' => $brands,
                'categories' => $categories,
                'images' => $images,
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
     * @param $id
     * @return Product|ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Product::find()->where(['id' => $id, 'owner_id' => Yii::$app->user->getId()])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }





}
