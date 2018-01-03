<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $price
 * @property string $size
 * @property string $color
 * @property string $constitution
 * @property integer $views
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Brand $brand
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'brand_id' => 'Brand ID',
            'price' => 'Price',
            'size' => 'Size',
            'color' => 'Color',
            'constitution' => 'Constitution',
            'views' => 'Views',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery|array
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id'])->one();
    }

    /**
     * @return \yii\db\ActiveQuery|array
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])->one();
    }
}
