<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\education\models\InfoCampus */

$this->title = $model->ic_id;
$this->params['breadcrumbs'][] = ['label' => 'Info Campuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-campus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ic_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ic_id], [
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
            'ic_id',
            'ic_name',
            'ic_address',
            'ic_postcode',
            'ic_tel',
        ],
    ]) ?>

</div>
