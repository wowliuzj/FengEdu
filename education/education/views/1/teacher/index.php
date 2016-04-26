<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\education\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'it_id',
            'it_name',
            'it_start_date',
            'it_sex',
            'it_birthday',
            // 'it_marry',
            // 'it_tel',
            // 'it_address',
            // 'it_email:email',
            // 'it_note',
            // 'it_id_card',
            // 'it_password',
            // 'it_edu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
