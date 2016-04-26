<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "eval_work".
 *
 * @property integer $id
 * @property integer $shid
 * @property integer $star
 * @property string $desc
 */
class EvalWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eval_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hid', 'sid','shid'], 'integer'],
            [['desc','time','sname','star'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hid' => 'Hid',
            'shid' => 'Shid',
            'star' => 'Star',
            'desc' => 'Desc',
        ];
    }
}
