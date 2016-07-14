<?php

namespace app\education\controllers;

use Yii;
use app\education\models\Homework;
use app\education\models\HomeworkSearch;
use app\education\models\StuWork;
use app\education\models\StuWorkUpload;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HomeworkController implements the CRUD actions for Homework model.
 */
class HomeworkController extends Controller
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
     * Lists all Homework models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HomeworkSearch();
        $params = Yii::$app->request->queryParams;
        $params['status'] = 0;

        $session = Yii::$app->session;
        $params['fid'] = $session['USER_SESSION']['fid'];
        $params['ftype'] = $session['USER_SESSION']['ftype'];
        $dataProvider = $searchModel->searchBySql($params);

        //return $this->render('index', [
        //    'searchModel' => $searchModel,
        //    'dataProvider' => $dataProvider,
        //]);
        // 获取分页和排序数据
        $models = $dataProvider->getModels();
        //echo count($models);
        for($i = 0 ;$i < count($models);$i++){
            //status（1新作业，2尚未完成，3待评分，4已完成）
            $v = $models[$i];
            if($v['sid'] == null){
                $models[$i]['status'] = 1;
            }else if($v['img'] == null){
                $models[$i]['status'] = 2;
            }else if($v['score'] == -1){
                $models[$i]['status'] = 3;
            }else{
                $models[$i]['status'] = 4;
            }
        }

        // 在当前页获取数据项的数目
        $pageSize = $dataProvider->getPagination()->getPageSize();

        // 获取所有页面的数据项的总数
        $totalCount = $dataProvider->getTotalCount();
        $pageNo = $totalCount % $pageSize == 0 ? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);
        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }

    public function actionTeacherIndex()
    {
        $searchModel = new HomeworkSearch();
        $params = Yii::$app->request->queryParams;
        $params['status'] = 0;

        $session = Yii::$app->session;
        $params['fid'] = $session['USER_SESSION']['fid'];
        $params['ftype'] = $session['USER_SESSION']['ftype'];
        $dataProvider = $searchModel->searchByTeacher($params);
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

    public function actionHisIndex()
    {
        $searchModel = new HomeworkSearch();
        $params = Yii::$app->request->queryParams;
        $params['status'] = 1;

        $session = Yii::$app->session;
        $params['fid'] = $session['USER_SESSION']['fid'];
        $params['ftype'] = $session['USER_SESSION']['ftype'];

        $dataProvider = $searchModel->searchBySql($params);

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


    public function actionAllIndex()
    {
        $searchModel = new HomeworkSearch();
        $params = Yii::$app->request->queryParams;
        $params['is_finish'] = 1;
        $dataProvider = $searchModel->searchBySql($params);

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
        $searchModel = new HomeworkSearch();
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->searchByQuery($params);

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

    public function actionTongji()
    {

        $searchModel = new HomeworkSearch();
        $params = Yii::$app->request->queryParams;

        $dataProvider = $searchModel->searchByTongji($params);

        // 获取分页和排序数据
        $models = $dataProvider->getModels();

        // 在当前页获取数据项的数目
        $pageSize = $dataProvider->getPagination()->getPageSize();

        // 获取所有页面的数据项的总数
        $totalCount = $dataProvider->getTotalCount();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);

        $cids = array();
        $hids = array();
        foreach ($models as $k => $v) {
            if(!in_array($v['cid'], $cids)){
                array_push($cids,$v['cid']);
            }
           if(!in_array($v['id'], $hids)){
                array_push($hids,$v['id']);
            }
            
        }

        $cidNums = array();
        $strCids = implode(",", $cids);
        if($strCids!=''){
            $sSql = "SELECT icl_id,count(1) as num from info_student where icl_id in ($strCids) GROUP by icl_id";
            $scount = Yii::$app->db->createCommand($sSql)->queryAll();
            foreach ($scount as $key => $value) {
                $cidNums[$value['icl_id']] = $value['num'];
            }
        }
     
        $hidNums = array();
        $strHids = implode(",", $hids);
        if($strHids!=''){
            $hSql = "SELECT hid,count(1) as num from  stu_work  where hid in ($strHids) and (simg is not null or sdesc is not null) GROUP BY hid order by hid desc";
            $hcount = Yii::$app->db->createCommand($hSql)->queryAll();            
            foreach ($hcount as $key => $value) {
                $hidNums[$value['hid']] = $value['num'];
            }
        }
       

        for ($i = 0; $i < count($models);$i++) {
            $finCount = 0;
            $obj = $models[$i];
            $id = $obj['id'];
            if(!empty($hidNums) && array_key_exists($id,$hidNums)){
                $finCount = $hidNums[$id];
            }
            $classCount = 0;
             if(!empty($cidNums) && array_key_exists($obj['cid'],$cidNums)){
                $classCount = $cidNums[$obj['cid']];
            }
            if($classCount == 0){
                $models[$i]['fin'] = 0;
            }else{
                $models[$i]['fin'] = (int)($finCount / $classCount * 100);
            }
            
            $models[$i]['finCount'] = $finCount;
        }
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }
    /**
     * Displays a single Homework model.
     * @param integer $id
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
     * Creates a new Homework model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_HTML;
        $model = new Homework();
        $model->img = \Tool::saveFile('img');
        $session = Yii::$app->session;
        $tid = $session['USER_SESSION']['fid'];
        $model->tid = $tid;
        $model->time = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
			$response->content = json_encode(\Tool::toResJson(1, $model->id));
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
			$response->content = json_encode(\Tool::toResJson(0, "添加失败"));
        }
    }
    public function actionList()
    {
        $cid = Yii::$app->request->get("clid",'0');
        $courseId = Yii::$app->request->get("course_id",'0');
        $sql = "SELECT c.*
                FROM homework c
                where course_id = $courseId";
        $model = Yii::$app->db->createCommand($sql)->queryAll();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$model);
    }

    /**
     * Updates an existing Homework model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);

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
     * Deletes an existing Homework model.
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

    public function actionDeletes()
    {
        /**
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "delete from ".Homework::tableName()." where id in(".$ids.")";
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
            $sql = "delete from " . StuWorkUpload::tableName() . " where id in(" . $strIds . ")";
            Yii::$app->db->createCommand($sql)->execute();
            $sql = "delete from " . StuWork::tableName() . " where id in(" . $strIds . ")";
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
    public function actionDel()
    {
        /**
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "delete from ".Homework::tableName()." where id in(".$ids.")";
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
            $sql = "delete from " . Homework::tableName() . " where id in(" . $strIds . ")";
            $res = Yii::$app->db->createCommand($sql)->execute();
            $sql = "delete from " . StuWork::tableName() . " where hid in(" . $strIds . ")";
            Yii::$app->db->createCommand($sql)->execute();
            $sql = "delete from " . StuWorkUpload::tableName() . " where stu_work_id in(select id from " . StuWork::tableName() . " where hid in(" . $strIds . "))";
             Yii::$app->db->createCommand($sql)->execute();
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
     * Finds the Homework model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Homework the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return Homework::findOne($id);
    }
}
