<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\education\models\Outline */

$this->title = 'Create Outline';
$this->params['breadcrumbs'][] = ['label' => 'Outlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
