<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\education\models\Attent */

$this->title = 'Update Attent: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Attents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
