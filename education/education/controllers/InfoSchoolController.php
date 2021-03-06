<?php

namespace app\education\controllers;

use app\education\models\InfoSchool;
use app\education\models\InfoSchoolSearch;
use Yii;
use app\education\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InfoCampusController implements the CRUD actions for InfoCampus model.
 */
class InfoSchoolController extends Controller
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
     * Lists all InfoCampus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoSchoolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

    public function actionSchool()
    {
        $sql = 'SELECT is_id,is_name from info_school';
        $list = Yii::$app->db->createCommand($sql)->queryAll();
        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,$list);
    }
    /**
     * Displays a single InfoCampus model.
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
     * Creates a new InfoCampus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new InfoSchool();

        $model->load(Yii::$app->request->post(),"");

        $admin = new AdminSearch();
        $tf = $admin->hasPhone($model->is_tel);
        if($tf){
            $response->data = \Tool::toResJson(0, "该手机号已经注册过了，请换一个其他的手机号");
            return;
        }

        if ($model->save()) {
            $admin->a_name = $model->is_tel;
            $admin->a_ip = $_SERVER["REMOTE_ADDR"];
            $admin->r_id = 7;
            $admin->fid = $model->is_id;
            $admin->ftype = 7;
            $admin->school_id = $model->is_id;
            $admin->create();
            //return $this->redirect(['view', 'id' => $model->ic_id]);
			$response->data = \Tool::toResJson(1, $model->is_id);
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "添加失败");
        }
    }

    /**
     * Updates an existing InfoCampus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('is_id');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->ic_id]);
			$response->data = \Tool::toResJson(1, $model->is_id);
        } else {
            //return $this->render('update', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "修改失败");
        }
    }

    /**
     * Deletes an existing InfoCampus model.
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
        $sql = "delete from ".InfoCampus::tableName()." where ic_id in(".$ids.")";
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
        $sql = "delete from ".InfoSchool::tableName()." where is_id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the InfoCampus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InfoCampus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return InfoSchool::findOne($id);
    }
}
