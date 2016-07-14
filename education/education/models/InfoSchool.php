<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "info_campus".
 *
 * @property integer $ic_id
 * @property string $ic_name
 * @property string $ic_address
 * @property string $ic_postcode
 * @property string $ic_tel
 *
 * @property InfoCollege[] $infoColleges
 */
class InfoSchool extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_name'], 'string', 'max' => 200],
            [['is_address'], 'string', 'max' => 200],
            [['is_postcode'], 'string', 'max' => 10],
            [['is_tel'], 'string', 'max' => 20],
            [['is_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'is_id' => 'Is ID',
            'is_name' => 'Is Name',
            'is_address' => 'Is Address',
            'is_postcode' => 'Is Postcode',
            'is_tel' => 'Is Tel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getInfoColleges()
//    {
//        return $this->hasMany(InfoCollege::className(), ['is_name' => 'is_name']);
//    }
}
