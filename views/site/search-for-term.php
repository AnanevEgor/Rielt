<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\LingVar;
use yii\helpers\Url;
use app\models\LingTerm;
use app\models\Cities;
use yii\widgets\LinkPager;
use app\models\Streets;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $modelTerms app\models\LingTerm */
/* @var $modelObj app\models\Object */
/* @var $form yii\widgets\ActiveForm */
/* @var $Searchid */
/* @var $objects */
/* @var $pages */

?>
<?php


$script = <<< JS
    $(function(){
        $("button.btn_add").click(function() {
        var row_next = Number.parseInt($(this).val())+1;
        var row_cur = $(this).val();
        $('#row_term_'+row_next).show();
        if(row_cur == 10)
            {
                $('#but_add_str_'+row_next).hide();
            }
        $('#but_add_str_'+row_cur).hide();
         $('#but_del_str_'+row_cur).hide();
         $('#searchtermform-'+row_next+'-activ').val(1);
        });
         $("button.btn_del").click(function() {
        var row_past = Number.parseInt($(this).val())-1;
        var row_cur = $(this).val();
        $('#row_term_'+row_cur).hide();
        $('#but_add_str_'+row_past).show();
        $('#but_del_str_'+row_past).show();
        $('#searchtermform-'+row_cur+'-activ').val(0);
        });
         
    });
JS;
$this->registerJs($script);
?>

<div style="margin-left: 15px; margin-right: 15px">
<div class="row">
    <div class="col-xs-2" style="background-color: #e2e2e2; border-radius: 0.6em; padding-top: 15px; margin-bottom: 10px;">
    <?php $form = ActiveForm::begin(); ?>
<?= $form->field($modelObj, 'type_tread')->dropdownList( ['0' => 'Продажа',
    '2' => 'Сдача',],
    ['style'=>'width:150px;']

) ?>
    </div>
    <div class="col-xs-2" style="background-color: #e2e2e2; border-radius: 0.6em; padding-top: 15px; margin-bottom: 10px;">
        <?= $form->field($modelObj, 'amount_room')->dropdownList( ['0'=>'Все',
                '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',],
            ['style'=>'width:80px;']) ?>
    </div>
</div>

    <div class="row" >

        <div class="col-xs-4" style="background-color: #e2e2e2; border-radius: 0.6em; padding-top: 15px; margin-bottom: 10px;">
            <?= $form->field($modelObj, 'id_city')->dropdownList(Cities::dropdown(),
                ['style'=>'width:300px',
                    'prompt' => 'Выберите город',
                    'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl('object/list-streets?id=').'"+$(this).val(), 
              function(data) {$("select#id_street").html(data);})',
                ])->label(false); ?>
        </div>

        <div class="col-xs-4" style="background-color: #e2e2e2; border-radius: 0.6em; padding-top: 15px; margin-bottom: 10px;">
            <?= $form->field($modelObj, 'id_street')->dropdownList(Streets::dropdown(),
                ['prompt' => 'Выберите улицу','style'=>'width:300px', 'id' => 'id_street'
                ])->label(false);?>
        </div>
    </div>
    <div class="row" >
        <div class="col-xs-2" style="background-color: #e2e2e2; border-radius: 0.6em; padding-top: 15px; margin-bottom: 10px;">
            <?= $form->field($modelObj, 'num_bathroom')->textInput(['style'=>'width:100px;']) ?>
        </div>
        <div class="col-xs-3" style="background-color: #e2e2e2; border-radius: 0.6em; padding-top: 15px; margin-bottom: 10px;">
            <?= $form->field($modelObj, 'type_bathroom')->dropdownList(['3'=>'Не имеет значение',
                    '0' => 'Раздельный',
                '1' => 'Совмещенный',
                '2' => 'И совмещенный и раздельный',],
                ['style'=>'width:250px']) ?>
        </div>


        <div class="col-xs-3" style="background-color: #e2e2e2; border-radius: 0.6em; padding-top: 15px; margin-bottom: 10px;">
            <?= $form->field($modelObj, 'elevator')->dropdownList(['3' => 'Не имеет значение',
                    '0' => 'Отсутствует',
                '1' => 'есть, только пассажирский',
                '2' => 'есть грузовой',
                ],['style'=>'width:250px']) ?>
        </div>
        <div class="col-xs-2" style="background-color: #e2e2e2; border-radius: 0.6em; padding-top: 15px; margin-bottom: 10px;">
        <?= $form->field($modelObj, 'viev_of_sea')->dropdownList(['2'=>'Не имеет значение',
                '0' => 'Нет',
            '1' => 'Есть',],
            ['style'=>'width:150px']) ?>
    </div>

    </div>
