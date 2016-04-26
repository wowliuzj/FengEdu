<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\TeacherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'it_id') ?>

    <?= $form->field($model, 'it_name') ?>

    <?= $form->field($model, 'it_start_date') ?>

    <?= $form->field($model, 'it_sex') ?>

    <?= $form->field($model, 'it_birthday') ?>

    <?php // echo $form->field($model, 'it_marry') ?>

    <?php // echo $form->field($model, 'it_tel') ?>

    <?php // echo $form->field($model, 'it_address') ?>

    <?php // echo $form->field($model, 'it_email') ?>

    <?php // echo $form->field($model, 'it_note') ?>

    <?php // echo $form->field($model, 'it_id_card') ?>

    <?php // echo $form->field($model, 'it_password') ?>

    <?php // echo $form->field($model, 'it_edu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
