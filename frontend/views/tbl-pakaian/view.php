<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\TblPakaian $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produk Pakaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-pakaian-view card">

    <div class="card-header alert alert-warning">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="card-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_pakaian',
            'id_kategori',
            'gambar',
            'deskripsi',
            'harga',
        ],
    ]) ?>

</div>
