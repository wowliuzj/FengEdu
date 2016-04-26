<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property string $title
 * @property string $cnt
 * @property string $reply_msg
 * @property integer $sid
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid'], 'integer'],
            [['title','cnt', 'reply_msg','time'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'cnt' => 'Cnt',
            'reply_msg' => 'Reply Msg',
            'sid' => 'Sid',
        ];
    }
}
