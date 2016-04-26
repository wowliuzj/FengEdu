<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\education\models\Attent */

$this->title = 'Create Attent';
$this->params['breadcrumbs'][] = ['label' => 'Attents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
