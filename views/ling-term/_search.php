<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LingTermSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ling-term-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'id_func_own') ?>

    <?= $form->field($model, 'id_ling_var') ?>

    <?= $form->field($model, 'a') ?>

    <?php // echo $form->field($model, 'b') ?>

    <?php // echo $form->field($model, 'c') ?>

    <?php // echo $form->field($model, 'd') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
