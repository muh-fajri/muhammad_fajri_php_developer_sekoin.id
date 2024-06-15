<?php

namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => '{attribute} tidak boleh kosong.'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'tooShort' => '{attribute} harus minimal 8 karakter.'],
            ['password', 'passwordCriteria'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Kata Sandi',
        ];
    }

    public function passwordCriteria()
    {
        if(!empty($this->password) && ($this->password)>=8) {
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
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();

        return $user->save(false);
    }
}
