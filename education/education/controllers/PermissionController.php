<?php

namespace app\education\controllers;

use app\education\models\Access;
use Yii;
use app\education\models\Permission;
use app\education\models\PermissionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PermissionController implements the CRUD actions for Permission model.
 */
class PermissionController extends Controller
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

    public function actionList()
    {
        $session = Yii::$app->session;
        $rids = $session['USER_ROLE_ID'];
        $list1 = Yii::$app->cache->get('USER_PERMISSION_'.$rids);
        $sql = 'SELECT * from education.permission where p_id in (SELECT p_id from education.access where r_id in (:rids))';
        $list = Yii::$app->db->createCommand($sql,[':rids' => $session['USER_ROLE_ID']])->queryAll();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $list;
    }
    
    public function actionIndex()
    {
        $searchModel = new PermissionSearch();
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
    }
    /**
     * Lists all Permission models.
     * @return mixed
     */
    public function actionIndexId()
    {
        $rid = Yii::$app->request->get("id");
        $sql = "SELECT r_name,p_alias, a.r_id, a.p_id from access as a,role as b,permission as c where a.r_id = b.r_id and a.p_id = c.p_id and a.r_id = $rid";
        $list = yii::$app->db->createCommand($sql)->queryAll();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,["list"=>$list]);$list;
    }

    /**
     * Lists all Permission models.
     * @return mixed
     */
    public function actionOther()
    {
        $rid = Yii::$app->request->get("id");
        $sql = "SELECT p_id,p_alias,p_name from permission where p_id not in (SELECT p_id from access where r_id=$rid)";
        $list = yii::$app->db->createCommand($sql)->queryAll();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $list;
    }
    /**
     * Displays a single Permission model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Permission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Permission();

        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            return $this->redirect(['view', 'id' => $model->p_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Permission model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('p_id');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            return $this->redirect(['view', 'id' => $model->p_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Permission model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeletes()
    {
        $request = Yii::$app->request;
        $idArray = $request->get();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $transaction = NULL;
        try
        {
            $transaction = Yii::$app->db->beginTransaction();
            foreach($idArray as $k=>$v){
                $index = strrpos($k,'r_p');
                if($index === false){
                    continue;
                }
                $ids = explode('_', $v);
                $sql = "delete from ".Access::tableName()." where r_id = ".$ids[0]." and p_id = ".$ids[1];
                $res = Yii::$app->db->createCommand($sql)->execute();
                if(!$res)
                {
                    if(isset($transaction)) $transaction->rollback();
                    $response->data = \Tool::toResJson(0, "删除失败");
                    return;
                }
            }
            $transaction->commit();
            $response->data = \Tool::toResJson(1, "删除成功");
        }
        catch(Exception $ex)
        {
            if(isset($transaction)) $transaction->rollback();
            $response->data = \Tool::toResJson(0, "删除失败");
        }
    }

    /**
     * Finds the Permission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Permission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permission::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
