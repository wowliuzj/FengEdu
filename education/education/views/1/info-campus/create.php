<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\education\models\InfoCampus */

$this->title = 'Create Info Campus';
$this->params['breadcrumbs'][] = ['label' => 'Info Campuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-campus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
