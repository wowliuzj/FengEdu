<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\InfoCampus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-campus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ic_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ic_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ic_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ic_tel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
