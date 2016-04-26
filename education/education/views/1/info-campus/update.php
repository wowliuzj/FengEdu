<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\education\models\InfoCampus */

$this->title = 'Update Info Campus: ' . ' ' . $model->ic_id;
$this->params['breadcrumbs'][] = ['label' => 'Info Campuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ic_id, 'url' => ['view', 'id' => $model->ic_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="info-campus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
