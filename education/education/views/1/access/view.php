<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\education\models\Access */

$this->title = $model->r_id;
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'r_id' => $model->r_id, 'p_id' => $model->p_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'r_id' => $model->r_id, 'p_id' => $model->p_id], [
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
            'r_id',
            'p_id',
            'ac_r',
            'ac_w',
        ],
    ]) ?>

</div>
