<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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


}
