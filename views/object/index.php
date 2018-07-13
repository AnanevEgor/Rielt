<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Cities;
use app\models\Streets;
use app\controllers\ObjectController;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обьекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="object-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить обьект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [

            [
                'attribute'=>'id_city',
                'filter'=> Html::activeDropDownList($searchModel, 'id_city',
                    Cities::dropdown(),
                    [
                            'style'=>'width:300px',
                        'class'=> 'form-control',
                        'prompt' => 'Выберите город',
                        'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl('object/list-streets?id=').'"+$(this).val(), 
          function(data) {$("select#id_street").html(data);})',
                    ]),
                'value' => 'city.name',

            ],

            [
              'attribute'=>'id_street',
              'filter'=> Html::activeDropDownList($searchModel, 'id_street', Streets::ListStreets($searchModel->id_city),
                   [ 'style'=>'width:300px',
                           'class'=> 'form-control', 'id' => 'id_street'
                 ]),
                'value' => 'street.name',
            ],

            ['attribute'=>'num_house',
                'headerOptions'=>['style'=>'width:50px'],
                ],
            //'ldg',
            //'type_tread',
            //'price',
            //'size_amount',
            //'size_life',
            //'size_kitchen',
            //'floor',
            //'home_floors',
            //'num_bathroom',
            //'type_bathroom',
            //'amount_room',
            //'elevator',
            //'distance_to_sea',
            //'distance_to_beach',
            //'distance_to_shop',
            //'distance_to_bus_stop',
            //'distance_school',
            //'hight_on_sea',
            //'viev_of_sea',
            //'desc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
