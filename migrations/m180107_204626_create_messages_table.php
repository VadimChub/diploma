<?php

use yii\db\Migration;

/**
 * Handles the creation of table `messages`.
 */
class m180107_204626_create_messages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('messages', [
            'id' => $this->primaryKey(),
            'message' => $this->text(),
            'sender' => $this->integer()->notNull(),
            'receiver' => $this->integer()->notNull(),
            'dialog_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'status' => $this->string(),
            'is_deleted_sender' => $this->integer()->defaultValue(0),
            'is_deleted_receiver' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `sender`
        $this->createIndex(
            'idx-messages-sender',
            'messages',
            'sender'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-sender',
            'messages',
            'sender',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `receiver`
        $this->createIndex(
            'idx-messages-receiver',
            'messages',
            'receiver'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-receiver',
            'messages',
            'receiver',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `receiver`
        $this->createIndex(
            'idx-messages-dialog_id',
            'messages',
            'dialog_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-dialog_id',
            'messages',
            'dialog_id',
            'dialogs',
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
            'fk-messages-dialog_id',
            'messages'
        );

        // drops index for column `dialog_id`
        $this->dropIndex(
            'idx-messages-dialog_id',
            'messages'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-messages-receiver',
            'messages'
        );

        // drops index for column `receiver`
        $this->dropIndex(
            'idx-messages-receiver',
            'messages'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-messages-sender',
            'messages'
        );

        // drops index for column `sender`
        $this->dropIndex(
            'idx-messages-sender',
            'messages'
        );


        $this->dropTable('messages');
    }
}
