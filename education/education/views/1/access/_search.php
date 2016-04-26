<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\AccessSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="access-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'r_id') ?>

    <?= $form->field($model, 'p_id') ?>

    <?= $form->field($model, 'ac_r') ?>

    <?= $form->field($model, 'ac_w') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
