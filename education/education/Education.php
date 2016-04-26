<?php

namespace app\education;

class Education extends \yii\base\Module
{
    public $controllerNamespace = 'app\education\controllers';

	public function behaviors()
	{
	    return [
	        'access' => [
	            'class' => EducationFilter::className(),
	            'only' => [],
	            'rules' => [
	                // 允许认证用户
	                [
	                    'allow' => true,
	                    'roles' => ['@'],
	                ],
	                // 默认禁止其他用户
	            ],
	        ],
	    ];
	}
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
