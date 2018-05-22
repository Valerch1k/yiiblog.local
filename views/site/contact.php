<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Page Header -->
<div class="row">
    <div class="col-md-12">
        <div id="page-header" data-animated="0">
            <h3><span>Contact Us</span></h3>
            <ul class="bread_crumbs">
                <li><a href="#">home</a></li>
                <li>contact</li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact Content -->
<div class="row">
    <div class="col-md-12">
        <div id="contact-form" >
            <div class="row">

                <!-- Google Map -->
                <div class="col-md-6" data-animated="0">
                    <div class="map">
                        <div class="gmap">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-md-6" data-animated="0">
                    <h3>Send us a message</h3>

                    <form class="contact-form" data-animated="0" id="contactForm" action="php/contact.php" method="post">
                        <div class="mc-name">
                            <input type="text" name="senderName" id="senderName" placeholder="name" Required>
                            <span><i class="fa fa-user"></i></span>
                        </div>
                        <div class="mc-email">
                            <input type="email" name="senderEmail" id="senderEmail" placeholder="Email Address" Required>
                            <span><i class="fa fa-envelope-o"></i></span>
                        </div>
                        <div class="mc-website">
                            <input type="text" name="subject" id="subject" placeholder="subject">
                            <span><i class="fa fa-link"></i></span>
                        </div>
                        <div class="mc-message">
                            <textarea name="message" id="message" placeholder="Message" Required></textarea>
                            <button type="submit"><span>Send</span></button>
                        </div>
                    </form>
                    <div id="successMessage" class="successmessage">
                        <p><span class="success-ico"></span> Thanks for sending your message! We'll get back to you shortly.</p>
                    </div>
                    <div id="failureMessage" class="errormessage">
                        <p><span class="error-ico"></span> There was a problem sending your message. Please try again.</p>
                    </div>
                    <div id="incompleteMessage" class="statusMessage">
                        <p>Please complete all the fields in the form before sending.</p>
                    </div>

                </div>
            </div>

            <!-- Contact Info -->
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 cf-info" data-animated="0">
                        <h3>Contact Info</h3>
                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris morbi accumsan ipsum velit. Nam nec tellus a odio.</p>
                        <ul>
                            <li>
                                <span><i class="fa fa-home"></i></span>
                                <h5>lorem ipsum street</h5>
                            </li>
                            <li>
                                <span><i class="fa fa-phone"></i></span>
                                <h5>+399 (500) 321 9548</h5>
                            </li>
                            <li>
                                <span><i class="fa fa-envelope"></i></span>
                                <h5>info@domain.com</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Content -->
