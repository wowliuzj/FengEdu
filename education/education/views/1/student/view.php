<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\education\models\Student */

$this->title = $model->is_id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->is_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->is_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'is_id',
            'is_name',
            'is_hometown',
            'is_sex',
            'is_birthday',
            'is_province',
            'is_city',
            'is_county',
            'is_zone',
            'is_address',
            'is_id_card',
            'is_politics',
            'ic_name',
            'ico_id',
            'id_id',
            'icl_id',
            'is_email:email',
            'is_tel',
            'is_room',
            'is_room_number',
            'is_study_date',
            'is_grade',
            'is_status',
        ],
    ]) ?>

</div>
