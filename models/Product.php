<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{

    const PRODUCT_STATUS_CHECKING = 0;
    const PRODUCT_STATUS_SELLING = 1;
    const PRODUCT_STATUS_SOLD = 2;
    const PRODUCT_STATUS_VIP = 3;



    public function rules()
    {
        return [
            [['title', 'short_description', 'description', 'price', 'size'], 'required'],
            [['producer', 'title', 'short_description', 'size', 'color', 'constitution', 'description'], 'string'],
            [['price'], 'integer'],
        ];
    }

}