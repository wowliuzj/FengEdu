<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\ReplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tid') ?>

    <?= $form->field($model, 'floor') ?>

    <?= $form->field($model, 'sid') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
