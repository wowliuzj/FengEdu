<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property string $id
 * @property string $year
 * @property string $name
 * @property string $cnt
 * @property integer $num
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year'], 'required'],
            [['year', 'num'], 'integer'],
            [['name', 'cnt'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'name' => 'Name',
            'cnt' => 'Cnt',
            'num' => 'Num',
        ];
    }
}
