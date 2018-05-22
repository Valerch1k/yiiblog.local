<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->title = $category->title;
 $this->params['breadcrumbs'][] = ['label' =>$category->title, 'url' => [Url::toRoute(['site/categories', 'id' =>$category->id])]];
?>
<!-- Right Main Content -->
<div class="col-md-9 m-right">

    <!-- Page Header -->
    <div class="row" data-animated="0">
        <div class="col-md-12">
            <div id="page-header">
                <h3><span>Blog</span></h3>
                <?=Breadcrumbs::widget(['options' => ['class' =>'bread_crumbs'],'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);?>
            </div>
        </div>
    </div>

<!-- Blog Post Content -->
<div class="row" data-animated="0">
    <div class="col-md-12">
        <div id="m-blog-content">
            <div class="row">
                <? foreach($article as $article):?>
                <div class="col-md-6" data-animated="0">
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
                </div>
                <? endforeach;?>


                <div class="page-nav" data-animated="0">
                    <?
                    // отображаем ссылки на страницы - пагинация
                    echo LinkPager::widget([
                        'pagination' => $pages,
                        'nextPageLabel' => false,         // »
                        'prevPageLabel' => false,         // «
                        'lastPageLabel' => false,  // »»
                        'firstPageLabel' => false, // ««
                        'options' => [
                            '' => 'span',
                        ],

                    ]);
                    ?>
<!---->
<!--                    <ul>-->
<!--                        <li class="active"><a href="#"><span>1</span></a></li>-->
<!--                        <li><a href="#"><span>2</span></a></li>-->
<!--                        <li><a href="#"><span>3</span></a></li>-->
<!--                    </ul>-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Post Content -->
