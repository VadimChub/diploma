<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m171229_220739_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'short_description' => $this->string(255),
            'description' => $this->text(),
            'category_id' => $this->integer()->notNull(),
            'brand_id' =>$this->integer()->notNull(),
            'price' => $this->integer(),
            'size' => $this->string(7),
            'color' => $this->string(20),
            'constitution' => $this->string(),
            'views' => $this->integer()->defaultValue(0)->notNull(),
            'status' => $this->integer(2),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `brand_id`
        $this->createIndex(
            'idx-product-brand_id',
            'product',
            'brand_id'
        );

        // add foreign key for table `brand`
        $this->addForeignKey(
            'fk-product-brand_id',
            'product',
            'brand_id',
            'brand',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-product-category_id',
            'product'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-product-category_id',
            'product'
        );

        // drops foreign key for table `brand`
        $this->dropForeignKey(
            'fk-product-brand_id',
            'product'
        );

        // drops index for column `brand_id`
        $this->dropIndex(
            'idx-product-brand_id',
            'product'
        );

        $this->dropTable('product');
    }
}
