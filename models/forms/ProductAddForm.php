<?php

namespace app\models\forms;

use app\models\Product;
use Yii;
use yii\base\Model;
use app\models\Category;
use app\models\Brand;


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
        ];
    }

    public function save ()
    {
        if ($this->validate()){

            $product = new Product();

            $product_transaction = Product::getDb()->beginTransaction();
            try {

                $product->title = $this->title;
                $product->short_description = $this->short_description;
                $product->description = $this->description;
                $product->category_id = $this->category;
                $product->brand_id = $this->brand;
                $product->price = $this->price;
                $product->color = $this->color;
                $product->size = $this->size;
                $product->constitution = $this->constitution;
                $product->status = Product::PRODUCT_STATUS_CHECKING;
                $product->created_at = $date = date('Y-m-d H:i:s');
                $product->updated_at = $date;

                if ($product->save()){
                    $product_transaction->commit();
                    return true;
                }
            } catch(\Exception $e) {
                $product_transaction->rollBack();
                throw $e;
            } catch(\Throwable $e) {
                $product_transaction->rollBack();
                throw $e;
            }

        }
        return false;
    }

}