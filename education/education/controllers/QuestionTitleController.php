<?php

namespace app\education\controllers;

use app\education\models\QuestionTitle;
use app\education\models\QuestionTitleSearch;
use Yii;
use app\education\models\Activity;
use app\education\models\ActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class QuestionTitleController extends Controller
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
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionTitleSearch();
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);

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

    public function actionMyIndex()
    {
        $searchModel = new ActivitySearch();
        $params = Yii::$app->request->queryParams;
        $session = Yii::$app->session;
        $params['ftype'] = $session['USER_SESSION']['ftype'];
        $params['fid'] = $session['USER_SESSION']['fid'];    
    
        
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
        $searchModel = new ActivitySearch();
        $params = Yii::$app->request->queryParams;
        $session = Yii::$app->session;
        $ftype = $session['USER_SESSION']['ftype']; 
        if($ftype == 8 or $ftype == 3 or $ftype == 4){
             $campus_id = $session['USER_SESSION']['campus_id'];
             $params['campus_id']=$campus_id ;
        }
        
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

    /**
     * Displays a single Activity model.
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
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new QuestionTitle();
        $model->load(Yii::$app->request->post(),"");

        $session = Yii::$app->session;
       /* $model->campus_id = $session['USER_SESSION']['campus_id'];
        $model->icl_tid = $session['USER_SESSION']['fid'];*/
        if ($model->save()) {
            //return $this->redirect(['view', 'id' => $model->icl_id]);
            $response->data = \Tool::toResJson(1, $model->id);
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
            $response->data = \Tool::toResJson(0, "添加失败");
        }
       /* $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new QuestionTitle();
        //$model->time = date("Y-m-d H:i:s");
        $model->load(Yii::$app->request->post(),"");
        if ($model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $response->data = \Tool::toResJson(1, $model->id);
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
            $response->data = \Tool::toResJson(0, "添加失败");
        }*/
    }
    //分享
    public function actionAnswer()
    {
        $params = Yii::$app->request->post();
        $id=($params['category']);
        $sql = "SELECT distinct a.`user_name`,a.`user_id`,b.title,a.category_id FROM answer a, question_title b WHERE a.`category_id` = b.`id` AND a.`category_id` = ".$id;

        $model = Yii::$app->db->createCommand($sql)->queryAll();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,["list"=>$model] );

    }

    public function actionShow()
    {
        $params = Yii::$app->request->post();
        $category_id=($params['category_id']);
        $user_id=($params['user_id']);
        $sql = "SELECT q.*,a.option_id,u.utitle,o.id as oid,o.title as otitle,o.option1,o.option2,o.option3,o.option4,o.option5 
                FROM questionnaire q 
                left join answer a on a.category_id=q.category and a.question_id=q.id
                left join question_title u on u.id=q.category
                left join option o on a.option=q.id
                where q.category= ".$category_id;

        $model = Yii::$app->db->createCommand($sql)->queryAll();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,["list"=>$model] );

    }
    //教师总结活动
    public function actionSummary()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $model->load(Yii::$app->request->post(),"");

        $model->img = \Tool::saveFile('img');
        $model->save();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_HTML;

        $response->content = json_encode(\Tool::toResJson(1, "活动总结成功"));
        // 文件上传成功
    }
    /**
     * Updates an existing Activity model.
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
     * Deletes an existing Activity model.
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
        $sql = "delete from ".Activity::tableName()." where id in(".$ids.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return Activity::findOne($id);
    }
}
