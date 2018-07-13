<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\Cities;

/* @var $this yii\web\View */
/* @var $model app\models\Streets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="streets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_city')->dropdownList(Cities::dropdown(),
        ['style'=>'width:300px', 'id' => 'id_city'
        ]);?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
