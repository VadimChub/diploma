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
 * @property integer $owner_id
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
    const PRODUCT_STATUS_SELLING = 100;
    const PRODUCT_STATUS_SOLD = 200;
    const PRODUCT_STATUS_CHECKING = 300;
    const PRODUCT_STATUS_PAUSED = 400;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'short_description'], 'required'],
            [['title', 'short_description', 'constitution'], 'string', 'max' => 255],

            [['brand_id', 'category_id'], 'required'],
            [['brand_id', 'category_id'], 'integer'],
            [['brand_id'], 'unique', 'targetClass' => Brand::className(), 'targetAttribute' => 'name'],
            [['category_id'], 'unique', 'targetClass' => Category::className(), 'targetAttribute' => 'name'],

            [['description'], 'required'],
            [['description'], 'string'],

            [['price'], 'required'],
            [['price'], 'integer'],

            [['size'], 'string', 'max' => 7],

            [['color'], 'string', 'max' => 20],
        ];
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
            'owner_id' => 'Owner ID',
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

    /**
     * @return \yii\db\ActiveQuery|array
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id'])->one();
    }

    /**
     * @param $status integer constant of Product model
     * @return int|string
     */
    public static function countProductsByStatus($status)
    {
       return self::find()->where(['owner_id' => Yii::$app->user->identity->getId(), 'status' => $status])->count();
    }

    /**
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getImages()
    {
        return $this->hasOne(Images::className(), ['product_id' => 'id'])->one();
    }



}
