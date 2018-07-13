<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

Modal::begin([
    'header'=>'<h4>Вход</h4>',
    'id'=>'login-modal',
]);
?>


<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'action' => ['site/login']
]);
echo $form->field($model, 'email')->textInput()->label('Почта');
echo $form->field($model, 'password')->passwordInput()->label('Пароль');
echo $form->field($model, 'rememberMe')->checkbox()->label('Запомнить');
?>

    <div>
        Если забыли пороль <?= Html::a('нажмите сюда', ['site/request-password-reset']) ?>.
    </div>
    <div class="form-group">
        <div class="text-right">

            <?php
            echo Html::button('Отмена', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
            echo Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']);
            ?>

        </div>
    </div>

<?php
ActiveForm::end();
Modal::end();