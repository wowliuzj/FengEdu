<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\education\models\HomeworkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Homeworks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Homework', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cid',
            'time',
            'img',
            'desc',
            // 'finish_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
