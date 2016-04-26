<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\education\models\StuWork */

$this->title = 'Create Stu Work';
$this->params['breadcrumbs'][] = ['label' => 'Stu Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stu-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
