<?php

namespace app\models;

use app\controllers\ProductController;
use Yii;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $image_main
 * @property string $image_side1
 * @property string $image_side2
 * @property string $image_brand
 * @property int $product_id
 *
 * @property Product $product
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_main' => 'Image Main',
            'image_side1' => 'Image Side1',
            'image_side2' => 'Image Side2',
            'image_brand' => 'Image Brand',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @param $id integer
     * this method delete all images files by product id
     */
    public static function deleteImageFilesByProductId($id)
    {
         $array  = self::find()->select(['image_main', 'image_side1', 'image_side2', 'image_brand'])->where(['product_id' => $id])->asArray()->one();
        foreach ($array as $value) {
            unlink(Yii::getAlias('@images/') . $value);
        }
        unlink(Yii::getAlias('@images'.'/thumbnail-200x300/') . $array['image_main']);
    }

    /**
     * @param $product_id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getImagesByProduct($product_id)
    {
        return self::find()->where(['product_id' => $product_id])->asArray()->one();
    }


    /**
     * @param $instanceOfImage
     * @param $name string name of image field
     * @param $helper integer helps to avoid equal hash code for multiple update of images
     */
    public function imageToUpdate ($instanceOfImage, $name, $helper)
    {
       $time1 = time()+$helper;
        //here we clone instance because after $this->save we lose our object and is impossible to save images
        $clone = clone $instanceOfImage;
        $this->$name = md5($instanceOfImage->$name->baseName.$time1) . '.' . $instanceOfImage->$name->extension;

        if ($this->save()){

            $clone->$name->saveAs(Yii::getAlias('@images/') . md5($clone->$name->baseName.$time1). '.' . $clone->$name->extension);

            Image::thumbnail(Yii::getAlias('@images/') . md5($clone->$name->baseName.$time1). '.' . $clone->$name->extension, 960, 1280)
                ->resize(new Box(960, 1280))
                ->save(Yii::getAlias('@images/') . md5($clone->$name->baseName.$time1). '.' . $clone->$name->extension, ['quality' => 100]);
            //unlink(Yii::getAlias('@images/') . md5($this->image_main->baseName.$time1). '.' . $this->image_main->extension);

            //check if updating image is main image. If yes creating thumbnail.
            if ($name == 'image_main'){
                //Creating thumbnail of main image
                Image::thumbnail(Yii::getAlias('@images/') . md5($clone->$name->baseName.$time1). '.' . $clone->$name->extension, 200, 300)
                    ->resize(new Box(200,300))
                    ->save(Yii::getAlias('@images').'/thumbnail-200x300/' . md5($clone->$name->baseName.$time1) . '.' . $clone->$name->extension,
                        ['quality' => 70]);
            }
        }
    }

    /**
     * @param $name string the way to image that need to be deleted
     */
    public static function unlinkOldImage($name){
        unlink($name);
    }

    /**
     * @param $object Images
     */
    public function imagesUpdate ($object){
        $oldAttributes = $object->getOldAttributes();
        $array = array();

        if ($object->image_main == null){
            $object->image_main = $oldAttributes['image_main'];
        }else{
            $array['image_main'] = $object->image_main;
        }
        if ($object->image_side1 == null){
            $object->image_side1 = $oldAttributes['image_side1'];
        }else{
            $array['image_side1'] = $object->image_side1;
        }
        if ($object->image_side2 == null){
            $object->image_side2 = $oldAttributes['image_side2'];
        }else{
            $array['image_side2'] = $object->image_side2;
        }
        if ($object->image_brand == null){
            $object->image_brand = $oldAttributes['image_brand'];
        }else{
            $array['image_brand'] = $object->image_brand;
        }

        $counter = 1;

        foreach ($array as $key=>$value){
            $counter++;
            $object->imageToUpdate($object, $key, $counter);
            self::unlinkOldImage(Yii::getAlias('@images/').$oldAttributes[$key]);
            if($key == 'image_main'){
                self::unlinkOldImage(Yii::getAlias('@images/thumbnail-200x300/').$oldAttributes[$key]);
            }
        }
    }


}
