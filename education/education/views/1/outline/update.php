<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\education\models\Outline */

$this->title = 'Update Outline: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Outlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outline-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
