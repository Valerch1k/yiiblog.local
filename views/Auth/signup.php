<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\captcha\Captcha;

$this->title = 'Регистрация';
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
                            'id' => 'signup-form',
                            'enableAjaxValidation' => true,
                        ])?>
                        <div class="col-md-6 center-block">
                            <span><i class="fa fa-user"></i></span>
                            <?= $form->field($model,'name',['template' =>"{input}{error}"])->input('username',['placeholder' => 'Ф.И.О']) ?>
                            <span><i class="fa fa-link"></i></span>
                            <?= $form->field($model,'email',['template' =>'{input}{error}'])->input('email',['placeholder' => 'E-mail']) ?>
                            <?if (isset($errors) && is_array($errors)){echo $errors['email'][0];}?>
                            <span><i class="fa fa-envelope-o"></i></span>
                            <?= $form->field($model, '_password',['template' =>'{input}{error}'])->passwordInput(['placeholder' => 'Пароль']) ?>
                            <span><i class="fa fa-envelope-o"></i></span>
                            <?= $form->field($model, 'password',['template' =>'{input}{error}'])->passwordInput(['placeholder' => 'Повторите пароль']) ?>
                            <?if (isset($errors) && is_array($errors)){echo $errors['password'][0];}?>
                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ])->label("Введите слово на картинке") ?>
                            <?= Html::submitButton('Войти на сайт', ['name' => 'login-button']) ?>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

