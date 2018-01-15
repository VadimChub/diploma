<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dialogs".
 *
 * @property int $id
 * @property string $last_message
 * @property int $first_user_id
 * @property int $second_user_id
 * @property int $status
 *
 * @property User $firstUser
 * @property User $secondUser
 * @property Messages[] $messages
 */
class Dialogs extends \yii\db\ActiveRecord
{
    const DIALOG_STATUS_OKAY = 100;
    const DIALOG_STATUS_DELETED_BY_FIRST_USER = 200;
    const DIALOG_STATUS_DELETED_BY_SECOND_USER = 300;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dialogs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_message'], 'string'],
            [['first_user_id', 'second_user_id', 'status'], 'integer'],
            [['first_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['first_user_id' => 'id']],
            [['second_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['second_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_message' => 'Last Message',
            'first_user_id' => 'First User ID',
            'second_user_id' => 'Second User ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstUser()
    {
        return $this->hasOne(User::className(), ['id' => 'first_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondUser()
    {
        return $this->hasOne(User::className(), ['id' => 'second_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['dialog_id' => 'id']);
    }

    /**
     * @param $user_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getDialogsByUserId($user_id)
    {
        return self::find()->where(['first_user_id' => $user_id, 'status' => self::DIALOG_STATUS_OKAY])
            ->orWhere(['first_user_id' => $user_id, 'status' => self::DIALOG_STATUS_DELETED_BY_SECOND_USER])
            ->orWhere(['second_user_id' => $user_id, 'status' => self::DIALOG_STATUS_OKAY])
            ->orWhere(['second_user_id' => $user_id, 'status' => self::DIALOG_STATUS_DELETED_BY_FIRST_USER])->asArray()->all();
    }

}
