<?php

namespace app\education\models;

use Yii;

/**
 * This is the model class for table "stu_work".
 *
 * @property integer $id
 * @property integer $stu_work_id
 * @property integer $upload_time
 * @property integer $file
 */
class StuWorkUpload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stu_work_upload';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stu_work_id', 'img_file'], 'integer'],
            [['upload_time'], 'string'],
            [['file'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stu_work_id' => 'Sid',
            'file' => 'Upload File',
            'img_file' => 'Image File',
            'upload_time' => 'Uploaded time',
        ];
    }
}
