<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LingTerm */

$this->title = 'Добавление новой термы';
$this->params['breadcrumbs'][] = ['label' => 'Лингвистическая терма', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ling-term-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
