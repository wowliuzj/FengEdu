<?php

namespace app\education\controllers;

use app\education\models\QuestionTitle;
use Yii;
use app\models\Questionnaire;
use app\education\models\QuestionnaireSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionnaireController implements the CRUD actions for Questionnaire model.
 */
class QuestionnaireController extends Controller
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
     * Lists all Questionnaire models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionnaireSearch();
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

    /**
     * Displays a single Questionnaire model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id=null)
    {
        $params = Yii::$app->request->post();
        $category='';
        if(isset($id)){
            $category=$id;
        }
        else{
            $category=($params['category']);
        }
        $sql='SELECT a.*,o.id as oid,o.title as otitle,o.option1,o.option2,o.option3,o.option4,o.option5 
            FROM questionnaire a left join option o on a.option=o.id where a.category='.$category;
        $list =Yii::$app->db->createCommand($sql)->queryAll();
        $question= QuestionTitle::findOne($category);
        $searchModel = new QuestionnaireSearch();
        $dataProvider = $searchModel->searchByCategory($category);
        $models = $dataProvider->getModels();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,["list"=>$list,"title"=>$question->title]);
		
        //return $this->render('view', [
        //    'model' => $this->findModel($id),
        //]);
    }
    public function actionShow()
    {
        $params = Yii::$app->request->post();
        $category_id=($params['category_id']);
        $user_id=($params['user_id']);
        $sql = "SELECT q.*,a.option_id,a.replay,u.utitle,o.id as oid,o.title as otitle,o.option1,o.option2,o.option3,o.option4,o.option5 
                FROM questionnaire q 
                left join answer a on a.category_id=q.category and a.question_id=q.id
                left join question_title u on u.id=q.category
                left join option o on a.option=q.id
                where q.category= ".$category_id;

        $model = Yii::$app->db->createCommand($sql)->queryAll();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        var_dump($model);die();
        $response->data = \Tool::toResJson(1,["list"=>$model] );

    }

    public function actionAnswer($id=null)
    {
        $params = Yii::$app->request->post();

        $category_id=($params['category']);
        $sql = "SELECT q.*,a.option_id,a.replay,u.title as utitle,o.id as oid,o.title as otitle,o.option1,o.option2,o.option3,o.option4,o.option5 
                FROM questionnaire q 
                left join answer a on a.category_id=q.category and a.question_id=q.id
                left join question_title u on u.id=q.category
                left join option o on q.option=o.id
                where q.category= ".$category_id;
        $list =Yii::$app->db->createCommand($sql)->queryAll();
        $question= QuestionTitle::findOne($category_id);
        $searchModel = new QuestionnaireSearch();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,["list"=>$list,"title"=>$question->title]);

        //return $this->render('view', [
        //    'model' => $this->findModel($id),
        //]);
    }
    /**
     * Creates a new Questionnaire model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Questionnaire();
        $session = Yii::$app->session;
        $model->campus_id = $session['USER_SESSION']['campus_id'];
        $model->school_id = $session['USER_SESSION']['school_id'];
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
     * Updates an existing Questionnaire model.
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
     * Deletes an existing Questionnaire model.
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
        $sql = "delete from ".Questionnaire::tableName()." where id in(".$ids.")";
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
        $sql = "delete from ".Questionnaire::tableName()." where id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the Questionnaire model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questionnaire the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return Questionnaire::findOne($id);
    }
}
