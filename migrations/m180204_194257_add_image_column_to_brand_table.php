<?php

use yii\db\Migration;

/**
 * Handles adding image to table `brand`.
 */
class m180204_194257_add_image_column_to_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('brand', 'image', $this->string(255)->after('name'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('brand', 'image');
    }
}
