<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TblKategori $model */

$this->title = 'Tambah Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-kategori-create card">

    <div class="card-header alert alert-primary">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="card-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div>

</div>
