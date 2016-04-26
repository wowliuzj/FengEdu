<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\education\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'is_id',
            'is_name',
            'is_hometown',
            'is_sex',
            'is_birthday',
            // 'is_province',
            // 'is_city',
            // 'is_county',
            // 'is_zone',
            // 'is_address',
            // 'is_id_card',
            // 'is_politics',
            // 'ic_name',
            // 'ico_id',
            // 'id_id',
            // 'icl_id',
            // 'is_email:email',
            // 'is_tel',
            // 'is_room',
            // 'is_room_number',
            // 'is_study_date',
            // 'is_grade',
            // 'is_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
