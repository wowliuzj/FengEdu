<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property integer $id
 * @property integer $sid
 * @property string $title
 * @property string $desc
 * @property string $time
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid'], 'integer'],
            [['desc','name'], 'string'],
            [['time'], 'safe'],
            [['title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sid' => 'Sid',
            'title' => 'Title',
            'desc' => 'Desc',
            'time' => 'Time',
        ];
    }
}
