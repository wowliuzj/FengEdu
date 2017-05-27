<?php

namespace app\education\controllers;

use app\education\models\Answer;
use app\education\models\AnswerSearch;
use Yii;
use app\education\models\Access;
use app\education\models\AccessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccessController implements the CRUD actions for Access model.
 */
class AnswerController extends Controller
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
     * Lists all Access models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnswerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Access model.
     * @param string $r_id
     * @param string $p_id
     * @return mixed
     */
    public function actionView($r_id, $p_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($r_id, $p_id),
        ]);
    }

    public function actionCheck($id)
    {
        $session = Yii::$app->session;
        $userId=$session['USER_SESSION']['id'];
        $sql = "SELECT * FROM education.answer q 
                where q.user_id=".$userId." and q.category_id= ".$id;
        $list =Yii::$app->db->createCommand($sql)->queryAll();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        if(count($list)>0){
            $response->data = \Tool::toResJson(1, ["user_id"=>$userId]);
        }
        else{
            $response->data = \Tool::toResJson(2, "ok");
        }
    }
    /**
     * Creates a new Access model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
       $array=$request->post();
        $session = Yii::$app->session;
        $name=$session['USER_SESSION']['name'];
        $id=$session['USER_SESSION']['id'];
        $category_id='';
        foreach ($array as  $k=>$v){
            $answer=new Answer();
            if($k=='category'){
                $category_id=$v;
                continue;
            }
            $answer->category_id=$category_id;
            $answer->user_id=$id;
            $answer->user_name=$name;
            if(strpos($k, 'status')){
                $tmparray = explode('_',$k);
                $answer->question_id=$tmparray[0];
                $answer->question_style=2;
                $answer->option_id=$v;
            }
            if(strpos($k, 'text')){
                $tmparray = explode('_',$k);
                $answer->question_id=$tmparray[0];
                $answer->question_style=1;
                $answer->replay=$v;
            };
            $answer->status=1;
            $answer->save();
        }
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1, "ok");
    }

    /**
     * Updates an existing Access model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $r_id
     * @param string $p_id
     * @return mixed
     */
    public function actionUpdate($r_id, $p_id)
    {
        $model = $this->findModel($r_id, $p_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'r_id' => $model->r_id, 'p_id' => $model->p_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Access model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $r_id
     * @param string $p_id
     * @return mixed
     */
    public function actionDelete($r_id, $p_id)
    {
        $this->findModel($r_id, $p_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Access model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $r_id
     * @param string $p_id
     * @return Access the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($r_id, $p_id)
    {
        if (($model = Access::findOne(['r_id' => $r_id, 'p_id' => $p_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
