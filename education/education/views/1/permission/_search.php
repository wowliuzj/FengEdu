<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\education\models\PermissionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'p_id') ?>

    <?= $form->field($model, 'p_name') ?>

    <?= $form->field($model, 'p_alias') ?>

    <?= $form->field($model, 'p_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
