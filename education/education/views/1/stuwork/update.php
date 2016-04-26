<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\education\models\StuWork */

$this->title = 'Update Stu Work: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stu Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stu-work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
