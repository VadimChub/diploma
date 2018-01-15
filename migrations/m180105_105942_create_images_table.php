<?php

use yii\db\Migration;

/**
 * Handles the creation of table `images`.
 */
class m180105_105942_create_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'image_main' => $this->string()->notNull(),
            'image_side1' => $this->string()->notNull(),
            'image_side2' => $this->string()->notNull(),
            'image_brand' => $this->string()->notNull(),
            'product_id' =>$this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-images-product_id',
            'images',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-images-product_id',
            'images',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-images-product_id',
            'images'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-images-product_id',
            'images'
        );


        $this->dropTable('images');
    }
}
