<?php

namespace app\education\controllers;
use Yii;
use app\education\models\Exam;
use app\education\models\ExamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExamController implements the CRUD actions for Exam model.
 */
class ExamController extends Controller
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
     * Lists all Exam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExamSearch();
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

    public function actionScore()
    {
        $searchModel = new ExamSearch();
        $params = Yii::$app->request->queryParams;
        $session = Yii::$app->session;
        
        $ftype = $session['USER_SESSION']['ftype'];
        if($ftype != 7 and $ftype != 8){
            $sid = $session['USER_SESSION']['fid'];
            $params['sid'] = $sid;
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
     * Displays a single Exam model.
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
     * Creates a new Exam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTz()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

         $session = Yii::$app->session;
        $info = $session['USER_SESSION'];
        $cid = $info['cid'];
        //$sql = "SELECT DATE_FORMAT(a.time,'%Y-%m-%d') as time ,b.title,a.`desc` from exam as a,outline as b  where a.title = b.id and a.cid = $cid and DATE_FORMAT(a.time,'%Y-%m-%d') >= DATE_FORMAT(now(),'%Y-%m-%d') ";
        $sql = "SELECT DATE_FORMAT(a.time,'%Y-%m-%d') as time ,b.name as title,a.`desc` from exam as a,course as b  where a.title = b.id and a.cid = $cid and DATE_FORMAT(a.time,'%Y-%m-%d') >= DATE_FORMAT(now(),'%Y-%m-%d')  ";
        $list = Yii::$app->db->createCommand($sql)->queryAll();
        $response->data = \Tool::toResJson(1, $list);
    }

     public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Exam();

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


    public function actionUploadScore()
    {

         $title = Yii::$app->request->post('title');
        $desc = Yii::$app->request->post('desc');
        $cid = Yii::$app->request->post('cid');

        $model = new Exam();
        $model->title = $title;
        $model->cid = $cid;
        $model->desc = $desc;
        $model->save();


        $fileName = \Tool::saveFile('score');
        include '../PHPExcel/IOFactory.php';
        $reader = \PHPExcel_IOFactory::createReader('Excel2007'); // 读取 excel 文件
        $PHPExcel = \PHPExcel_IOFactory::load("../web/" . $fileName);
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表(编号从 0 开始)  
        $highestRow = $sheet->getHighestRow(); // 取得总行数  
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数  

        for ($row = 2; $row <= $highestRow; $row++) {
            $sid = $sheet->getCellByColumnAndRow(1, $row)->getValue();
            $score = $sheet->getCellByColumnAndRow(2, $row)->getValue();
            //保存到数据库
            $sql = "INSERT INTO `exam_score` (`eid`, `sid`, `score`) VALUES ($model->id, $sid, $score)";
            $res = Yii::$app->db->createCommand($sql)->execute();
        }

        unlink("../web/" . $fileName);
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_HTML;
        $response->content = json_encode(\Tool::toResJson(1, "ok"));
    }

    public function actionSaveScore()
    {
        $eid = Yii::$app->request->post('eid');

        $sql = "SELECT * from exam_score where eid=$eid";
        $list = Yii::$app->db->createCommand($sql)->queryAll();
        $sidMap = array();
        foreach($list as  $key => $val){
            $sidMap[$val['sid']] = $val;
        }
        //echo json_encode($sidMap);

        $request = Yii::$app->request;
        $len = 200;
        for($k=0;$k < $len ;$k++) {
            $sid = $request->post("sid$k", '');
            if($sid == ''){
                break;
            }
            $score = $request->post("score".$k,'');
            if($score == ''){
                $score = 0;
            }

            if(isset($sidMap[$sid])){
                $oldScore = $sidMap[$sid]['score'];
                $id = $sidMap[$sid]['id'];
                if($oldScore != $score){
                    $sql = "UPDATE `exam_score` SET `score`='$score' WHERE (`id`='$id')";
                    $res = Yii::$app->db->createCommand($sql)->execute();
                }
            }else{
                //保存到数据库
                $sql = "INSERT INTO `exam_score` (`eid`, `sid`, `score`) VALUES ($eid, $sid, $score)";
                $res = Yii::$app->db->createCommand($sql)->execute();
            }
        }

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1, "ok");
    }
    /**
     * Updates an existing Exam model.
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
     * Deletes an existing Exam model.
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
        $sql = "delete from ".Exam::tableName()." where id in(".$ids.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return Exam::findOne($id);
    }
}
