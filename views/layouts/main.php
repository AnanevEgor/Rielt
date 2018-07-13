<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\widgets\LoginFormWidget;
use app\widgets\CityFormWidget;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php if (Yii::$app->user->isGuest) { echo LoginFormWidget::widget([]); } ?>
<?php if (Yii::$app->request->pathInfo == 'object/create') { echo CityFormWidget::widget([]); } ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' =>Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);



    if (Yii::$app->user->isGuest) {

        $menuItems[] = ['label' => 'Войти', 'url' => '#', 'options' => ['data-toggle' => 'modal', 'data-target' => '#login-modal']];
    } else {
    if (Yii::$app->user->identity->id === 3 && Yii::$app->user->identity->username === 'admin') {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
    }
        $menuItems[] = ['label' => 'Поиск по термам', 'url' => ['/site/search-for-term']];
        $menuItems[] = ['label' => 'Обьекты', 'url' => ['/object/index']];
        $menuItems[] = ['label' => 'Лингвистические термы', 'url' => ['/ling-term/index']];
        $menuItems[] = ['label' => 'Улицы', 'url' => ['/streets/index']];
        $menuItems[] = ['label' => 'Города', 'url' => ['/cities/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->fio . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
