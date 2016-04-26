<?php

namespace app\education\controllers;

use Yii;
use app\education\models\StuWork;
use app\education\models\StuWorkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StuWorkController implements the CRUD actions for StuWork model.
 */
class StuWorkController extends Controller
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
     * Lists all StuWork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StuWorkSearch();
        $dataProvider = $searchModel->searchBySql(Yii::$app->request->queryParams);

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

    public function actionQuery()
    {
        $searchModel = new StuWorkSearch();
        $dataProvider = $searchModel->searchByQuery(Yii::$app->request->queryParams);

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

    public function actionWall()
    {
        $searchModel = new StuWorkSearch();
        $dataProvider = $searchModel->searchByWall();

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

    /**
     * Displays a single StuWork model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $sql = "SELECT c.it_name,b.title,b.time,b.img,b.`desc`,a.stime,sdesc,simg,a.ttime,score,tdesc from stu_work as a,homework as b,info_teacher as c where a.hid = b.id and b.tid = c.it_id and  a.id = $id";
	    $model = Yii::$app->db->createCommand($sql)->queryOne();
    	$response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$model);
    }

    /**
     * Creates a new StuWork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $sid = $session['USER_SESSION']['fid'];
        $cid = $session['USER_SESSION']['cid'];
        $hid = Yii::$app->request->get("hid");

        $sql = "SELECT id from stu_work where sid=$sid and hid=$hid";
        $info = Yii::$app->db->createCommand($sql)->queryOne();
        if($info != null){
            $response->data = \Tool::toResJson(1, $model->id);
            return;
        }

        $model = new StuWork();
        
        $model->sid = $sid;
        $model->cid = $cid;
        $model->hid = $hid;
        $model->score = -1;

        if ($model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
			$response->data = \Tool::toResJson(1, $model->id);
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "添加失败");
        }
    }
    /**
     * Updates an existing StuWork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_HTML;
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $model->stime = date("Y-m-d H:i:s");
        if(!empty($_FILES['simg']['tmp_name'])){
             $model->simg = \Tool::saveFile('simg');
        }

        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
			$response->content = json_encode(\Tool::toResJson(1, $model->id));
        } else {
            //return $this->render('update', [
            //    'model' => $model,
            //]);
			$response->content = json_encode(\Tool::toResJson(0, "修改失败"));
        }
    }

    public function actionTeaEval()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $model->ttime = date("Y-m-d H:i:s");
        
        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $response->data = \Tool::toResJson(1, $model->id);
        } else {
            //return $this->render('update', [
            //    'model' => $model,
            //]);
            $response->data = \Tool::toResJson(0, "修改失败");
        }
    }
    /**
     * Deletes an existing StuWork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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

    public function actionDeletes($ids)
    {
        /**
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "delete from ".StuWork::tableName()." where id in(".$ids.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
        */
        $request = Yii::$app->request;
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
        $sql = "delete from ".StuWork::tableName()." where id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the StuWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StuWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return StuWork::findOne($id);
    }
}
