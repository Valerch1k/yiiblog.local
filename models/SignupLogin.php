<?php
/**
 * Created by PhpStorm.
 * User: Loner
 * Date: 02.12.2017
 * Time: 13:10
 */

namespace app\models;
use Yii;
use yii\base\Model;

class SignupLogin extends Model
{
    public $name;
    public $email;
    public $password;
    public $_password;
    public $verifyCode;

    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password','name','_password'], 'required', 'message' => 'Обязательные поля !'],
            ['name','string'],
            ['email','email'],
            ['email','unique','targetClass'=>'app\models\User','targetAttribute'=>'email','message' => 'Пользователь с таким Email уже существует !'],
            [['password','_password'],'equallyPassword'],
            ['verifyCode', 'captcha'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public  function equallyPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password <> $this->_password)
                $this->addError($attribute, 'Пароли не совпадают !!!.');
        }
    }

    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }

}