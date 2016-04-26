<?php

namespace app\education;
use Yii;
class EducationFilter extends \yii\base\ActionFilter
{
	public $rules = [];
	public function beforeAction($action)
    {
    	$page = Yii::$app->request->get("page");
    	if($page === 'login'){
        	return true;
    	}
        $r = Yii::$app->request->get("r");
        if($r === '/education/admin/login'){
            return true;
        }
        //$this->_startTime = microtime(true);
         $session = Yii::$app->session;
        if ($session['USER_SESSION'] == null) {
            Yii::$app->response->redirect(constant('baseURI').'&page=login');
            return false;
        }else{
          // 检查用户的访问权限
        }
      	
        //echo Yii::$app->basePath;//D:\work\wamp\apps\basic
        //echo Yii::$app->homeUrl;// /yii/index.php
        //echo Yii::$app->request->hostInfo;// http://localhost
        //echo Yii::$app->request->baseUrl;// /yii
        //echo '<script> document.location.href="/basic/web/app"</script>';
        //  $event->isValid = false;
        //  $event->result="error";
        //  Yii::$app->response->redirect(Yii::$app->request->baseUrl.'/login.html');
        return true;
    }
}
