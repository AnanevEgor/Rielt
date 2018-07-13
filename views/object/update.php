<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Object */

$this->title = 'Изменение обьекта: '.$model->city->name.'  '.$model->street->name.'  '.$model->num_house.' ';
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="object-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
