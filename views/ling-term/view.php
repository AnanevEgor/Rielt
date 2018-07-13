<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LingTerm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Лингвистическая терма', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ling-term-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'id_func_own',
            'id_ling_var',
            'a',
            'b',
            'c',
            'd',
        ],
    ]) ?>

</div>
