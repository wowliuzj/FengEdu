<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\education\models\EvalWorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eval Works';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eval-work-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Eval Work', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shid',
            'star',
            'desc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
