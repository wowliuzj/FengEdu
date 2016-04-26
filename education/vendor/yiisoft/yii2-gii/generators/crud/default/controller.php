<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
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
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
    public function actionIndex()
    {
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);

        //return $this->render('index', [
        //    'searchModel' => $searchModel,
        //    'dataProvider' => $dataProvider,
        //]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        //return $this->render('index', [
        //    'dataProvider' => $dataProvider,
        //]);
<?php endif; ?>
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
     * Displays a single <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionView(<?= $actionParams ?>)
    {
		$response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = \Tool::toResJson(1,$this->findModel($id));
		
        //return $this->render('view', [
        //    'model' => $this->findModel(<?= $actionParams ?>),
        //]);
    }

    /**
     * Creates a new <?= $modelClass ?> model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $model = new <?= $modelClass ?>();

        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            //return $this->redirect(['view', <?= $urlParams ?>]);
			$response->data = \Tool::toResJson(1, $model-><?=$pks[0]?>);
        } else {
            //return $this->render('create', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "添加失败");
        }
    }
    /**
     * Updates an existing <?= $modelClass ?> model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionUpdate()
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('<?=$pks[0]?>');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post(),"") && $model->save()) {
            //return $this->redirect(['view', <?= $urlParams ?>]);
			$response->data = \Tool::toResJson(1, $model-><?=$pks[0]?>);
        } else {
            //return $this->render('update', [
            //    'model' => $model,
            //]);
			$response->data = \Tool::toResJson(0, "修改失败");
        }
    }

    /**
     * Deletes an existing <?= $modelClass ?> model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionDelete(<?= $actionParams ?>)
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
        $sql = "delete from ".<?= $modelClass ?>::tableName()." where <?=$pks[0]?> in(".$ids.")";
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
        $sql = "delete from ".<?= $modelClass ?>::tableName()." where <?=$pks[0]?> in(".$strIds.")";
        $res = Yii::$app->db->createCommand($sql)->execute();
        if($res == 0){
            $response->data = \Tool::toResJson(0, "找不到该记录，删除失败");
        }else{
            $response->data = \Tool::toResJson(1, "删除成功");
        }
    }

    /**
     * Finds the <?= $modelClass ?> model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return <?=                   $modelClass ?> the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        return <?= $modelClass ?>::findOne(<?= $condition ?>);
    }
}
