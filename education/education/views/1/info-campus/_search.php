<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\InfoCampusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-campus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ic_id') ?>

    <?= $form->field($model, 'ic_name') ?>

    <?= $form->field($model, 'ic_address') ?>

    <?= $form->field($model, 'ic_postcode') ?>

    <?= $form->field($model, 'ic_tel') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
