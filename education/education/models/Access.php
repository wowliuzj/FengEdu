<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "access".
 *
 * @property string $r_id
 * @property string $p_id
 * @property integer $ac_r
 * @property integer $ac_w
 *
 * @property Role $r
 * @property Permission $p
 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r_id', 'p_id'], 'required'],
            [['r_id', 'p_id', 'ac_r', 'ac_w'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r_id' => 'R ID',
            'p_id' => 'P ID',
            'ac_r' => 'Ac R',
            'ac_w' => 'Ac W',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR()
    {
        return $this->hasOne(Role::className(), ['r_id' => 'r_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Permission::className(), ['p_id' => 'p_id']);
    }
}
