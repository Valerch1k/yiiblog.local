<?php

/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' =>$article->category->title, 'url' => [Url::toRoute(['site/categories', 'id' =>$article->category->id])]];
$this->params['breadcrumbs'][] = ['label' =>$article->title];
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
                    <div class="col-md-12">
                        <article class="item">
                            <div class="mb-thumb">
                                <img src="<?=$article->getImage();?>" class="img-responsive" alt=""/>
                                <div class="date"><?=$article->getDate();?></div>
                            </div>
                            <h4><?=$article->title?></h4>
                            <div class="blog-meta">
                                <span><i class="fa fa-comments"></i><?=$article->getCountComment();?> комментарий</span>
                                <span><i class="fa fa-user"></i><?= $article->user->name?></span>
                            </div>
                            <div class="center-block">
                                <br>
                                <?php foreach($tags as $tag) : ?>
                                    <a href="<?=Url::toRoute(['site/tags', 'id' =>$tag->id]);?>" class="btn-default"> <?= $tag->title;?></a>
                                <?php endforeach; ?>
                            </div>
                            <br>

                            <?=$article->content;?>

                            <!-- Comments -->
                            <div class="comments-wrap" data-animated="0">
                                <? if(!empty($comments)):?>
                                    <h5><?=$article->getCountComment();?> комментарий</h5>
                                    <ul>
                                        <? foreach($comments as $comment):?>
                                            <li>
                                                <img src="<?=$comment->user->getImage();?>" width="80" height="80" alt=""/>
                                                <div class="comments-inner">
                                                    <div class="comment-author"><?=$comment->user->name;?> <span>добавить дату</span></div>
                                                    <p><?=$comment->text;?></p>
                                                </div>
                                            </li>
                                        <? endforeach;?>
                                    </ul>

                                <? else:?>
                                    <h5>Комментариев к этой статьи нет , будьте первым!)</h5>
                                <? endif;?>
                            </div>
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
                            <div class="article-comment-form" data-animated="0">
                                <? if (!Yii::$app->user->isGuest):?>
                                    <h5>Оставить комментарий</h5>
                                        <?$form = ActiveForm::begin([
                                            'enableAjaxValidation' => true,
                                            'action'=>['site/comment', 'id'=>$article->id]
                                        ])?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?= $form->field($commentForm, 'message',['template' =>'{input}{error}'])->textarea(['placeholder' => 'Комментарий'])?>
                                                <?if (isset($errors) && is_array($errors)){echo $errors['message'][0];}?>
                                                <button type="submit">Отправить</button>
                                            </div>
                                        </div>
                                        <?php ActiveForm::end() ?>
                                <? else:?>
                                    <h5>Зарегестрируйтесь или войдите на сайт, чтобы оставлять комментарии!</h5>
                                <? endif;?>

                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Post Content -->
			