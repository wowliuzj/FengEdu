<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "info_student".
 *
 * @property string $is_id
 * @property string $is_name
 * @property string $is_hometown
 * @property string $is_sex
 * @property string $is_birthday
 * @property string $is_province
 * @property string $is_city
 * @property string $is_county
 * @property string $is_zone
 * @property string $is_address
 * @property string $is_id_card
 * @property string $is_politics
 * @property string $campus_id
 * @property string $ico_id
 * @property string $id_id
 * @property string $icl_id
 * @property string $is_email
 * @property string $is_tel
 * @property string $is_room
 * @property string $is_room_number
 * @property string $is_study_date
 * @property string $is_grade
 * @property integer $is_status
 *
 * @property InfoCampus $icName
 * @property InfoCollege $ico
 * @property InfoDiscipline $id
 * @property InfoClass $icl
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_birthday', 'is_study_date'], 'safe'],
            [['is_grade', 'is_status','is_age','campus_id'], 'integer'],
            [['is_id', 'is_politics', 'is_room_number'], 'string', 'max' => 10],
            [['is_name', 'is_hometown', 'is_city', 'is_county', 'is_zone', 'ico_id', 'id_id', 'icl_id', 'is_tel','parent_name','parent_phone'], 'string', 'max' => 20],
            [['is_sex'], 'string', 'max' => 2],
            [['is_province'], 'string', 'max' => 50],
            [['is_address'], 'string', 'max' => 100],
            [['is_id_card'], 'string', 'max' => 18],
            [['is_email', 'is_room'], 'string', 'max' => 128]
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
            'is_age'=>'is age',
            'is_hometown' => 'Is Hometown',
            'is_sex' => 'Is Sex',
            'is_birthday' => 'Is Birthday',
            'is_province' => 'Is Province',
            'is_city' => 'Is City',
            'is_county' => 'Is County',
            'is_zone' => 'Is Zone',
            'is_address' => 'Is Address',
            'is_id_card' => 'Is Id Card',
            'is_politics' => 'Is Politics',
            'campus_id' => 'Ic Name',
            'ico_id' => 'Ico ID',
            'id_id' => 'Id ID',
            'icl_id' => 'Icl ID',
            'is_email' => 'Is Email',
            'is_tel' => 'Is Tel',
            'is_room' => 'Is Room',
            'is_room_number' => 'Is Room Number',
            'is_study_date' => 'Is Study Date',
            'is_grade' => 'Is Grade',
            'is_status' => 'Is Status',
            'parent_name'=>'parent name',
            'parent_phone'=>'parent phone'
        ];
    }


    public function hasIdCard()
    {
        $list = Yii::$app->db->createCommand("select is_id from info_student where is_id_card=:idCard",[':idCard'=>$this->is_id_card])->queryAll();
        if(count($list) > 0){
            return true;
        }else{
            return false;
        }
    }
}
