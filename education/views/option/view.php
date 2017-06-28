<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\education\models\Option */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'title',
            'option1',
            'option2',
            'option3',
            'option4',
            'option5',
            'school_id',
            'user_id',
        ],
    ]) ?>

</div>
