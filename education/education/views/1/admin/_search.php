<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\AdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'a_id') ?>

    <?= $form->field($model, 'a_name') ?>

    <?= $form->field($model, 'a_pwd') ?>

    <?= $form->field($model, 'a_salt') ?>

    <?= $form->field($model, 'r_id') ?>

    <?php // echo $form->field($model, 'a_ip') ?>

    <?php // echo $form->field($model, 'a_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
