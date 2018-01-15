<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dialogs`.
 */
class m180107_202039_create_dialogs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dialogs', [
            'id' => $this->primaryKey(),
            'last_message' => $this->text(),
            'first_user_id' => $this->integer(),
            'second_user_id' => $this->integer(),
            'status' => $this->integer()->notNull()->defaultValue(0),
        ]);

        // creates index for column `first_user_id`
        $this->createIndex(
            'idx-dialogs-first_user_id',
            'dialogs',
            'first_user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-dialogs-first_user_id',
            'dialogs',
            'first_user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `second_user_id`
        $this->createIndex(
            'idx-dialogs-second_user_id',
            'dialogs',
            'second_user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-dialogs-second_user_id',
            'dialogs',
            'second_user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `dialogs`
        $this->dropForeignKey(
            'fk-dialogs-first_user_id',
            'dialogs'
        );

        // drops index for column `first_user_id`
        $this->dropIndex(
            'idx-dialogs-first_user_id',
            'dialogs'
        );

        // drops foreign key for table `dialogs`
        $this->dropForeignKey(
            'fk-dialogs-second_user_id',
            'dialogs'
        );

        // drops index for column `second_user_id`
        $this->dropIndex(
            'idx-dialogs-second_user_id',
            'dialogs'
        );

        $this->dropTable('dialogs');
    }
}
