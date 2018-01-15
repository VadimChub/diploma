<?php

namespace app\widgets\productBlock;

use yii\base\Widget;
use app\models\Product;
use app\models\Images;

class ProductBlock extends Widget
{
    public $status = Product::PRODUCT_STATUS_SELLING;

    public function run()
    {

        $new = Product::find()
            ->select(['product.title',
                'product.short_description',
                'product.price',
                'product.size',
                'product.brand_id',
                'images.image_main',
                'images.product_id',
                'brand.name'])
            ->leftJoin('images', '`images`.`product_id` = `product`.`id`')
            ->leftJoin('brand', '`brand`.`id` = `product`.`brand_id`' )
            ->where(['product.status' => $this->status])
            ->asArray()->all();


        return $this->render('product_block',[
            'new' => $new,
        ]);
    }
}