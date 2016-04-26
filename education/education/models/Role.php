<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property string $r_id
 * @property string $r_name
 * @property integer $r_status
 *
 * @property Access[] $accesses
 * @property Permission[] $ps
 * @property Admin[] $admins
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r_name'], 'required'],
            [['r_status'], 'integer'],
            [['r_name'], 'string', 'max' => 20],
            [['r_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r_id' => 'R ID',
            'r_name' => 'R Name',
            'r_status' => 'R Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesses()
    {
        return $this->hasMany(Access::className(), ['r_id' => 'r_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPs()
    {
        return $this->hasMany(Permission::className(), ['p_id' => 'p_id'])->viaTable('access', ['r_id' => 'r_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['r_id' => 'r_id']);
    }
}
