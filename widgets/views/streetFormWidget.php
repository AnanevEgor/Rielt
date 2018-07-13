<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use \app\models\Cities;
Modal::begin([
    'header'=>'<h4>Добавление Улицы</h4>',
    'id'=>'street-modal',
]);
?>

    <p>Please fill out the following fields to login:</p>

<div class="streets-form">

    <?php $form = ActiveForm::begin([
        'id' => 'street-form',
        'enableAjaxValidation' => true,
        'action' => ['streets/ajax-street']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_city')->dropdownList(Cities::dropdown(),
        ['style'=>'width:300px', 'id' => 'id_city'
        ]);?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'id'=>'save_street']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
Modal::end();