<?php

namespace app\models;

use Yii;

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

}
