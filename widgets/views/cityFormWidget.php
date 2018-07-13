<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

Modal::begin([
    'header'=>'<h4>Добавление города</h4>',
    'id'=>'city-modal',
]);
?>

    <p>Please fill out the following fields to login:</p>

<?php $form = ActiveForm::begin([
    'id' => 'city-form',
    'enableAjaxValidation' => true,
    'action' => ['cities/ajax-cities']
]);?>
<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ;?>

     <div class="form-group">

    <?php
    echo Html::button('Cancel', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
    echo Html::submitButton('Save', ['class' => 'btn btn-success', 'id'=> 'save_city']);?>
    </div>


<?php
ActiveForm::end();
Modal::end();