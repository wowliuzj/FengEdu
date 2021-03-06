<?php

namespace app\education\controllers;

use Yii;
use app\education\models\Teacher;
use app\education\models\TeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\education\models\AdminSearch;
/**
 * TeacherController implements the CRUD actions for Teacher model.
 */
class TeacherController extends Controller
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = !Yii::$app->request->queryParams['cid'] ? $searchModel->search(Yii::$app->request->queryParams) : $searchModel->searchBySql(Yii::$app->request->queryParams);

        //return $this->render('index', [
        //    'searchModel' => $searchModel,
        //    'dataProvider' => $dataProvider,
        //]);
        // 获取分页和排序数据
        $models = $dataProvider->getModels();

        // 在当前页获取数据项的数目
        $pageSize = $dataProvider->getPagination()->getPageSize();

        // 获取所有页面的数据项的总数
        $totalCount = $dataProvider->getTotalCount();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }

    public function actionList()
    {
        $session = Yii::$app->session;
        $ftype = $session['USER_SESSION']['ftype'];
        $campus_id = $session['USER_SESSION']['campus_id'];

        $sql = 'SELECT it_id,it_name from info_teacher where 1=1 ';

        /*if($ftype == 8 or $ftype == 3 or $ftype == 4){
            $sql = $sql . " and campus_id=$campus_id";
        }else{*/
            $params = Yii::$app->request->queryParams;

            if(isset($params['campus_id'])){
                $campus_id = $params['campus_id'];
                if($campus_id==0){
                    $sql = $sql." and campus_id=-1";
                }
                else{
                    $sql = $sql." and campus_id=$campus_id";
                }
            }
            else{
                $sql = $sql." and campus_id=-1";
            }
       /* }*/
        $list = Yii::$app->db->createCommand($sql)->queryAll();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,$list);
    }

    /**
     * Displays a single Teacher model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
		$response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$this->findModel($id));
		
        //return $this->render('view', [
        //    'model' => $this->findModel($id),
        //]);
    }

    /**
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Teacher();
        $model->load(Yii::$app->request->post(),"");
        
        $session = Yii::$app->session;
        $model->campus_id = $session['USER_SESSION']['campus_id'];

        $admin = new AdminSearch();
        $tf = $admin->hasPhone($model->it_tel);
        if($tf){
            $response->data = \Tool::toResJson(0, "该手机号已经注册过了，请换一个其他的手机号");
            return;
        }
        if ($model->save()) {
            $school_id=$session['USER_SESSION']['school_id'];
            $campus_id=$session['USER_SESSION']['campus_id'];
             $admin->a_name = $model->it_tel;
            $admin->a_ip = $_SERVER["REMOTE_ADDR"];
            $admin->r_id = $model->it_type;
            $admin->fid = $model->it_id;
            $admin->ftype = $model->it_type;
            $admin->campus_id = $campus_id;
            $admin->school_id = $school_id;
            $admin->create();
            //return $this->redirect(['view', 'id' => $model->it_id]);
			$response->data = \Tool::toResJson(1, $model->it_id);
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "添加失败");
        }
    }
    /**
     * Updates an existing Teacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('it_id');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->it_id]);
			$response->data = \Tool::toResJson(1, $model->it_id);
        } else {
            //return $this->render('update', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "修改失败");
        }
    }

    /**
     * Deletes an existing Teacher model.
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
        /**
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "delete from ".Teacher::tableName()." where it_id in(".$ids.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
        */
      /*  $request = Yii::$app->request;
        $idArray = $request->get();
        $ids = array();
        foreach($idArray as $k=>$v){
            if($k=='r'){
                continue;
            }
            array_push($ids,$v);
        }
        $strIds = implode(",", $ids);
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "delete from ".Teacher::tableName()." where it_id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }*/
        $request = Yii::$app->request;
        $idArray = $request->get();
        $ids = array();
        foreach($idArray as $k=>$v){
            $index = strrpos($k,'dicl_id');
            if($index === false){
                continue;
            }
            array_push($ids,$v);
        }
        $strIds = implode(",", $ids);
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $transaction = NULL;
        try
        {
            /* $sql = "delete from " . Exam::tableName() . " where id in(" . $strIds . ")";
             Yii::$app->db->createCommand($sql)->execute();*/
            $sql = "delete from " . Teacher::tableName() . " where it_id in(" . $strIds . ")";
            $res = Yii::$app->db->createCommand($sql)->execute();
            /*$sql = "delete from " . Homework::tableName() . " where id in(" . $strIds . ")";
            $res = Yii::$app->db->createCommand($sql)->execute();
            var_dump($sql);die();*/
            if($res == 0)
            {
                $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
            }
            else
            {
                $response->data = \Tool::toResJson(1, "删除成功");
            }
        }
        catch(Exception $ex)
        {
            if(isset($transaction)) $transaction->rollback();
            $response->data = \Tool::toResJson(0, "删除失败");
        }
    }

    /**
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return Teacher::findOne($id);
    }
}
