<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $message
 * @property int $sender
 * @property int $receiver
 * @property int $dialog_id
 * @property string $created_at
 * @property string $status
 * @property int $is_deleted_sender
 * @property int $is_deleted_receiver
 *
 * @property Dialogs $dialog
 * @property User $receiver0
 * @property User $sender0
 */
class Messages extends \yii\db\ActiveRecord
{
    const MESSAGE_STATUS_UNREADED = 100;
    const MESSAGE_STATUS_READED = 200;

    const MESSAGE_STATUS_OKAY = 300;
    const MESSAGE_STATUS_DELETED = 400;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'required'],
            ['message', 'string', 'length' => [1]],
            [['sender', 'receiver', 'dialog_id'], 'required'],
            [['sender', 'receiver', 'dialog_id', 'is_deleted_sender', 'is_deleted_receiver', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['dialog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dialogs::className(), 'targetAttribute' => ['dialog_id' => 'id']],
            [['receiver'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver' => 'id']],
            [['sender'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'dialog_id' => 'Dialog ID',
            'created_at' => 'Created At',
            'status' => 'Status',
            'is_deleted_sender' => 'Is Deleted Sender',
            'is_deleted_receiver' => 'Is Deleted Receiver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDialog()
    {
        return $this->hasOne(Dialogs::className(), ['id' => 'dialog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver0()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender0()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    /**
     * @param $dialog_id
     * @return int|string
     */
    public static function getNumberOfUserUnreadMessagesInDialog($dialog_id)
    {
        return self::find()->where(['dialog_id' => $dialog_id, 'status' => self::MESSAGE_STATUS_UNREADED, 'receiver' => Yii::$app->user->identity->getId()])->count();
    }

    /**
     * @param $used_id integer
     * @return int|string
     */
    public static function getNumberOfAllUserUnreadedMessages($used_id)
    {
        return self::find()->where(['status' => self::MESSAGE_STATUS_UNREADED, 'receiver' => Yii::$app->user->identity->getId()])->count();
    }

    /**
     * @param $model Messages
     * @param $dialog_id integer
     */
    public static function saveMessage($model, $dialog_id)
    {
        $model->sender = intval($model->sender);
        $model->receiver = intval($model->receiver);
        $model->dialog_id = $dialog_id;
        $model->created_at = date('Y-m-d H:i:s');
        $model->status = $model::MESSAGE_STATUS_UNREADED;
        $model->is_deleted_sender = $model::MESSAGE_STATUS_OKAY;
        $model->is_deleted_receiver = $model::MESSAGE_STATUS_OKAY;

        if ($model->validate() && $model->save()) {

            $dialog = Dialogs::findOne($dialog_id);
            $dialog->last_message = $model->message;
            $dialog->save();
        }
    }

    /**
     * @param $dialog_id integer
     * @param $receiver integer
     */
    public static function updateUnreadMessageStatus($dialog_id, $receiver)
    {
        self::updateAll(['status' => self::MESSAGE_STATUS_READED],
            ['status' => self::MESSAGE_STATUS_UNREADED, 'receiver' => $receiver, 'dialog_id' => $dialog_id]);
    }
}
