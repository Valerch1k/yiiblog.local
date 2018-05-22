<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\ContactForm;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use app\assets\PublicAsset;
use yii\helpers\Url;
use yii\widgets\LinkPager;
PublicAsset::register($this);

$contact = new ContactForm();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Webfonts -->
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,300,300italic,400italic,500,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,100,100italic,200,300,300italic,400italic,500,700,900' rel='stylesheet' type='text/css'>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--[if lt IE 9]>
    <script src="./public/js/html5shiv.js"></script>
    <script src="./public/js/respond.js"></script>
    <![endif]-->
</head>
<body id="page-top">
<?php $this->beginBody() ?>

<!-- Outer-wrap -->
<div class="outer-wrap" >
    <div class="container">

       <?= \app\components\MenuWidget::widget();?>

        <!-- Right Main Content -->
        <div class="col-md-9 m-right">

            <?=$content?>

            <!-- Footer contact -->
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12" id="m-contact" data-animated="0">
                        <div id="successMessage" class="successmessage">
                            <p><span class="success-ico"></span> Thanks for sending your message! We'll get back to you shortly.</p>
                        </div>
                        <div id="failureMessage" class="errormessage">
                            <p><span class="error-ico"></span> There was a problem sending your message. Please try again.</p>
                        </div>
                        <div id="incompleteMessage" class="statusMessage">
                            <p>Please complete all the fields in the form before sending.</p>
                        </div>

                        <div class="contact-info" data-animated="0">
                            <h4>Contact Info</h4>
                            <ul>
                                <li><i class="fa fa-home"></i> lorem ipsum street</li>
                                <li><i class="fa fa-phone"></i> +399 (500) 321 9548</li>
                                <li><i class="fa fa-envelope"></i> info@domain.com</li>
                            </ul>
                        </div>
                        <div class="flickr-widget" data-animated="0">
                            <h4>Flickr Gallery</h4>
                            <ul id="flickr" class="thumbs"></ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer - copyright -->
            <footer data-animated="0">
                <p>&copy; 2014 Momental. All Rights Reserved</p>
                <a href="#page-top" class="backtotop-icon page-scroll"></a>
            </footer>


        </div>
        <!-- Right Main Content - END -->
    </div>
</div>
<!-- Outer-wrap - END -->

<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
