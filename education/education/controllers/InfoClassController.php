<?php

namespace app\education\controllers;

use Yii;
use app\education\models\InfoClass;
use app\education\models\InfoClassSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InfoClassController implements the CRUD actions for InfoClass model.
 */
class InfoClassController extends Controller
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
     * Lists all InfoClass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoClassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //return $this->render('index', [
        //    'searchModel' => $searchModel,
        //    'dataProvider' => $dataProvider,
        //]);
        // 获取分页和排序数据
        $models = $dataProvider->getModels();
        $classList = array();
        foreach ($models as $key => $value) {
            $cid =  $value['icl_id'];
            $sql = "SELECT b.title,c.it_name as tname, d.name as cname
                    from class_teacher as a,outline as b,info_teacher as c, course as d
                    where a.tid = c.it_id and a.cid = b.cid and c.it_id = b.tid and d.outline_id = b.id and a.cid = $cid";
            $tlist = Yii::$app->db->createCommand($sql)->queryAll(); 
            $obj = array();
            $obj['icl_id']=$value['icl_id'];
            $obj['status']=$value['status'];
            $obj['icl_number']=$value['icl_number'];
            $obj['tlist'] = $tlist;
            $classList[$key] = $obj;
        }

       
        // 在当前页获取数据项的数目
        $pageSize = $dataProvider->getPagination()->getPageSize();

        // 获取所有页面的数据项的总数
        $totalCount = $dataProvider->getTotalCount();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$classList,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }

    public function actionClasses()
    {
        $session = Yii::$app->session;

        $tid = $session['USER_SESSION']['fid'];
        
        $sql = 'SELECT icl_id,icl_number 
                from info_class 
                where campus_id = :campus_id and (icl_id in (SELECT cid from class_teacher where tid=:tid) or icl_tid=:tid) ';
        //echo $sql . $tid;die();
        $list = Yii::$app->db->createCommand($sql,[':tid' => $tid, ':campus_id'=>$session['USER_SESSION']['campus_id']])->queryAll();
        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,$list);
    }


    public function actionAllClasses()
    {
        $session = Yii::$app->session;
        $ftype = $session['USER_SESSION']['ftype'];
        $campus_id = $session['USER_SESSION']['campus_id'];

        $sql = 'SELECT icl_id,icl_number from info_class where status=1';
        $tid = Yii::$app->request->get("tid","");
        if($tid!=""){
            $sql = $sql . " and (icl_id in (SELECT cid from class_teacher where tid=$tid) or icl_tid=$tid )";
        }
        if($ftype == 8 or $ftype == 3 or $ftype == 4){
            $sql = $sql . " and campus_id=$campus_id";
        }else{
            $params = Yii::$app->request->queryParams;
            if(isset($params['campus_id'])){
               $campus_id = $params['campus_id'];
               if($campus_id!='' and $campus_id!='0'){
                   $sql = $sql . " and campus_id=$campus_id";
               }
            }
        }
        $list = Yii::$app->db->createCommand($sql)->queryAll();
        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,$list);
    }
    /**
     * Displays a single InfoClass model.
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

    public function actionUpdate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('icl_id');
        $model = $this->findModel($id);
        $model->load(Yii::$app->request->post(),"");
        if ($model->save()) {
            // return $this->redirect(['view', 'id' => $model->is_id]);
            $response->data = \Tool::toResJson(1, $model->icl_id);
        } else {
            $response->data = \Tool::toResJson(0, "修改失败");
            // return $this->render('update', [
            //     'model' => $model,
            // ]);
        }
    }

    /**
     * Creates a new InfoClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new InfoClass();

        $model->load(Yii::$app->request->post(),"");
        $session = Yii::$app->session;
        $model->campus_id = $session['USER_SESSION']['campus_id'];
        $model->icl_tid = $session['USER_SESSION']['fid'];
        if ($model->save()) {
            //return $this->redirect(['view', 'id' => $model->icl_id]);
			$response->data = \Tool::toResJson(1, $model->icl_id);
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "添加失败");
        }
    }

    /**
     * Updates an existing InfoClass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param jn  2     xh9l6juj6 g.j    fe5r54j8.;988/k987y658cs]);
			$response->data = \Tool::toResJson(0, "修改失败");
        }
    }

    /**
     * Deletes an existing InfoClass model.
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
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

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
        if($strIds == ''){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
            return;
        }

        $sql = "delete from ".InfoClass::tableName()." where icl_id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the InfoClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InfoClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return InfoClass::findOne($id);
    }
}
