<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \app\models\LingVar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LingTermSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лингвистические термы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ling-term-index">

    <h2>Лингвистические термы</h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить терму', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute'=>'id_ling_var',
                'filter'=> Html::activeDropDownList($searchModel, 'id_ling_var',
                    LingVar::dropdown(),
                    [
                        'style'=>'width:300px',
                        'class'=> 'form-control',
                        'prompt' => 'Выберите переменную',
                    ]),
                'value' => 'lingVar.name',

            ],
            [
                'attribute'=>'id_fun_own',
                'label'=>'Функция принадлежности',
                'value' => 'funcOwn.name',

            ],

            'a',
            'b',
            'c',
            'd',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
