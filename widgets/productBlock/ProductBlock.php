<?php

namespace app\widgets\productBlock;

use yii\base\Widget;
use app\models\Product;
use yii\data\Pagination;

class ProductBlock extends Widget
{

    private $condition = ['status' => Product::PRODUCT_STATUS_SELLING];

    public function run()
    {

        $query = Product::find()
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
            ->where($this->condition)->asArray();

        $count_products = clone $query;
        $pages = new Pagination(['totalCount' => $count_products->count(), 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('product_block',[
            'products' => $products,
            'pages' => $pages,
        ]);
    }

    /**
     * @param $params array
     */
    public function setCondition($params)
    {
        $this->condition = $params;
    }
}