<?php

namespace app\models\forms;

use app\models\Images;
use app\models\Product;
use Yii;
use yii\base\Model;
use app\models\Category;
use app\models\Brand;
use yii\imagine\Image;
use Imagine\Image\Box;


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
                $product->owner_id = Yii::$app->user->identity->getId();
                $product->price = $this->price;
                $product->color = $this->color;
                $product->size = $this->size;
                $product->constitution = $this->constitution;
                $product->status = Product::PRODUCT_STATUS_CHECKING;
                $product->created_at = $date = date('Y-m-d H:i:s');
                $product->updated_at = $date;

                //different times if user will upload the same image to avoid equal hash
                $time1 = time();
                $time2 = $time1+1;
                $time3 = $time2+1;
                $time4 = $time3+1;

                $images->image_main =   md5($this->image_main->baseName.$time1) . '.' . $this->image_main->extension;
                $images->image_side1 =  md5($this->image_side1->baseName.$time2) . '.' . $this->image_side1->extension;
                $images->image_side2 =  md5($this->image_side2->baseName.$time3) . '.' . $this->image_side2->extension;
                $images->image_brand =  md5($this->image_brand->baseName.$time4) . '.' . $this->image_brand->extension;

                if ($product->save()){
                    $images->product_id = $product->id;
                    if ($images->save()){

                        $this->image_main->saveAs(Yii::getAlias('@images/') . md5($this->image_main->baseName.$time1). '.' . $this->image_main->extension);
                        $this->image_side1->saveAs(Yii::getAlias('@images/') . md5($this->image_side1->baseName.$time2) . '.' . $this->image_side1->extension);
                        $this->image_side2->saveAs(Yii::getAlias('@images/') . md5($this->image_side2->baseName.$time3) . '.' . $this->image_side2->extension);
                        $this->image_brand->saveAs(Yii::getAlias('@images/') . md5($this->image_brand->baseName.$time4) . '.' . $this->image_brand->extension);

                        Image::thumbnail(Yii::getAlias('@images/') . md5($this->image_main->baseName.$time1). '.' . $this->image_main->extension, 960, 1280)
                            ->resize(new Box(960, 1280))
                            ->save(Yii::getAlias('@images/') . md5($this->image_main->baseName.$time1). '.' . $this->image_main->extension, ['quality' => 100]);
                        //unlink(Yii::getAlias('@images/') . md5($this->image_main->baseName.$time1). '.' . $this->image_main->extension);

                        Image::thumbnail(Yii::getAlias('@images/') . md5($this->image_side1->baseName.$time2) . '.' . $this->image_side1->extension, 960, 1280)
                            ->resize(new Box(960, 1280))
                            ->save(Yii::getAlias('@images/') . md5($this->image_side1->baseName.$time2) . '.' . $this->image_side1->extension, ['quality' => 100]);
                        //unlink(Yii::getAlias('@images/') . md5($this->image_side1->baseName.$time2) . '.' . $this->image_side1->extension);

                        Image::thumbnail(Yii::getAlias('@images/') . md5($this->image_side2->baseName.$time3) . '.' . $this->image_side2->extension, 960, 1280)
                            ->resize(new Box(960, 1280))
                            ->save(Yii::getAlias('@images/') . md5($this->image_side2->baseName.$time3) . '.' . $this->image_side2->extension, ['quality' => 100]);
                        //unlink(Yii::getAlias('@images/') . md5($this->image_side2->baseName.$time3) . '.' . $this->image_side2->extension);

                        Image::thumbnail(Yii::getAlias('@images/') . md5($this->image_brand->baseName.$time4) . '.' . $this->image_brand->extension, 960, 1280)
                            ->resize(new Box(960, 1280))
                            ->save(Yii::getAlias('@images/') . md5($this->image_brand->baseName.$time4) . '.' . $this->image_brand->extension, ['quality' => 100]);
                        //unlink(Yii::getAlias('@images/') . md5($this->image_brand->baseName.$time4) . '.' . $this->image_brand->extension);

                        //Creating thumbnail of main image
                        Image::thumbnail(Yii::getAlias('@images/') . md5($this->image_main->baseName.$time1). '.' . $this->image_main->extension, 200, 300)
                            ->resize(new Box(200,300))
                            ->save(Yii::getAlias('@images').'/thumbnail-200x300/' . md5($this->image_main->baseName.$time1) . '.' . $this->image_main->extension,
                                ['quality' => 70]);


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