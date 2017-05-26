<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $question_id
 * @property integer $user_id
 * @property integer $option_id
 * @property integer $question_style
 * @property integer $status
 * @property string $replay
 * @property integer $user_name
 *
 * @property Role $r
 * @property Permission $p
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'category_id', 'question_id'], 'required'],
            [['user_id', 'category_id', 'question_id', 'user_id','question_style'], 'integer'],
            [['replay'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
   /* public function attributeLabels()
    {
        return [
            'r_id' => 'R ID',
            'p_id' => 'P ID',
            'ac_r' => 'Ac R',
            'ac_w' => 'Ac W',
        ];
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
   /* public function getR()
    {
        return $this->hasOne(Role::className(), ['r_id' => 'r_id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getP()
    {
        return $this->hasOne(Permission::className(), ['p_id' => 'p_id']);
    }*/
}
