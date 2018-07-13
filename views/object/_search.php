<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="object-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_city') ?>

    <?= $form->field($model, 'id_street') ?>

    <?= $form->field($model, 'num_house') ?>

    <?= $form->field($model, 'ldg') ?>

    <?php // echo $form->field($model, 'type_tread') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'size_amount') ?>

    <?php // echo $form->field($model, 'size_life') ?>

    <?php // echo $form->field($model, 'size_kitchen') ?>

    <?php // echo $form->field($model, 'floor') ?>

    <?php // echo $form->field($model, 'home_floors') ?>

    <?php // echo $form->field($model, 'num_bathroom') ?>

    <?php // echo $form->field($model, 'type_bathroom') ?>

    <?php // echo $form->field($model, 'amount_room') ?>

    <?php // echo $form->field($model, 'elevator') ?>

    <?php // echo $form->field($model, 'distance_to_sea') ?>

    <?php // echo $form->field($model, 'distance_to_beach') ?>

    <?php // echo $form->field($model, 'distance_to_shop') ?>

    <?php // echo $form->field($model, 'distance_to_bus_stop') ?>

    <?php // echo $form->field($model, 'distance_school') ?>

    <?php // echo $form->field($model, 'hight_on_sea') ?>

    <?php // echo $form->field($model, 'viev_of_sea') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
