<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\StuWork */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stu-work-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'cid')->textInput() ?>

    <?= $form->field($model, 'sid')->textInput() ?>

    <?= $form->field($model, 'hid')->textInput() ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sdesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
