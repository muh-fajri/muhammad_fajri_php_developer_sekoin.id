<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Masuk Tamu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">

        <div class="card-header alert alert-warning text-center">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Gunakan kredensial untuk masuk ke sistem.</p>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'fieldConfig' => ['template' => '{label}{input}'], 'enableClientValidation' => false]); ?>
            
                        <?php if($model->hasErrors()) { ?>
                            <?= $form->errorSummary($model, ['header' => '<p>Silahkan perbaiki permasalahan berikut:</p>']); ?>
                        <?php } ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div style="color:#999;margin:1em 0">
                            Lupa kata sandi? <?= Html::a('Atur Ulang', ['site/request-password-reset']) ?>.
                            <br>
                            <!-- Verifikasi ulang email? <?= Html::a('Kirim ulang', ['site/resend-verification-email']) ?>. -->
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Masuk', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>

    </div>
</div>
