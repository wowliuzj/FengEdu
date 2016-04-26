<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'is_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_hometown')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_birthday')->textInput() ?>

    <?= $form->field($model, 'is_province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_county')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_zone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_id_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_politics')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ic_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ico_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icl_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_room_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_study_date')->textInput() ?>

    <?= $form->field($model, 'is_grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
