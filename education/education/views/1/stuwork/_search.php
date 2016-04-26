<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\StuWorkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stu-work-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'sid') ?>

    <?= $form->field($model, 'hid') ?>

    <?= $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'sdesc') ?>

    <?php // echo $form->field($model, 'score') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
