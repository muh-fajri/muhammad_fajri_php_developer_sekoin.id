<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username dan password diperlukan
            [['username', 'password'], 'required', 'message' => '{attribute} tidak boleh kosong.'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'tooShort' => '{attribute} minimal harus 8 karakter.'],
            // password is validated by validatePassword()
            ['password', 'passwordCriteria'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Nama Pengguna',
            'password' => 'Kata Sandi',
            'rememberMe' => 'Ingat Saya',
        ];
    }

    public function passwordCriteria()
    {
        if(!empty($this->password)) {
            if(!preg_match('/[0-9]/', $this->password)) {
                $this->addError('password', 'Kata sandi harus memuat 1 angka.');
            }
            if(!preg_match('/[a-z]/', $this->password)) {
                $this->addError('password', 'Kata sandi harus memuat 1 huruf kecil.');
            }
            if(!preg_match('/[A-Z]/', $this->password)) {
                $this->addError('password', 'Kata sandi harus memuat 1 huruf besar.');
            }
        }
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        $model = new \common\models\LoginForm;

        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, $model->getAttributeLabel('username').' atau '.$model->getAttributeLabel('password').' salah.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
