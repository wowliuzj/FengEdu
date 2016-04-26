<?php

namespace app\education\controllers;

use Yii;
use app\education\models\Attent;
use app\education\models\AttentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttentController implements the CRUD actions for Attent model.
 */
class AttentController extends Controller
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
     * Lists all Attent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        $totalCount = $dataProvider->getTotalCount();

        if($totalCount == 0){
            $request = Yii::$app->request;
            $cid = $request->get('cid', '');
            if($cid != ""){
                 $time = $request->get('time', date('Y-m-d'));
                $sql = "insert into attent(cid,sid,time,`status`) select icl_id as cid,is_id as sid,'".
                    $time."' as time,0 as `status` from info_student where icl_id=$cid";
                $res = Yii::$app->db->createCommand($sql)->execute();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $models = $dataProvider->getModels();
                $totalCount = $dataProvider->getTotalCount();
            }
        }

        $pageSize = $dataProvider->getPagination()->getPageSize();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }

    public function actionTongji()
    {
        $searchModel = new AttentSearch();
        $params = Yii::$app->request->queryParams;
        $session = Yii::$app->session;
        
        $ftype = $session['USER_SESSION']['ftype'];
        if($ftype == 8 or $ftype == 3 or $ftype == 4){
             $campus_id = $session['USER_SESSION']['campus_id'];
             $params['campus_id']=$campus_id ;
        }
        $dataProvider = $searchModel->tongji($params);
        $models = $dataProvider->getModels();
        $totalCount = $dataProvider->getTotalCount();
       
        $pageSize = $dataProvider->getPagination()->getPageSize();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }

    public function actionMyAttent()
    {
        $searchModel = new AttentSearch();
        $params = Yii::$app->request->queryParams;

        $session = Yii::$app->session;
        $sid = $session['USER_SESSION']['fid'];

        $params['sid'] = $sid;
        $dataProvider = $searchModel->tongji($params);
        $models = $dataProvider->getModels();
        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,$models);
    }

    /**
     * Displays a single Attent model.
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
     * Creates a new Attent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Attent();

        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
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
     * Updates an existing Attent model.
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

    public function actionModStatus()
    {
        $request = Yii::$app->request;
        $idArray = array();
        $len = 20;
        for($k=0;$k < $len ;$k++) {
            $id = $request->post("sid$k", '');
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
            $sql = "update attent set status=".$stat." where id in(".$ids.")";
            $res = Yii::$app->db->createCommand($sql)->execute();
        }
       
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1, "修改成功");
    }
    /**
     * Deletes an existing Attent model.
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
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "delete from ".Attent::tableName()." where id in(".$ids.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the Attent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return Attent::findOne($id);
    }
}
