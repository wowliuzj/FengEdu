<?php

namespace app\education\controllers;

use Yii;
use app\education\models\Student;
use app\education\models\StudentSearch;
use app\education\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        // 获取分页和排序数据
        $models = $dataProvider->getModels();

        // 在当前页获取数据项的数目
        $pageSize = $dataProvider->getPagination()->getPageSize();

        // 获取所有页面的数据项的总数
        $totalCount = $dataProvider->getTotalCount();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
    }

    public function actionStuExam()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->searchByExam(Yii::$app->request->queryParams);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        // 获取分页和排序数据
        $models = $dataProvider->getModels();

        // 在当前页获取数据项的数目
        $pageSize = $dataProvider->getPagination()->getPageSize();

        // 获取所有页面的数据项的总数
        $totalCount = $dataProvider->getTotalCount();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
    }
    /**
     * Displays a single Student model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$this->findModel($id));
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Displays a single StuWork model.
     * @param integer $id
     * @return mixed
     */
    public function actionTname()
    {
        $session = Yii::$app->session;
        $cid = $session['USER_SESSION']['cid'];
        $sql = "SELECT it_name from info_teacher,info_class where icl_tid = it_id and icl_id = $cid";
        $model = Yii::$app->db->createCommand($sql)->queryOne();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$model['it_name']);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $model = new Student();
        $model->load(Yii::$app->request->post(),"");

        if($model->icl_id=='0'){
            $response->data = \Tool::toResJson(0, "选择班级");
            return;
        }

        $session = Yii::$app->session;
        $model->campus_id = $session['USER_SESSION']['campus_id'];
        $school_id= $session['USER_SESSION']['school_id'];
        $admin = new AdminSearch();
        $tf = $admin->hasPhone($model->is_tel);
        if($tf){
            $response->data = \Tool::toResJson(0, "该手机号已经注册过了，请换一个其他的手机号");
            return;
        }
        
        $tf = $model->hasIdCard();
        if($tf){
            $response->data = \Tool::toResJson(0, "该学生的身份证号码已经存在");
            return;
        }
        if ($model->save()) {
            $admin->a_name = $model->is_tel;
            $admin->a_ip = $_SERVER["REMOTE_ADDR"];
            $admin->r_id = '6';
            $admin->fid = $model->is_id;
            $admin->ftype = 6;
            $admin->campus_id = $model->campus_id;
            $admin->school_id = $school_id;
            $admin->create();
            $response->data = \Tool::toResJson(1, ['is_id'=>$model->is_id]);


            $padmin = new AdminSearch();
            $tf = $padmin->hasPhone($model->parent_phone);
            if(!$tf){
                $padmin->a_name = $model->parent_phone;
                $padmin->a_ip = $_SERVER["REMOTE_ADDR"];
                $padmin->r_id = '5';
                $padmin->ftype = 5;
                $padmin->fid = $model->is_id;
                $padmin->campus_id = $model->campus_id;
                $padmin->school_id = $school_id;
                $padmin->create();
            }
        } else {
            $response->data = \Tool::toResJson(0, "添加失败");
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('is_id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
           // return $this->redirect(['view', 'id' => $model->is_id]);
            $response->data = \Tool::toResJson(1, $model->is_id);
        } else {
           $response->data = \Tool::toResJson(0, "修改失败");
            // return $this->render('update', [
            //     'model' => $model,
            // ]);
        }
    }

    public function actionModStatus()
    {
        $request = Yii::$app->request;
        $idArray = array();
        $len = 120;
        for($k=0;$k < $len ;$k++) {
            $id = $request->post("mis_id$k", '');
            if($id == ''){
                break;
            }
            $status = $request->post("status$k", '');
            if(isset($idArray[$status])){
                array_push($idArray[$status],$id);
            }else{
                $ids = array();
                array_push($ids,$id);
                $idArray[$status] = $ids;
            }
        }
        foreach($idArray as $stat=>$v){
            $ids = implode(",",$v);
            $sql = "update info_student set is_status=".$stat." where is_id in(".$ids.")";
            $res = Yii::$app->db->createCommand($sql)->execute();
        }
       
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1, "修改成功");
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $tmp = $this->findModel($id);
        if($tmp == null){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $tmp->delete();
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    public function actionDeletes()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $idArray = $request->get();
        $ids = array();
        foreach($idArray as $k=>$v){
            $index = strrpos($k,'dis_id');
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
       
        $sql = "delete from ".Student::tableName()." where is_id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return $model = Student::findOne($id);
       // if (($model = Student::findOne($id)) !== null) {
       //     return $model;
       // } else {
      //      throw new NotFoundHttpException('The requested page does not exist.');
       // }
    }
}
