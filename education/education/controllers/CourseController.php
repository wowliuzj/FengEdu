<?php

namespace app\education\controllers;

use Yii;
use app\education\models\Course;
use app\education\models\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
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
        $cid = Yii::$app->request->get("cid",'0');
        $sql = "SELECT c.* 
                FROM course c, outline o, info_class ic
                where c.outline_id = o.id and o.cid = ic.icl_id and ic.icl_id = $cid";
        $model = Yii::$app->db->createCommand($sql)->queryAll();
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$model);
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
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
        $searchModel = new CourseSearch();
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
    /**
     * Displays a single Course model.
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
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $name = Yii::$app->request->post("cName");
        $cnt = Yii::$app->request->post("cContent");
        $num = (int)Yii::$app->request->post("cNum");
        $outline_id = (int)Yii::$app->request->post("outlineId");

        $sql = "INSERT INTO `course` (`outline_id`,`name`, `cnt`, `num`) VALUES ('$outline_id','$name', '$cnt', $num)";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if ($res) {
            //return $this->redirect(['view', 'id' => $model->id]);
			$response->data = \Tool::toResJson(1, 0);
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "添加失败");
        }
    }
    /**
     * Updates an existing Course model.
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
     * Deletes an existing Course model.
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
        $sql = "delete from ".Course::tableName()." where id in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    public function actionStuTongji()
    {

        $searchModel = new CourseSearch();
        $params = Yii::$app->request->queryParams;
        $session = Yii::$app->session;
        $cid = $session['USER_SESSION']['cid'];
        $params['cid'] = $cid;
        $dataProvider = $searchModel->searchByTongji($params);

        // 获取分页和排序数据
        $models = $dataProvider->getModels();

        // 在当前页获取数据项的数目
        $pageSize = $dataProvider->getPagination()->getPageSize();

        // 获取所有页面的数据项的总数
        $totalCount = $dataProvider->getTotalCount();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);
        $courseIds = array();
        foreach ($models as $k => $v) {
           if(!in_array($v['id'], $courseIds)){
                array_push($courseIds,$v['id']);
            }
        }
        $courseKeshis = array();
        $strCourseIds = implode(",", $courseIds);
        if($strCourseIds!=''){
            $hSql = "select course_id,count(1) as num,sum(num) as keshi from  homework where course_id in ($strCourseIds) GROUP BY course_id ";
            $hcount = Yii::$app->db->createCommand($hSql)->queryAll();            
            foreach ($hcount as $key => $value) {
                $courseKeshis[$value['course_id']] = $value['keshi'];
            }
        }
        
        for ($i = 0; $i < count($models);$i++) {
            $keshi = 0;
            $obj = $models[$i];
            $id = $obj['id'];
            if(!empty($courseKeshis) && array_key_exists($id,$courseKeshis)){
                $keshi = $courseKeshis[$id];
            }
    
            $teachRate = (int)($keshi/$obj['num'] * 100);
            if($teachRate > 100){
                $teachRate = 100;
            }
            $models[$i]['teachRate'] = $teachRate ;
        }
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }
    public function actionTongji()
    {

        $searchModel = new CourseSearch();
        $params = Yii::$app->request->queryParams;

        $dataProvider = $searchModel->searchByTongji($params);

        // 获取分页和排序数据
        $models = $dataProvider->getModels();

        // 在当前页获取数据项的数目
        $pageSize = $dataProvider->getPagination()->getPageSize();

        // 获取所有页面的数据项的总数
        $totalCount = $dataProvider->getTotalCount();
        $pageNo =$totalCount % $pageSize ==0? (int)($totalCount / $pageSize) : (int)($totalCount / $pageSize + 1);

        $cids = array();
        $courseIds = array();
        foreach ($models as $k => $v) {
            if(!in_array($v['cid'], $cids)){
                array_push($cids,$v['cid']);
            }
           if(!in_array($v['id'], $courseIds)){
                array_push($courseIds,$v['id']);
            }
            
        }

        $cidNums = array();
        $strCids = implode(",", $cids);
        if($strCids!=''){
            $sSql = "SELECT icl_id,count(1) as num from info_student where icl_id in ($strCids) GROUP by icl_id";
            $scount = Yii::$app->db->createCommand($sSql)->queryAll();
            foreach ($scount as $key => $value) {
                $cidNums[$value['icl_id']] = $value['num'];
            }
        }
     
        $hidNums = array();
        $hYouidNums = array();
        $courseNums = array();
        $courseKeshis = array();
        $strCourseIds = implode(",", $courseIds);
        if($strCourseIds!=''){
            $hSql = "SELECT course_id,count(1) as num from  stu_work as a,homework as b where b.id=a.hid and course_id in ($strCourseIds) and (simg is not null or sdesc is not null) GROUP BY course_id ";
            $hcount = Yii::$app->db->createCommand($hSql)->queryAll();            
            foreach ($hcount as $key => $value) {
                $hidNums[$value['course_id']] = $value['num'];
            }

            $hSql = "SELECT course_id,count(1) as num from  stu_work as a,homework as b where b.id=a.hid and course_id in ($strCourseIds) and score >=18 GROUP BY course_id ";
            $hcount = Yii::$app->db->createCommand($hSql)->queryAll();            
            foreach ($hcount as $key => $value) {
                $hYouidNums[$value['course_id']] = $value['num'];
            }

            $hSql = "select course_id,count(1) as num,sum(num) as keshi from  homework where course_id in ($strCourseIds) GROUP BY course_id ";
            $hcount = Yii::$app->db->createCommand($hSql)->queryAll();            
            foreach ($hcount as $key => $value) {
                $courseNums[$value['course_id']] = $value['num'];
                $courseKeshis[$value['course_id']] = $value['keshi'];
            }
        }
       

        for ($i = 0; $i < count($models);$i++) {
            $finCount = 0;
            $excCount = 0;
            $courseCount = 0;
            $keshi = 0;
            $obj = $models[$i];
            $id = $obj['id'];
            if(!empty($hidNums) && array_key_exists($id,$hidNums)){
                $finCount = $hidNums[$id];
            }
            if(!empty($hYouidNums) && array_key_exists($id,$hYouidNums)){
                $excCount = $hYouidNums[$id];
            }
            if(!empty($courseNums) && array_key_exists($id,$courseNums)){
                $courseCount = $courseNums[$id];
            }
            if(!empty($courseKeshis) && array_key_exists($id,$courseKeshis)){
                $keshi = $courseKeshis[$id];
            }
            $classCount = 0;
            if(!empty($cidNums) && array_key_exists($obj['cid'],$cidNums)){
                $classCount = $cidNums[$obj['cid']];
            }
            if($classCount == 0 or $courseCount == 0){
                $models[$i]['compRate'] = 0;
                $models[$i]['excRate'] = 0;
            }else{
                $models[$i]['compRate'] = (int)($finCount / $classCount /$courseCount * 100);
                $models[$i]['excRate'] = (int)($excCount / $classCount /$courseCount * 100);
            }
            $teachRate = (int)($keshi/$obj['num'] * 100);
            if($teachRate > 100){
                $teachRate = 100;
            }
            $models[$i]['teachRate'] = $teachRate ;
        }
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data =  \Tool::toResJson(1,["list"=>$models,"pageNo"=>$pageNo,"totalCount"=>$totalCount]);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return Course::findOne($id);
    }
}
