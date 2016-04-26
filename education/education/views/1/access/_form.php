<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\Access */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="access-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'r_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ac_r')->textInput() ?>

    <?= $form->field($model, 'ac_w')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
