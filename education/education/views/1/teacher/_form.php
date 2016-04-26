<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'it_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_start_date')->textInput() ?>

    <?= $form->field($model, 'it_sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_birthday')->textInput() ?>

    <?= $form->field($model, 'it_marry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_id_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'it_edu')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
