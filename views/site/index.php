<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Поздравляем!</h1>

        <p class="lead">Вы нашли наш сайт.</p>

        <p>
            <?php echo HTML::a('Свяжитесь с нами', 'contact', ['class'=>'btn btn-lg btn-success'] ) ?>
    </div>

    <div class="body-content">

        <img src="http://pokrovsk-rielt64.ru/upload/111111.jpg" style="width:100%; border-radius: 30px">
        <div class="row">
            <div class="col-lg-6">
                <h2>Новые технологии</h2>

                <p>Наша компания использует новый поиск - нечеткий поиск!</p>
                <img src="http://poznayka.org/baza1/52626884899.files/image072.jpg" style="width:100%">
                <a class="btn btn-default" href="https://ru.wikipedia.org/wiki/%D0%9D%D0%B5%D1%87%D1%91%D1%82%D0%BA%D0%B0%D1%8F_%D0%BB%D0%BE%D0%B3%D0%B8%D0%BA%D0%B0">Про нечеткую логику &raquo;</a>
            </div>
            <div class="col-lg-6">
                <h2> Наши риелтеры</h2>

                <p>Наши агенты лучше и быстрее, возможно даже на месте подберут вам жилье</p>

                <img src="http://www.vsem-kvartira.ru/wp-content/uploads/2017/03/rieltor1-768x512.jpg" style="width:100%">
            </div>

        </div>

    </div>
</div>
