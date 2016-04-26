<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\education\models\Access */

$this->title = 'Update Access: ' . ' ' . $model->r_id;
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->r_id, 'url' => ['view', 'r_id' => $model->r_id, 'p_id' => $model->p_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="access-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
