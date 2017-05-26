<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "option".
 *
 * @property integer $id
 * @property string $title
 * @property string $option1
 * @property string $option2
 * @property string $option3
 * @property string $option4
 * @property string $option5
 * @property integer $school_id
 * @property integer $user_id
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'user_id'], 'integer'],
            [['title', 'option1', 'option2', 'option3', 'option4', 'option5'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'option1' => 'Option1',
            'option2' => 'Option2',
            'option3' => 'Option3',
            'option4' => 'Option4',
            'option5' => 'Option5',
            'school_id' => 'School ID',
            'user_id' => 'User ID',
        ];
    }
}
