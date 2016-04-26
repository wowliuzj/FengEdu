<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "outline".
 *
 * @property string $id
 * @property string $title
 * @property integer $cid
 * @property integer $tid
 */
class Outline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'tid'], 'integer'],
            [['title','time'], 'string']
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
            'tid' => 'Tid',
        ];
    }
}
