<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property integer $id
 * @property string $title
 * @property integer $cid
 * @property string $time
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid'], 'integer'],
            [['time'], 'safe'],
            [['title','desc'], 'string', 'max' => 100]
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
            'cid' => 'Cid',
            'time' => 'Time',
        ];
    }
}
