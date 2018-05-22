<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Right Main Content -->
<div class="col-md-9 m-right">

    <!-- Page Header -->
    <div class="row" data-animated="0">
        <div class="col-md-12">
            <div id="page-header">
                <h3><span><?=$this->title?></span></h3>
                <?=Breadcrumbs::widget(['options' => ['class' =>'bread_crumbs'],'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);?>
            </div>
        </div>
    </div>

    <!-- Blog Post Content -->
    <div class="row" data-animated="0">
        <div class="col-md-12 ">
            <div  id="m-blog-content">
                <div class="article-comment-form" data-animated="0">
                    <div class="row ">
                        <?$form = ActiveForm::begin([
                            'enableAjaxValidation' => true,
                        ])?>
                            <div class="col-md-6 center-block">
                                <span><i class="fa fa-link"></i></span>
                                <?= $form->field($model,'email',['template' =>'{input}{error}'])->input('email',['placeholder' => 'E-mail']) ?>
                                <?if (isset($errors) && is_array($errors)){echo $errors['email'][0];}?>
                                <span><i class="fa fa-envelope-o"></i></span>
                                <?= $form->field($model, 'password',['template' =>'{input}{error}'])->passwordInput(['placeholder' => 'Пароль']) ?>
                                <?if (isset($errors) && is_array($errors)){echo $errors['password'][0];}?>
                                <?= Html::submitButton('Войти на сайт', ['name' => 'login-button']) ?>
                                <br>
                                <br>
                                <a href="<?= Url::toRoute('/auth/signup')?>" class="btn-default btn-center" >Регистрация</a>
                            </div>

                        <?php ActiveForm::end() ?>

                    </div>
                </div>
            </div>
        </div>
    </div>






    <!-- Blog Post Content -->
<!--    --><?php //$form = ActiveForm::begin([
//        'id' => 'login-form',
//        'layout' => 'horizontal',
//        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 control-label'],
//        ],
//    ]); ?>
<!---->
<!--        --><?//= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
<!---->
<!--        --><?//= $form->field($model, 'password')->passwordInput() ?>
<!---->
<!--        --><?//= $form->field($model, 'rememberMe')->checkbox([
//            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
//        ]) ?>
<!---->
<!--        <div class="form-group">-->
<!--            <div class="col-lg-offset-1 col-lg-11">-->
<!--                --><?//= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    --><?php //ActiveForm::end(); ?>


