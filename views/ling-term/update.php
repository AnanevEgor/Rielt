<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LingTerm */

$this->title = 'Update Ling Term: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Изменить', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="ling-term-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
