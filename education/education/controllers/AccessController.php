<?php

namespace app\education\controllers;

use Yii;
use app\education\models\Access;
use app\education\models\AccessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccessController implements the CRUD actions for Access model.
 */
class AccessController extends Controller
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
        $searchModel = new AccessSearch();
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

    /**
     * Creates a new Access model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $rid = $request->post("r_id");

        $idArray = $request->post();
        foreach($idArray as $k=>$v){
            $index = strrpos($k,'p_id');
            if($index === false){
                continue;
            }
            //保存到数据库
            $sql = "INSERT INTO `access` (`r_id`, `p_id`) VALUES ($rid, $v)";
            $res = Yii::$app->db->createCommand($sql)->execute();
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
