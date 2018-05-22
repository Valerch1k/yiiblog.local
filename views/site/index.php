<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>
<!-- Intro Slider -->
<div class="row" data-animated="0">
    <div class="col-md-12">
        <div id="intro">
            <div id="intro-slider" class="owl-carousel owl-theme">
                <div class="item"><img src="../public/img/slider/intro/1.jpg" class="img-responsive" alt=""></div>
                <div class="item"><img src="../public/img/slider/intro/2.jpg" class="img-responsive" alt=""></div>
                <div class="item"><img src="../public/img/slider/intro/3.jpg" class="img-responsive" alt=""></div>
            </div>
        </div>
    </div>
</div>

<!-- Новые статьи -->
<div class="row">
    <div class="col-md-12">
        <div id="m-portfolio" data-animated="0">
            <h3>Новые статьи</h3>
            <div class="row">
            <? foreach($articleIsNew as $article):?>
                <div class="col-md-4" data-animated="0">
                    <div class="mp-thumb">
                        <?= Html::img($article->getImage(), ['width' => 239.98,'height'=>172.98,'class'=>'img-responsive'])?>
                        <div class="overlay1">
                            <h4><?=$article->title?></h4>
                        </div>
                        <div class="overlay1-hr">
                            <a href="<?=Url::toRoute(['site/view', 'id' =>$article->id]);?>" class="link"><i class="fa fa-file-text-o"></i></a>
                            <a href="<?= $article->getImage();?>" class="prettyPhoto zoom"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
             <? endforeach;?>
            </div>
            <?
            // отображаем ссылки на страницы - пагинация
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>
    </div>
</div>
<!-- Популярные статьи Slider -->
<div class="row">
    <div class="col-md-12">
        <div id="blog" data-animated="0">
            <h3>Популярные статьи</h3>
            <div id="m-blog" class="owl-carousel owl-theme">
                <? foreach($articleIsPopular as $article):?>
                    <div class="item">
                        <div class="mb-thumb">
                            <img src="<?= $article->getImage();?>" class="img-responsive" alt=""/>
                            <div class="date"><?=$article->getDate();?></div>
                            <span class="rmore"><a href="<?=Url::toRoute(['site/view', 'id' =>$article->id]);?>">Читать больше</a></span>
                        </div>
                        <h4><a href="<?=Url::toRoute(['site/view', 'id' =>$article->id]);?>"><?= $article->title?></a></h4>
                        <div class="blog-meta">
                            <span><i class="fa fa-comments"></i><?=$article->getCountComment();?> комментарий</span>
                            <span><i class="fa fa-user"></i><?= $article->user->name?></span>
                        </div>
                        <p><?=$article->description?></p>
                    </div>
                <? endforeach;?>
            </div>
        </div>
    </div>
</div>
