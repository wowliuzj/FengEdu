<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "question_title".
 *
 * @property integer $id
 * @property string $title
 * @property integer $questionnaire_id
 */
class QuestionTitle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_title';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'questionnaire_id'], 'integer'],
            [['title'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Name',
            'questionnaire_id' => 'questionnaire_id',
        ];
    }
}
