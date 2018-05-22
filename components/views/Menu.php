<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;

$this->params['breadcrumbs'][] = [
    'template' => "<li>{link}</li>", //  шаблон для этой ссылки
];
?>

<!-- Fixed Left Navigaton -->
<div class="col-md-3 m-left">

    <!-- Navmenu -->
    <header>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=Yii::$app->homeUrl?>"><img src="../public/img/logo.png" class="img-responsive" alt=""/></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right menu-effect">
                    <!--   меню     Главная  -->
                    <li class=" <? if($controller.'/'.$action == 'site/index') { echo 'current'; };?> "><a href="<?=Yii::$app->homeUrl?>" data-hover="Главная">Главная</a></li>
                    <!--   меню - вывод категорий блога   -->
                    <? foreach($categories as $item):?>
                         <li class="<? if($id == $item->id) { echo 'current'; };?>"><a href="<?=Url::toRoute(['site/categories', 'id' =>$item->id]);?>" data-hover="<?=$item->title;?>"><?=$item->title;?></a></li>
                    <? endforeach;?>
                    <!-- меню  Контакты   -->
                    <li class="<? if($action == 'contact') { echo 'current'; };?>"><a href="<?= Url::toRoute('/site/contact')?>" data-hover="Контакты">Контакты</a></li>

                    <? if (!Yii::$app->user->isGuest):?>
                        <li class="<? if($action == 'login') { echo 'current'; };?>"><a href="<?= Url::toRoute('/auth/logout')?>">Выйти(<?= Yii::$app->user->identity->name?>)</a></li>
                    <? else:?>
                    <li class="<? if($action == 'login') { echo 'current'; };?>"><a href="<?= Url::toRoute('/auth/login')?>" data-hover="Войти">Войти</a></li>
                    <? endif;?>

                </ul>
            </div>
        </nav>
        <!-- Navmenu -->

        <!-- Hidden Content -->
        <div class="m-header">
            <ul class="mh-social">
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
            </ul>
            <p class="mh-copy">&copy; 2014 Momental, All Rights Reserved</p>
        </div>
        <div class="m-hide"><i class="fa fa-plus-circle"></i></div>
        <!-- Hidden Content -->

    </header>
</div>
<!-- Fixed Left Navigaton - END -->
