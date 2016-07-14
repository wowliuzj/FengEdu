<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property string $a_id
 * @property string $a_name
 * @property string $a_pwd
 * @property string $a_salt
 * @property string $r_id
 * @property string $a_ip
 * @property integer $a_status
 *
 * @property Role $r
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_status','campus_id','school_id'], 'integer'],
            [['a_name'], 'string', 'max' => 20],
            [['a_pwd'], 'string', 'max' => 64],
            [['a_salt'], 'string', 'max' => 32],
            [['a_ip'], 'string', 'max' => 255],
            [['r_id'], 'string', 'max' => 255],
            [['a_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'a_id' => 'A ID',
            'a_name' => 'A Name',
            'a_pwd' => 'A Pwd',
            'a_salt' => 'A Salt',
            'r_id' => 'R ID',
            'a_ip' => 'A Ip',
            'a_status' => 'A Status',
            'school_id'=>'School ID'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR()
    {
        return $this->hasOne(Role::className(), ['r_id' => 'r_id']);
    }

    public function create()
    {
        $phone = substr($this->a_name,-6);
        $salt = \Tool::salt(32);
        $pwd = \Tool::salt_hash(\Tool::md5_xx($phone), $salt);

        $this->a_pwd = $pwd;
        $this->a_salt = $salt;
        $this->a_status = 0;
        $this->save();
    }
}
