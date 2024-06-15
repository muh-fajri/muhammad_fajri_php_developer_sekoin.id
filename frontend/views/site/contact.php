<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Kontak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="mt-5 offset-lg-3 col-lg-6">

        <div class="card-header alert alert-warning text-center">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Jika ada keperluan bisnis atau pun pertanyaan yang lain, silahkan lengkapi formulir berikut untuk menghubungi kami. Terima kasih.</p>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'subject') ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-warning', 'name' => 'contact-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    
    </div>
</div>
