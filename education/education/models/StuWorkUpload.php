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
 * @property string $file_ext
 * @property string $path
 * @property string $thumb_img
 * @property integer $img_width
 * @property integer $img_height
 * @property integer $thumb_width
 * @property integer $thumb_height
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
            [['id', 'stu_work_id', 'img_file', 'img_width', 'img_height', 'thumb_width', 'thumb_height'], 'integer'],
            [['thumb_img', 'path', 'file_ext', 'upload_time'], 'string'],
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
