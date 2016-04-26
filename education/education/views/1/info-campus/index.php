<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\education\models\InfoCampusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Info Campuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-campus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Info Campus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ic_id',
            'ic_name',
            'ic_address',
            'ic_postcode',
            'ic_tel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
