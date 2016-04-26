<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\education\models\OutlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Outlines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outline-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Outline', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'cid',
            'tid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
