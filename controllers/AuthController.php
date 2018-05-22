<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.11.2017
 * Time: 20:51
 */

namespace app\controllers;

use app\models\SignupLogin;
use yii\web\Controller;
use app\models\LoginForm;
use Yii;

class AuthController extends Controller
{

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupLogin();
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->signup())
            {
                return $this->redirect(['auth/login']);
            }
        }

        return $this->render('signup',[
            'model' => $model,
            ]);
    }

}