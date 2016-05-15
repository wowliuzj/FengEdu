<?php

namespace app\education\controllers;

use Yii;
use app\education\models\Outline;
use app\education\models\OutlineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OutlineController implements the CRUD actions for Outline model.
 */
class OutlineController extends Controller
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
     * Lists all Outline models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OutlineSearch();
        $params = Yii::$app->request->queryParams;
        $session = Yii::$app->session;
        $tid = $session['USER_SESSION']['fid'];
        $params['tid'] = $tid;
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

    public function actionList()
    {
        $cid = Yii::$app->request->get("cid",'0');
        $sql = "SELECT id,title from outline where cid = $cid";
        $model = Yii::$app->db->createCommand($sql)->queryAll();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$model);
    }
    /**
     * Displays a single Outline model.
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

    /**
     * Creates a new Outline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $tid = $session['USER_SESSION']['fid'];
        $cid = Yii::$app->request->post("cid",'');


        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_HTML;

        if($cid == '0'){
            $response->content = '{"s":0,"data":"请选择班级"}';
            return;
        }

        $transaction = NULL;
        try
        {
            $transaction = Yii::$app->db->beginTransaction();
            $model = new Outline();
            $model->load(Yii::$app->request->post(), "");
            $model->time = date("Y-m-d H:i:s");
            $model->tid = $tid;
            $model->save();

            $fileName = \Tool::saveFile('excel_file');
            include '../PHPExcel/IOFactory.php';
            $reader = \PHPExcel_IOFactory::createReader('Excel2007'); // 读取 excel 文件
            $PHPExcel = \PHPExcel_IOFactory::load("../web/" . $fileName);
            $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表(编号从 0 开始)
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数

            for($row = 2; $row <= $highestRow; $row++)
            {
                $name = $sheet->getCellByColumnAndRow(0, $row)->getValue();
                $cnt = $sheet->getCellByColumnAndRow(1, $row)->getValue();
                $num = $sheet->getCellByColumnAndRow(2, $row)->getValue();
                if(!$name || !$cnt || !$num) continue;
                //保存到数据库
                $sql = "INSERT INTO `course` (`outline_id`,`name`, `cnt`, `num`) VALUES ($model->id,'$name', '$cnt', $num)";
                Yii::$app->db->createCommand($sql)->execute();
            }
            $sql = "INSERT INTO `class_teacher` (`cid`, `tid`, `cuid`) VALUES ($cid, $tid, $model->id)";
            Yii::$app->db->createCommand($sql)->execute();

            unlink("../web/" . $fileName);
            $transaction->commit();
            $response->content = json_encode(\Tool::toResJson(1, $model->id));
        }
        catch(Exception $ex)
        {
            if(isset($transaction)) $transaction->rollback();
            $response->content = \Tool::toResJson(0, "添加失败");
        }
    }
    /**
     * Updates an existing Outline model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Outline model.
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
        /**
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "delete from ".Outline::tableName()." where id in(".$ids.")";
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
            $index = strrpos($k,'did');
            if($index === false){
                continue;
            }
            array_push($ids,$v);
        }
        $strIds = implode(",", $ids);
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "delete from ".Outline::tableName()." where id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the Outline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Outline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return Outline::findOne($id);
    }
}
