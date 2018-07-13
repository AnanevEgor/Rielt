<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cities;
use yii\helpers\Url;
use app\models\Streets;
use app\widgets\StreetFormWidget;
use app\widgets\CityFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Object */
/* @var $form yii\widgets\ActiveForm */

?>
<?php


$script = <<< JS
    $(function(){
        $("#save_street").click(function() {
       $("button.close").click();

        });
        $("#save_city").click(function() {
       $("button.close").click();
    
        });
    });
JS;
$this->registerJs($script);
?>
<?php echo CityFormWidget::widget([]); ?>
<?php echo StreetFormWidget::widget([]); ?>
<div class="object-form container">


    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <h2 style="color: #1b6d85">Адрес</h2>
    <div class="col-xs-2">
        <?= $form->field($model, 'id_city')->dropdownList(Cities::dropdown(),
        ['style'=>'width:150px',
          'prompt' => 'Выберите город',
          'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl('object/list-streets?id=').'"+$(this).val(), 
          function(data) {$("select#id_street").html(data);})',
        ]); ?>



    </div>
    <div class="col-xs-1">
    <?=
    Html::a('+', '#',['class' => 'btn btn-success','data-toggle' => 'modal', 'data-target' => '#city-modal', 'style'=> 'margin-top:25px; margin-left:-35px']);
    ?>
    </div>
    <div class="col-xs-2">
        <?= $form->field($model, 'id_street')->dropdownList(Streets::dropdown(),
        ['style'=>'width:200px', 'id' => 'id_street'
        ]);?>
    </div>
    <div class="col-xs-1">
        <?=
        Html::a('+', '#',['class' => 'btn btn-success','data-toggle' => 'modal', 'data-target' => '#street-modal', 'style'=> 'margin-top:25px; margin-left:15px']);
        ?>
    </div>
    <div class="col-xs-4">
        <?= $form->field($model, 'num_house')->textInput(['style'=>'width:100px;']) ?>
    </div>
</div>


    <?= $form->field($model, 'type_tread')->dropdownList( ['0' => 'Продажа',
        '2' => 'Сдача',],
    ['style'=>'width:150px;']

        ) ?>

    <?= $form->field($model, 'price')->textInput(['style'=>'width:250px;']) ?>

<div class="row">
    <h2 style="color: #1b6d85">Характеристика квартиры</h2>
    <div class="col-xs-2">
        <?= $form->field($model, 'amount_room')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2">
        <?= $form->field($model, 'floor')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2"=>
        <?= $form->field($model, 'viev_of_sea')->dropdownList(['0' => 'Нет',
            '1' => 'Есть',],
            ['style'=>'width:100px']) ?>
    </div>
</div>

<div class="row">

    <h3 style="color: #1b6d85">Площадь квартиры</h3>
    <div class="col-xs-2">
        <?= $form->field($model, 'size_amount')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2">
        <?= $form->field($model, 'size_life')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2">
        <?= $form->field($model, 'size_kitchen')->textInput(['style'=>'width:100px;']) ?>
    </div>

</div>

    <div class="row">
        <h3 style="color: #1b6d85">Санузел</h3>
        <div class="col-xs-2">
            <?= $form->field($model, 'num_bathroom')->textInput(['style'=>'width:100px;']) ?>
        </div>
        <div class="col-xs-2">
            <?= $form->field($model, 'type_bathroom')->dropdownList(['0' => 'Раздельный',
                '1' => 'Совмещенный',
                '2' => 'И совмещенный и раздельный',],
                ['style'=>'width:250px']) ?>
        </div>
    </div>
<div class="row">
    <h2 style="color: #1b6d85">Характеристика здания</h2>
    <div class="col-xs-2">
        <?= $form->field($model, 'home_floors')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2">
    <?= $form->field($model, 'elevator')->dropdownList(['0' => 'Отсутствует',
        '1' => 'есть, только пассажирский',
        '2' => 'есть грузовой'],['style'=>'width:250px']) ?>
    </div>
</div>




<div class="row">
    <h2 style="color: #1b6d85">Дистанции</h2>
    <h3 style="color: #1b6d85">Для отдыха</h3>
    <div class="col-xs-2" style="width:200px">
        <?= $form->field($model, 'distance_to_sea')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2" style="width:200px">
        <?= $form->field($model, 'distance_to_beach')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2" style="width:250px">
        <?= $form->field($model, 'hight_on_sea')->textInput(['style'=>'width:100px;']) ?>
    </div>
</div>
<div class="row">
    <h3 style="color: #1b6d85">Для жизни</h3>
    <div class="col-xs-2" style="width:200px">
        <?= $form->field($model, 'distance_to_shop')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2" style="width:200px">
        <?= $form->field($model, 'distance_school')->textInput(['style'=>'width:100px;']) ?>
    </div>
    <div class="col-xs-2" style="width:250px">
        <?= $form->field($model, 'distance_to_bus_stop')->textInput(['style'=>'width:100px;']) ?>
    </div>
</div>
<div class="row">
    <div>
    <h2 style="color: #1b6d85">Дополнительная информация</h2>
    </div>
</div>
        <?= $form->field($model, 'desc')->textarea(['maxlength' => true, 'rows' => `5`, 'autoSize'=> true,'style' => 'max-width:100%; min-width:100%;'
        ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Добавить обьект', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
