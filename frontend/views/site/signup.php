<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Daftar Tamu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="mt-5 offset-lg-3 col-lg-6">

        <div class="card-header alert alert-warning text-center">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Daftarkan diri agar dapat masuk ke dalam sistem.</p>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'fieldConfig' => ['template' => '{label}{input}'], 'enableClientValidation' => false]); ?>

                        <?php if($model->hasErrors()) { ?>
                            <?= $form->errorSummary($model, ['header' => '<p>Silahkan perbaiki permasalahan berikut:</p>']); ?>
                        <?php } ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>

                        <?= $form->field($model, 'email')->textInput(['autocomplete' => 'off']) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Daftar', ['class' => 'btn btn-warning', 'name' => 'signup-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
