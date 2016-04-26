<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\education\models\PermissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'p_id',
            'p_name',
            'p_alias',
            'p_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
