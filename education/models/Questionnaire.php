<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questionnaire".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property integer $option
 * @property integer $teacher_id
 * @property integer $campus_id
 * @property integer $school_id
 * @property integer $category
 * @property string $question
 */
class Questionnaire extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questionnaire';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'option', 'teacher_id', 'campus_id', 'school_id', 'category'], 'integer'],
            [['title', 'question'], 'string', 'max' => 255]
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
            'type' => 'Type',
            'option' => 'Option',
            'teacher_id' => 'Teacher ID',
            'campus_id' => 'Campus ID',
            'school_id' => 'School ID',
            'category' => 'Category',
            'question' => 'Question',
        ];
    }
}
