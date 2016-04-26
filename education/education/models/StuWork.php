<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "stu_work".
 *
 * @property integer $id
 * @property integer $cid
 * @property integer $sid
 * @property integer $hid
 * @property string $img
 * @property string $sdesc
 * @property integer $score
 */
class StuWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stu_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'sid', 'hid', 'score'], 'integer'],
            [['sdesc','stime','tdesc','ttime'], 'string'],
            [['simg'], 'file'],
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
            'sid' => 'Sid',
            'hid' => 'Hid',
            'simg' => 's Img',
            'sdesc' => 'Sdesc',
            'stime' => 's time',
            'tdesc' => 'Tdesc',
            'ttime' =>'t time',
            'score' => 'Score',
        ];
    }
}
