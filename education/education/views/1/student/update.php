<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\education\models\Student */

$this->title = 'Update Student: ' . ' ' . $model->is_id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->is_id, 'url' => ['view', 'id' => $model->is_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
