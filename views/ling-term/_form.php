<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FuncOwn;
use app\models\LingVar;

/* @var $this yii\web\View */
/* @var $model app\models\LingTerm */
/* @var $form yii\widgets\ActiveForm */
?>

<?php


$script = <<< JS
    $(function(){
        $("#id_func_own").click(function(){
            var n = Number.parseInt($(this).val());
            switch (n)
            {
                case 1:
                    $(".field-d").hide();
                    $(".field-c").show();  
                    $('img').attr('src', '/images/functions/triangle.jpg');
                    break;
                 case 2:               
                    $(".field-c").show();    
                    $(".field-d").show();
                    $('img').attr('src', '/images/functions/trapec.jpg');
                    break;
                case 3:                   
                    $(".field-c").hide();
                    $(".field-d").hide();
                    $('img').attr('src', '/images/functions/simpl_gaus.jpg');
                    break;
                case 4:                      
                    $(".field-c").show();    
                    $(".field-d").show();
                    $('img').attr('src', '/images/functions/guss_2_side.jpg');
                    break;
                case 5:                  
                   $(".field-c").show();    
                    $(".field-d").hide();
                     $('img').attr('src', '/images/functions/gener_bell.jpg');
                    break;
                case 6:                  
                    $(".field-d").hide();
                    $(".field-c").hide();
                     $('img').attr('src', '/images/functions/sigmoid.jpg');
                    break;
                case 7:                  
                    $(".field-c").show();    
                    $(".field-d").show();
                     $('img').attr('src', '/images/functions/sigmoid_addition.jpg');
                    break;
                case 8:                  
                    $(".field-c").show();    
                    $(".field-d").show();
                     $('img').attr('src', '/images/functions/sigmoid_addition_nosimetr.jpg');
                    break;
            }
           
        });

         
    });
JS;
$this->registerJs($script);
?>

<div class="ling-term-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'style'=>'width:300px']) ?>
            <?= $form->field($model, 'id_func_own')->dropdownList(FuncOwn::dropdown(),
                ['style'=>'width:300px', 'id' => 'id_func_own'
                ]);?>
            <?= $form->field($model, 'id_ling_var')->dropdownList(LingVar::dropdown(),
                 ['style'=>'width:300px', 'id' => 'id_ling_var'
                 ]);?>
            <?= $form->field($model, 'a')->textInput(['style'=>'width:100px']) ?>

            <?= $form->field($model, 'b')->textInput(['style'=>'width:100px']) ?>

            <?= $form->field($model, 'c')->textInput(['id'=>'c','style'=>'width:100px']) ?>

            <?= $form->field($model, 'd')->textInput(['id'=>'d','style'=>'width:100px']) ?>
        </div>
        <div class="col-xs-8">
            <img src="/images/functions/triangle.jpg" >
        </div>


</div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
