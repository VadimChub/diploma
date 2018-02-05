<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Product;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\web\UploadedFile;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Product[] $products
 */
class Brand extends \yii\db\ActiveRecord
{
    public $image_instance;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getBrands()
    {
        $list = self::find()->asArray()->all();
        return  ArrayHelper::map($list, 'id', 'name');
    }

    /**
     * @param $image_instance UploadedFile
     */
    public function saveImage($image_instance)
    {
        $image_instance->saveAs(Yii::getAlias('@images/brands/') . md5($image_instance->baseName) . '.' . $image_instance->extension);

        Image::thumbnail(Yii::getAlias('@images/brands/') . md5($image_instance->baseName) . '.' . $image_instance->extension, 80, 50)
            ->resize(new Box(80, 50))
            ->save(Yii::getAlias('@images/brands/') . md5($image_instance->baseName) . '.' . $image_instance->extension, ['quality' => 100]);
    }

    /**
     * @param $image string way to image
     */
    public static function unlinkOldImage($image)
    {
       unlink($image);
    }
}
