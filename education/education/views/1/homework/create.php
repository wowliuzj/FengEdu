<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\education\models\Homework */

$this->title = 'Create Homework';
$this->params['breadcrumbs'][] = ['label' => 'Homeworks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
