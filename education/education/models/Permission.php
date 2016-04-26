<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "permission".
 *
 * @property string $p_id
 * @property string $p_name
 * @property string $p_alias
 * @property integer $p_status
 *
 * @property Access[] $accesses
 * @property Role[] $rs
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_name', 'p_alias'], 'required'],
            [['p_status'], 'integer'],
            [['p_name'], 'string', 'max' => 20],
            [['p_alias'], 'string', 'max' => 64],
            [['p_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'p_name' => 'P Name',
            'p_alias' => 'P Alias',
            'p_status' => 'P Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesses()
    {
        return $this->hasMany(Access::className(), ['p_id' => 'p_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRs()
    {
        return $this->hasMany(Role::className(), ['r_id' => 'r_id'])->viaTable('access', ['p_id' => 'p_id']);
    }
}
