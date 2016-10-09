<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "info_teacher".
 *
 * @property string $it_id
 * @property string $it_name
 * @property string $it_start_date
 * @property string $it_sex
 * @property string $it_birthday
 * @property string $it_marry
 * @property string $it_tel
 * @property string $it_address
 * @property string $it_email
 * @property string $it_note
 * @property string $it_id_card
 * @property string $it_password
 * @property string $it_edu
 * @property integer $campus_id
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_start_date', 'it_birthday','it_type','campus_id'], 'safe'],
            [['it_name', 'it_tel', 'it_edu'], 'string', 'max' => 20],
            [['it_sex'], 'string', 'max' => 2],
            [['it_marry', 'it_address', 'it_note'], 'string', 'max' => 255],
            [['it_email'], 'string', 'max' => 128],
            [['it_id_card'], 'string', 'max' => 18]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'it_id' => 'It ID',
            'it_name' => 'It Name',
            'it_start_date' => 'It Start Date',
            'it_sex' => 'It Sex',
            'it_birthday' => 'It Birthday',
            'it_marry' => 'It Marry',
            'it_tel' => 'It Tel',
            'it_address' => 'It Address',
            'it_email' => 'It Email',
            'it_note' => 'It Note',
            'it_id_card' => 'It Id Card',
            'it_password' => 'It Password',
            'it_edu' => 'It Edu',
            'campus_id' => 'Campus ID',
        ];
    }
}
