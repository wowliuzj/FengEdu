<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "attent".
 *
 * @property integer $id
 * @property integer $cid
 * @property integer $sid
 * @property string $time
 * @property integer $status
 */
class Attent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'sid', 'status'], 'integer'],
            [['time'], 'safe']
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
            'time' => 'Time',
            'status' => 'Status',
        ];
    }
}
