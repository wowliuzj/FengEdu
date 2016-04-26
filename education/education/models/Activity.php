<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $id
 * @property string $name
 * @property string $time
 * @property string $desc
 * @property integer $cid
 * @property string $img
 * @property string $shared_cnt
 * @property integer $is_shared
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'is_shared','type'], 'integer'],
            [['name','time','desc', 'shared_cnt'], 'string'],
            [['img'], 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'time' => 'Time',
            'desc' => 'Desc',
            'cid' => 'Cid',
            'img' => 'Img',
            'shared_cnt' => 'Shared Cnt',
            'is_shared' => 'Is Shared',
        ];
    }
}
