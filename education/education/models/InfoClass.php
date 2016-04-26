<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "info_class".
 *
 * @property string $icl_id
 * @property string $icl_number
 * @property integer $icl_tid
 * @property string $icl_note
 * @property integer $icl_year
 */
class InfoClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icl_tid', 'icl_year','status'], 'integer'],
            [['icl_id'], 'string', 'max' => 20],
            [['icl_number'], 'string', 'max' => 50],
            [['icl_note'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'icl_id' => 'Icl ID',
            'icl_number' => 'Icl Number',
            'icl_tid' => 'Icl Tid',
            'icl_note' => 'Icl Note',
            'icl_year' => 'Icl Year',
        ];
    }
}