</div>

    <div id = 'row_term_0' class="row">
        <div class="col-xs-1">
            <?= $form->field($modelTerms[0], "[0]koef1")->dropdownList([ '0.01'=>'1%',
                '0.05'=>'5%',
                '0.1'=>'10%',
                '0.15'=>'15%',
                '0.2'=>'20%',
                '0.25'=>'25%',
                '0.3'=>'30%',
                '0.35'=>'35%',
                '0.4'=>'40%',
                '0.45'=>'45%',
                '0.5'=>'50%',
                '0.55'=>'55%',
                '0.6'=>'60%',
                '0.65'=>'65%',
                '0.7'=>'70%',
                '0.75'=>'75%',
                '0.8'=>'80%',
                '0.85'=>'85%',
                '0.9'=>'90%',
                '0.95'=>'95%',
                '1'=>'100%',
               ],
                ['style'=>'width:80px',
                    'labelOptions' => [
                        'style' => 'font-size:1px'
                    ]])->label("Мин. принадлеж- ность",['style'=>'text-align:center; width:140px; font-size:12px; height: 60px; ']); ?>
        </div>
        <div class="col-xs-2">

            <?= $form->field($modelTerms[0], "[0]id_ling_var")->dropdownList(LingVar::dropdown(),
                ['style'=>'width:150px',
                    'prompt' => 'Выберите переменную',
                    'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl('site/list-terms?id=').'"+$(this).val(), 
              function(data) {$("select#searchtermform-0-id1").html(data);
              $("select#searchtermform-0-id2").html(data);})',
                ])->label("Лингвистическая переменная",['style'=>'text-align:center; width:140px; font-size:12px; height: 60px']); ?>
        </div>
        <div class="col-xs-1" style="height:114px">
            <?= $form->field($modelTerms[0], "[0]kvant1")->dropdownList([ '0'=>'-',
                '1' => 'не',
                '2' => 'очень',
                '3' => 'более-менее',],
                ['style'=>'width:80px'])->label("Кванити- фикатор",['style'=>'text-align:center; width:140px; font-size:12px; height: 60px']) ?>
        </div>
        <div class="col-xs-2" style="height:114px">
            <?= $form->field( $modelTerms[0], '[0]id1')->dropdownList(LingTerm::dropdown(),
                ['style'=>'width:150px',
                    'prompt' => '-',
                ])->label("Лингвистическая терма №1",['style'=>'text-align:center; width:140px; font-size:12px; height: 60px']);?>
        </div>
        <div class="col-xs-1" style="height:114px">
            <?= $form->field($modelTerms[0], "[0]and_or")->dropdownList([ '0'=>'Без',
                '1' => 'и',
                '2' => 'или',],
                ['style'=>'width:80px'])->label("Добавить терму №2 через",['style'=>'text-align:center; width:140px; font-size:12px; height: 60px']) ?>
        </div>
        <div class="col-xs-1">
            <?= $form->field($modelTerms[0], "[0]koef2")->dropdownList([ '0.01'=>'1%',
                '0.05'=>'5%',
                '0.1'=>'10%',
                '0.15'=>'15%',
                '0.2'=>'20%',
                '0.25'=>'25%',
                '0.3'=>'30%',
                '0.35'=>'35%',
                '0.4'=>'40%',
                '0.45'=>'45%',
                '0.5'=>'50%',
                '0.55'=>'55%',
                '0.6'=>'60%',
                '0.65'=>'65%',
                '0.7'=>'70%',
                '0.75'=>'75%',
                '0.8'=>'80%',
                '0.85'=>'85%',
                '0.9'=>'90%',
                '0.95'=>'95%',
                '1'=>'100%',
            ],
                ['style'=>'width:80px',
                    'labelOptions' => [
                        'style' => 'font-size:1px'
                    ]])->label("Мин. принадлеж- ность",['style'=>'text-align:center; width:140px; font-size:12px; height: 60px']); ?>
        </div>
        <div class="col-xs-1" style="height:114px">
            <?= $form->field($modelTerms[0], "[0]kvant2")->dropdownList([ '0'=>'-',
                '1' => 'не',
                '2' => 'очень',
                '3' => 'более-менее',],
                ['style'=>'width:80px'])->label("Кванти- фикатор",['style'=>' text-align:center; width:140px;font-size:12px; height: 60px']) ?>
        </div>
        <div class="col-xs-2" style="height:114px; width:160px ">
            <?= $form->field( $modelTerms[0], '[0]id2')->dropdownList(LingTerm::dropdown(),
                ['style'=>'width:150px',
                    'prompt' => '-',
                ])->label("Лингвистическая терма  №2",['style'=>'text-align:center; width:140px; font-size:12px; height: 60px;']);?>
        </div>
       <div class="col-xs-1" style="height:114px">
           <div hidden="true">;
               <?= $form->field( $modelTerms[0], '[0]activ')->TextInput(['value'=>'1']);?>

           </div>

            <?=
            $g ='';
            if($modelTerms[1]->activ == 1)
            {
               echo  Html::button("+",['class'=>'btn btn-success btn_add','value'=>0,'id'=>'but_add_str_0', 'style'=>"margin-top:65px; left:-10px; display: none",
                ]);
            }else
            {
                echo  Html::button("+",['class'=>'btn btn-success btn_add','value'=>0,'id'=>'but_add_str_0', 'style'=>"margin-top:65px; left:-10px",
                ]);
            }

           ?>
        </div>
    </div>

    <?=
   $j='';
   for ($i=1;$i<12;$i++)
   {
       if($modelTerms[$i]->activ == 1)
       {
           echo "<div id = 'row_term_".$i."' class=\"row\" >";
       }else
       {
           echo "<div id = 'row_term_".$i."' class=\"row\" style = \"display: none\">";
       }


       echo "<div class=\"col-xs-1\">";
       echo $form->field($modelTerms[$i], "[".$i."]koef1")->dropdownList([ '0.01'=>'1%',
                '0.05'=>'5%',
                '0.1'=>'10%',
                '0.15'=>'15%',
                '0.2'=>'20%',
                '0.25'=>'25%',
                '0.3'=>'30%',
                '0.35'=>'35%',
                '0.4'=>'40%',
                '0.45'=>'45%',
                '0.5'=>'50%',
                '0.55'=>'55%',
                '0.6'=>'60%',
                '0.65'=>'65%',
                '0.7'=>'70%',
                '0.75'=>'75%',
                '0.8'=>'80%',
                '0.85'=>'85%',
                '0.9'=>'90%',
                '0.95'=>'95%',
                '1'=>'100%',
            ],
                ['style'=>'width:80px'])->label(false);
       echo "</div>";
       echo "<div class=\"col-xs-2\">";

       echo $form->field($modelTerms[$i], "[".$i."]id_ling_var")->dropdownList(LingVar::dropdown(),
                ['style'=>'width:150px',
                    'prompt' => 'Выберите переменную',
                    'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl('site/list-terms?id=').'"+$(this).val(), 
                      function(data) {$("select#searchtermform-'.$i.'-id1").html(data);
                      $("select#searchtermform-'.$i.'-id2").html(data);})',
                ])->label(false);
       echo "</div>";
       echo "<div class=\"col-xs-1\">";
       echo $form->field($modelTerms[$i], "[".$i."]kvant1")->dropdownList([ '0'=>'-',
                '1' => 'не',
                '2' => 'очень',
                '3' => 'более-менее',],
                ['style'=>'width:80px'])->label(false);
        echo "</div>";
        echo "<div class=\"col-xs-2\">";
        echo    $form->field( $modelTerms[$i], '['.$i.']id1')->dropdownList(LingTerm::dropdown(),
                ['style'=>'width:150px',
                    'prompt' => '-',
                ])->label(false);
        echo "</div>";
       echo " <div class=\"col-xs-1\">";
        echo     $form->field($modelTerms[$i], "[".$i."]and_or")->dropdownList([ '0'=>'Без',
                '1' => 'и',
                '2' => 'или',],
                ['style'=>'width:80px'])->label(false);
        echo "</div>";
       echo "<div class=\"col-xs-1\">";
       echo $form->field($modelTerms[$i], "[".$i."]koef2")->dropdownList([ '0.01'=>'1%',
           '0.05'=>'5%',
           '0.1'=>'10%',
           '0.15'=>'15%',
           '0.2'=>'20%',
           '0.25'=>'25%',
           '0.3'=>'30%',
           '0.35'=>'35%',
           '0.4'=>'40%',
           '0.45'=>'45%',
           '0.5'=>'50%',
           '0.55'=>'55%',
           '0.6'=>'60%',
           '0.65'=>'65%',
           '0.7'=>'70%',
           '0.75'=>'75%',
           '0.8'=>'80%',
           '0.85'=>'85%',
           '0.9'=>'90%',
           '0.95'=>'95%',
           '1'=>'100%',
       ],
           ['style'=>'width:80px'])->label(false);
       echo "</div>";
        echo "<div class=\"col-xs-1\">";
        echo    $form->field($modelTerms[$i], "[".$i."]kvant2")->dropdownList([ '0'=>'-',
                '1' => 'не',
                '2' => 'очень',
                '3' => 'более-менее',],
                ['style'=>'width:80px'])->label(false);
        echo "</div>";
        echo "<div class=\"col-xs-2\" style=\" width:160px \">";
        echo    $form->field( $modelTerms[$i], '['.$i.']id2')->dropdownList(LingTerm::dropdown(),
                ['style'=>'width:150px',
                    'prompt' => '-',
                ])->label(false);
        echo "</div>";

        if($modelTerms[$i+1]->activ == 1 && $i <11)
        {
            echo "<div class=\"col-xs-1\" style=\"width:60px;\">";
            echo Html::button("-",['class'=>'btn btn-danger btn_del','value'=>$i,'id'=>'but_del_str_'.$i,'style'=>'display: none']);
            echo "</div>";

            echo "<div class=\"col-xs-1\" style=\"width:60px;  padding-left: 0 \" >";
            echo Html::button("+",['class'=>'btn btn-success btn_add','value'=>$i,'id'=>'but_add_str_'.$i,'style'=>'display: none']);
            echo "</div>";
        }else{

            echo "<div class=\"col-xs-1\" style=\"width:60px;\" >";
            echo Html::button("-",['class'=>'btn btn-danger btn_del','value'=>$i,'id'=>'but_del_str_'.$i,]);
            echo "</div>";
            if($i == 11)
            {
                echo "<div class=\"col-xs-1\" style=\"width:60px;  padding-left: 0 \"  >";
                echo Html::button("+",['class'=>'btn btn-success btn_add','value'=>$i,'id'=>'but_add_str_'.$i,'style'=>'display: none']);
                echo "</div>";
            }else{
                echo "<div class=\"col-xs-1\" style=\"width:60px;  padding-left: 0 \"  >";
                echo Html::button("+",['class'=>'btn btn-success btn_add','value'=>$i,'id'=>'but_add_str_'.$i,]);
                echo "</div>";
            }

        }

       if($modelTerms[$i]->activ == 1)
       {
           echo "<div hidden=\"true\">";
           echo $form->field( $modelTerms[$i], '['.$i.']activ')->TextInput(['value'=>'1']);
           echo "</div>";
       }else{
           echo "<div hidden=\"true\">";
           echo $form->field( $modelTerms[$i], '['.$i.']activ')->TextInput(['value'=>'0']);
           echo "</div>";
       }





        echo "</div>";
   }
    ?>
        <div class="form-group">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    <?php foreach($objects as $object)
    {
        echo "<div class=\"panel panel-default\" >";
        echo "<a href = \"object/view?id=".$object->id."\" >";
            echo "<div class=\"panel-heading\" style='padding-left: 30px; background-color:#d4d2d6 '>";


                echo "<div class = \"row adress\" style='color: black'>";
                    echo "<div class=\"col-xs-5\">";
                    echo  $object->city->name." ". $object->street->name . " " .  $object->num_house;
                    echo "</div>";

                $mas_lings=array();
                echo "<div class=\"col-xs-6\">";
                for($i = 0; $i<12;$i++)
                {
                    if(!empty($modelTerms[$i]->id_ling_var) && array_intersect($mas_lings,array($modelTerms[$i]->id_ling_var) )==null) {

                        $mas_lings[] = $modelTerms[$i]->id_ling_var;
                        echo "<div>";



                        switch ($modelTerms[$i]->id_ling_var) {
                            case 1:
                                echo " Цена = ".$object->price. " тыс. руб";
                                break;
                            case 2:
                                echo " Площадь кухни = ".$object->size_kitchen." м<sup>2</sup>";
                                break;
                            case 3:
                                echo " Общая площадь = ".$object->size_amount." м<sup>2</sup>";
                                break;
                            case 4:
                                echo " Жилая площадь = ".$object->size_life." м<sup>2</sup>";
                                break;
                            case 5:
                                echo " Расстояние до пляжа = ".$object->distance_to_beach." м";
                                break;
                            case 6:
                                echo " Расстояние до моря = ".$object->distance_to_sea." м";
                                break;
                            case 7:
                                echo " Расстояние до школы = ".$object->distance_school." м";
                                break;
                            case 8:
                                echo " Расстояние до магазина = ".$object->distance_to_shop." м";
                                break;
                            case 9:
                                echo " Высота над уровнем моря = ".$object->hight_on_sea." м";
                                break;
                            case 10:
                                echo " Расстояние до остановки = ".$object->distance_to_bus_stop." м";
                                break;
                            case 11:
                                echo " Этажность здания = ".$object->home_floors." этаж(ей)";
                                break;
                            case 12:
                                echo " Этаж = ".$object->floor." этаж";
                                break;
                        }
                        echo "</div>";
                    }

                } echo "</div>";
                 echo "</div>";
            echo "</div>";
        echo "</a>";
        echo "</div>";
    }?>
        <?= LinkPager::widget([
        'pagination' => $pages,
        ]); ?>
