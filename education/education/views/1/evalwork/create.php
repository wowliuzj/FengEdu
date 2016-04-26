<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\education\models\EvalWork */

$this->title = 'Create Eval Work';
$this->params['breadcrumbs'][] = ['label' => 'Eval Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eval-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
