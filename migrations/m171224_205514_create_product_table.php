<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m171224_205514_create_product_table extends Migration
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
            'producer' => $this->string(),
            'category' => $this->string(),
            'price' => $this->integer(),
            'size' => $this->string(7),
            'color' => $this->string(20),
            'constitution' => $this->string(),
            'views' => $this->integer()->defaultValue(0)->notNull(),
            'status' => $this->integer(2),
            'date' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
