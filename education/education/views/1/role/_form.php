<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'r_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
