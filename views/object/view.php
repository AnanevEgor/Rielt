<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Object */

$this->title = ''.$model->city->name.'  '.$model->street->name.'  '.$model->num_house.' ';
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

?>
<div class="object-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить объект?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => "<tr><th style='width:30%'>{label}</th><td style='width:70%'>{value}</td></tr>",
        'attributes' => [

            ['attribute' =>'id_city',
                'value' => $model->city->name,],
            ['attribute'=>'id_street',
                'value' => $model->street->name,],
            'num_house',
            ['attribute'=>'type_tread',
                'value' =>  function($model) {
                    if ($model->type_tread == 0) {
                        return 'Продажа';
                    }

                    return 'Сдача';
                }],

            'price',
            'size_amount',
            'size_life',
            'size_kitchen',
            'floor',
            'home_floors',
            'num_bathroom',
            ['attribute'=>'type_bathroom',
                'value' =>  function($model) {
                    switch ($model->type_bathroom) {
                        case 0:
                            return 'Раздельный';
                            break;
                        case 1:
                            return 'Совмещенный';
                            break;
                        case 2:
                            return 'И совмещенный и раздельный';
                            break;
                    }
                }],
            'amount_room',
            ['attribute'=>'elevator',
                'value' =>  function($model) {
        switch ($model->elevator) {
                        case 0:
                            return 'Отсутствует';
                            break;
                        case 1:
                           return 'есть, только пассажирский';
                            break;
                        case 2:
                           return 'есть грузовой';
                            break;
                    }
                }],
            'distance_to_sea',
            'distance_to_beach',
            'distance_to_shop',
            'distance_to_bus_stop',
            'distance_school',
            'hight_on_sea',
            ['attribute'=>'viev_of_sea',
                'value' =>  function($model) {
                    if ($model->viev_of_sea == 0) {
                        return 'Нет';
                    }
                    return 'Есть';
                }],
          /*  ['attribute'=>'desc',
                'label'=>'Дополнительная информация',
                ],*/


        ],

    ]) ?>
    <?php $form = ActiveForm::begin(); ?>
    <h2>Дополнительная информация</h2>
    <?= $form->field($model, 'desc')->textarea(['maxlength' => true, 'rows' => `5`, 'autoSize'=> true,'style' => 'max-width:100%; min-width:100%;'
    ]) ?>
    <?php ActiveForm::end(); ?>
</div>

