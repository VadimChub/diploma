<?php

namespace app\models\forms;

use app\models\Images;
use app\models\Product;
use Yii;
use yii\base\Model;
use app\models\Category;
use app\models\Brand;
use yii\web\UploadedFile;


class ProductAddForm extends Model
{
    public $title;
    public $short_description;
    public $description;
    public $category;
    public $brand;
    public $price;
    public $size;
    public $color;
    public $constitution;
    public $image_main;
    public $image_side1;
    public $image_side2;
    public $image_brand;
    public $product_id;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'short_description'], 'required'],
            [['title', 'short_description', 'constitution'], 'string', 'max' => 255],

            [['brand', 'category'], 'required'],
            [['brand', 'category'], 'string', 'max' => 255],
            [['brand'], 'unique', 'targetClass' => Brand::className(), 'targetAttribute' => 'name'],
            [['category'], 'unique', 'targetClass' => Category::className(), 'targetAttribute' => 'name'],

            [['description'], 'required'],
            [['description'], 'string'],

            [['price'], 'required'],
            [['price'], 'integer'],

            [['size'], 'string', 'max' => 7],

            [['color'], 'string', 'max' => 20],

            [['image_main', 'image_side1', 'image_side2', 'image_brand'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

        ];
    }

    public function save ()
    {
        if ($this->validate()){

            $product = new Product();
            $images = new Images();

            $product_transaction = Product::getDb()->beginTransaction();
            $images_transaction = Images::getDb()->beginTransaction();
            try {

                $product->title = $this->title;
                $product->short_description = $this->short_description;
                $product->description = $this->description;
                $product->category_id = $this->category;
                $product->brand_id = $this->brand;
                $product->price = $this->price;
                $product->color = $this->color;
                $product->size = $this->size;
                $product->constitution = $this->constitution;
                $product->status = Product::PRODUCT_STATUS_CHECKING;
                $product->created_at = $date = date('Y-m-d H:i:s');
                $product->updated_at = $date;

                $images->image_main = Yii::getAlias('@images/'). $this->image_main->baseName . '.' . $this->image_main->extension;
                $images->image_side1 = Yii::getAlias('@images/'). $this->image_side1->baseName . '.' . $this->image_side1->extension;
                $images->image_side2 = Yii::getAlias('@images/'). $this->image_side2->baseName . '.' . $this->image_side2->extension;
                $images->image_brand = Yii::getAlias('@images/'). $this->image_brand->baseName . '.' . $this->image_brand->extension;

                if ($product->save()){
                    $images->product_id = $product->id;
                    if ($images->save()){

                        $this->image_main->saveAs(Yii::getAlias('@images/') . $this->image_main->baseName . '.' . $this->image_main->extension);
                        $this->image_side1->saveAs(Yii::getAlias('@images/') . $this->image_side1->baseName . '.' . $this->image_side1->extension);
                        $this->image_side2->saveAs(Yii::getAlias('@images/') . $this->image_side2->baseName . '.' . $this->image_side2->extension);
                        $this->image_brand->saveAs(Yii::getAlias('@images/') . $this->image_brand->baseName . '.' . $this->image_brand->extension);

                        $product_transaction->commit();
                        $images_transaction->commit();

                        return true;
                    }
                }
            } catch(\Exception $e) {
                $product_transaction->rollBack();
                $images_transaction->rollBack();
                throw $e;
            } catch(\Throwable $e) {
                $product_transaction->rollBack();
                $images_transaction->rollBack();
                throw $e;
            }

        }

        return false;
    }

}