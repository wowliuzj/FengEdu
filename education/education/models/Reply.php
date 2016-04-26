<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "reply".
 *
 * @property integer $id
 * @property integer $tid
 * @property integer $floor
 * @property integer $sid
 * @property string $name
 * @property string $content
 * @property string $time
 */
class Reply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tid', 'floor', 'sid'], 'integer'],
            [['time'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['content'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tid' => 'Tid',
            'floor' => 'Floor',
            'sid' => 'Sid',
            'name' => 'Name',
            'content' => 'Content',
            'time' => 'Time',
        ];
    }
}
