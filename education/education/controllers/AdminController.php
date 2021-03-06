<?php

namespace app\education\controllers;

use Yii;
use app\education\models\Admin;
use app\education\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\education\models\Teacher;
use app\education\models\Student;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'deletes' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->removeAll();
        $session->destroy();
        return $this->redirect('index.php?r=/education&page=login');
    }
    public function actionLogin()
    {
        $request = Yii::$app->request;
        $name = $request->post('user_name', '');
        $password = $request->post('user_pwd','');
        $searchModel = new AdminSearch();
        $info = $searchModel->getAdminByName($name);
        $res = 'ok';
        $stat = 1;
        if(isset($info['a_name']) && $info['a_name'] === $name){
            if(\Tool::salt_hash(\Tool::md5_xx($password), $info['a_salt']) == $info['a_pwd']){
                if($info['a_status'] == 1){
                    $res = "账户被禁用";
                    $stat = 0;
                }
            } else{
                 $res =  "用户名或密码错误";
                 $stat = 0;
            }
        } else{
             $res =  "用户名不存在";
             $stat = 0;
        }
        if($res === 'ok'){
           $rids = $info['r_id'];
            $pinfo = $searchModel->adminInfo($info['fid'],$info['ftype']);
            if($info['ftype'] == 8){
                $pinfo['campus_id'] = $info['campus_id'];
            }
            $session = Yii::$app->session;
            $session['USER_SESSION'] = [
                                            'name'=>$info['a_name'],
                                            'id'=>$info['a_id'],
                                            'fid'=>$info['fid'],
                                            'ftype'=>$info['ftype'],
                                            'viewName' =>$pinfo['name'],
                                            'cid'=>$pinfo['cid'],
                                            'campus_id'=>$pinfo['campus_id'],
                                            'school_id'=>$info['school_id'],
                                        ];
            $session['USER_ROLE_ID'] = $rids;
            $sql = 'SELECT * from permission where p_id in (SELECT p_id from access where r_id in (:rids))';
            $list = Yii::$app->db->createCommand($sql,[':rids' => $rids])->queryAll();
            
            Yii::$app->cache->set('USER_PERMISSION_'.$rids,$list);
        }
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson($stat,$res);
    }

    public function actionWelcomeInfo(){
        $session = Yii::$app->session;
        $info = $session['USER_SESSION'];
        //echo $info['fid'],$info['ftype'];
        //echo "<br/>";

        $welcomeInfo = array();
        $type = $info['ftype'];
        $cid = $info['cid'];
        $welcomeInfo['viewName'] = $info['viewName'];
        $welcomeInfo['type'] = $type;
        $welcomeInfo['cid'] = $cid;
        if($type == 5 or $type == 6){
            $sql = "SELECT count(1) from exam  where cid = $cid and DATE_FORMAT(time,'%Y-%m-%d') >= DATE_FORMAT(now(),'%Y-%m-%d') ";
            $count = Yii::$app->db->createCommand($sql)->queryScalar();  
            $welcomeInfo['count'] = $count;
        }

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$welcomeInfo);
    }

    public function actionResetPwd()
    {
        $id = Yii::$app->request->post('a_id');
        $pwd = Yii::$app->request->post('pwd');
        $salt = \Tool::salt(32);
        $pwd = \Tool::salt_hash(\Tool::md5_xx($pwd), $salt);
        $model = $this->findModel($id);
        $model->a_pwd = $pwd;
        $model->a_salt = $salt;
        $model->update();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,"ok");
    }

    public function actionModPwd()
    {
        $session = Yii::$app->session;
        $name = $session['USER_SESSION']['name'];

        $request = Yii::$app->request;
        $oldPwd = $request->post('oldPwd', '');
        $newPwd = $request->post('newPwd','');

        $searchModel = new AdminSearch();
        $info = $searchModel->getAdminByName($name);
        $res = 'ok';
        $s = 1;
        if(isset($info['a_name']) && $info['a_name'] === $name){
            if(\Tool::salt_hash(\Tool::md5_xx($oldPwd), $info['a_salt']) == $info['a_pwd']){
                $salt = \Tool::salt(32);
                $pwd = \Tool::salt_hash(\Tool::md5_xx($newPwd), $salt);
                $info->a_pwd = $pwd;
                $info->a_salt = $salt;
                $res = $info->update();
            }else{
                $res = "原密码错误";
                $s = 0;
            }
        }else{
            $res = "用户信息有误";
            $s = 0;
        }
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson($s,$res);
    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->searchBySql(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        $totalCount = $dataProvider->getTotalCount();
       
        $pageSize = $dataProvider->getPagination()->getPageSize();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }

    /**
     * Displays a single Admin model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        //$response->data = \Tool::toResJson(1,$this->findModel($id));
    }


    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->a_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('a_id');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->a_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeletes()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $idArray = $request->post();
        $ids = array();
        foreach($idArray as $k=>$v){
            $index = strrpos($k,'did');
            if($index === false){
                continue;
            }
            array_push($ids,$v);
        }
        $strIds = implode(",", $ids);
        if($strIds == ''){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
            return;
        }

        $transaction = NULL;
        try
        {
            $transaction = Yii::$app->db->beginTransaction();
            foreach($ids as $row)
            {
                $model = $this->findModel($row);
                if(empty($model)) continue;
                switch($model->ftype)
                {
                    case 3:
                    case 4:
                        $teacher = Teacher::findOne($model->fid);
                        if(!empty($teacher)) $teacher->delete();
                        break;
                    case 5:
                        $student = Student::findOne($model->fid);
                        $student->parent_name = null;
                        $student->parent_phone = null;
                        $student->save();
                        break;
                    case 6:
                        $student = Student::findOne($model->fid);
                        if(!empty($student)) $student->delete();
                        break;
                    default:
                        break;
                }
                $model->delete();
            }
            $transaction->commit();
            $response->data = \Tool::toResJson(1, "删除成功");
        }
        catch(Exception $ex)
        {
            if(isset($transaction)) $transaction->rollback();
            $response->data = \Tool::toResJson(0, "删除失败");
        }
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
  
}
