<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TblPakaian $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-pakaian-form">
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],'fieldConfig' => ['template' => '{label}{input}'], 'enableClientValidation' => false]); ?>
    
    <?php if($model->hasErrors()) {
        $form->errorSummary($model, ['header' => '<p>Silahkan perbaiki permasalahan berikut:</p>']); ?>
    <?php } ?>

    <?= $form->field($model, 'nama_pakaian')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
    
    <?= $form->field($model, 'id_kategori')->dropDownList($items, ['prompt'=>'Pilih Kategori']) ?>
    
    <?= $form->field($model, 'gambar')->fileInput() ?>
    
    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
    
    <?= $form->field($model, 'harga')->textInput(['autocomplete' => 'off']) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>