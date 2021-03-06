<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\education\models\Homework */

$this->title = 'Update Homework: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Homeworks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="homework-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
