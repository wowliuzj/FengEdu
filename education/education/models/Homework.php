<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "homework".
 *
 * @property integer $id
 * @property integer $cid
 * @property string $time
 * @property string $img
 * @property string $desc
 * @property string $finish_time
 */
class Homework extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'homework';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid','course_id','num'], 'integer'],
            [['time', 'finish_time','title'], 'safe'],
            [['img'], 'file'],
            [['desc'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'Cid',
            'time' => 'Time',
            'img' => 'Img',
            'desc' => 'Desc',
            'finish_time' => 'Finish Time',
        ];
    }
}
