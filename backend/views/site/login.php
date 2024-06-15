<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

$this->title = 'Masuk Admin';
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <div class="card">
            <div class="card-header alert alert-primary text-center">
                <h1><?= Html::encode($this->title) ?></h1>
                <p>Gunakan kredensial untuk masuk ke sistem.</p>
            </div>
            <div class="card-body">

                <?php $form = ActiveForm::begin(['id' => 'login-form', 'fieldConfig' => ['template' => '{label}{input}'], 'enableClientValidation' => false]); ?>

                <?php if($model->hasErrors()) { ?>
                    <?= $form->errorSummary($model, ['header' => '<p>Silahkan perbaiki permasalahan berikut:</p>']); ?>
                <?php } ?>
            
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group mt-5">
                        <?= Html::submitButton('Masuk', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>
