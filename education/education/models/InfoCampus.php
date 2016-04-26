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
class InfoCampus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_campus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ic_name'], 'string', 'max' => 100],
            [['ic_address'], 'string', 'max' => 255],
            [['ic_postcode'], 'string', 'max' => 10],
            [['ic_tel'], 'string', 'max' => 20],
            [['ic_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ic_id' => 'Ic ID',
            'ic_name' => 'Ic Name',
            'ic_address' => 'Ic Address',
            'ic_postcode' => 'Ic Postcode',
            'ic_tel' => 'Ic Tel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoColleges()
    {
        return $this->hasMany(InfoCollege::className(), ['ic_name' => 'ic_name']);
    }
}
