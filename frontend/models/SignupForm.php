<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // filter inputan kosong
            [['username', 'email', 'password'], 'required', 'message' => '{attribute} tidak boleh kosong.'],

            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '{attribute} ini sudah terdaftar.'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => '{attribute} minimal harus 2 karakter.'],

            ['email', 'trim'],
            ['email', 'email', 'message' => 'Bukan alamat {attribute} yang valid.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Alamat {attribute} ini sudah terdaftar.'],

            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'tooShort' => '{attribute} minimal harus 8 karakter.'],
            ['password', 'passwordCriteria'],
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

    public function attributeLabels()
    {
        return [
            'username' => 'Nama Pengguna',
            'email' => 'E-mail',
            'password' => 'Kata Sandi',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
