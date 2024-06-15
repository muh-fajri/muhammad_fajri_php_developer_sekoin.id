<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\TblPakaian $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Pakaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-pakaian-view card">

    <div class="card-header alert alert-primary">
        <h4><?= Html::encode($this->title) ?>
            <span class="float-right">
                <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-warning']) ?>
                <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Ingin menghapus item "'.$model->nama_pakaian.'"?',
                        'method' => 'post',
                    ],
                ]) ?>
            </span>
        </h4>
    </div>
    <div class="card-body">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nama_pakaian',
                'tblKategori.nama_kategori',
                [
                    'attribute' => 'gambar',
                    'format' => ['image', ['width'=>'100']],
                    'value' => function($model) { return $model->urlgambar; },
                ],
                'deskripsi',
                'harga',
            ],
        ]) ?>

    </div>

</div>
