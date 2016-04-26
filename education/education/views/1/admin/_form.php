<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'a_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a_pwd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a_salt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
