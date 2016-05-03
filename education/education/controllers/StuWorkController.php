<?php

namespace app\education\controllers;

use Yii;
use app\education\models\StuWork;
use app\education\models\StuWorkSearch;
use app\education\models\StuWorkUpload;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StuWorkController implements the CRUD actions for StuWork model.
 */
class StuWorkController extends Controller
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

    public function actionUpload()
    {
        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        // usleep(5000);

        // Settings
        $targetDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . "../../web/uploads";
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
            $fileNameList = explode('.', $filePath);
            $name = time() . '_' . md5(mt_rand(0, 999999)) . '.' . $fileNameList[count($fileNameList) -1];
            rename($filePath, $targetDir . DIRECTORY_SEPARATOR . $name);
        }

        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "file" : "'.$name.'"}');
    }

    /**
     * Lists all StuWork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StuWorkSearch();
        $dataProvider = $searchModel->searchBySql(Yii::$app->request->queryParams);

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

    public function actionQuery()
    {
        $searchModel = new StuWorkSearch();
        $dataProvider = $searchModel->searchByQuery(Yii::$app->request->queryParams);

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

    public function actionWall()
    {
        $searchModel = new StuWorkSearch();
        $dataProvider = $searchModel->searchByWall();

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
     * Displays a single StuWork model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $sql = "SELECT c.it_name,b.title,b.time,b.img,b.`desc`,a.stime,sdesc,simg,a.ttime,score,tdesc from stu_work as a,homework as b,info_teacher as c where a.hid = b.id and b.tid = c.it_id and  a.id = $id";
	    $model = Yii::$app->db->createCommand($sql)->queryOne();
    	$response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$model);
    }

    /**
     * Creates a new StuWork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $sid = $session['USER_SESSION']['fid'];
        $cid = $session['USER_SESSION']['cid'];
        $hid = Yii::$app->request->get("hid");

        $sql = "SELECT id from stu_work where sid=$sid and hid=$hid";
        $info = Yii::$app->db->createCommand($sql)->queryOne();
        if($info != null){
            $response->data = \Tool::toResJson(1, $model->id);
            return;
        }

        $model = new StuWork();
        
        $model->sid = $sid;
        $model->cid = $cid;
        $model->hid = $hid;
        $model->score = -1;

        if ($model->save()) {
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
     * Updates an existing StuWork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_HTML;
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $model->stime = date("Y-m-d H:i:s");
        /*if(!empty($_FILES['simg']['tmp_name'])){
             $model->simg = \Tool::saveFile('simg');
        }*/

        $transaction = NULL;
        try
        {
            $transaction = Yii::$app->db->beginTransaction();
            $uploadList = explode('###$$$', Yii::$app->request->post("uploadList"));
            foreach($uploadList as $row)
            {
                if(!$row) continue;
                if(StuWorkUpload::find()->where(['file' => $row])->count()) continue;
                $upload = new StuWorkUpload();
                $upload->stu_work_id = $id;
                $upload->file = $row;
                $upload->upload_time = date("Y-m-d H:i:s");
                $upload->save();
            }
            if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
                //return $this->redirect(['view', 'id' => $model->id]);
                $transaction->commit();
                $response->content = json_encode(\Tool::toResJson(1, $model->id));
            } else {
                if(isset($transaction)) $transaction->rollback();
                $response->content = json_encode(\Tool::toResJson(0, "修改失败"));
            }
        }
        catch(Exception $ex)
        {
            if(isset($transaction)) $transaction->rollback();
            $response->content = json_encode(\Tool::toResJson(0, "修改失败"));
        }
    }

    public function actionTeaEval()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $model->ttime = date("Y-m-d H:i:s");
        
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
     * Deletes an existing StuWork model.
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
        $sql = "delete from ".StuWork::tableName()." where id in(".$ids.")";
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
        $sql = "delete from ".StuWork::tableName()." where id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the StuWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StuWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return StuWork::findOne($id);
    }
}
