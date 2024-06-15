<?php

use common\models\TblKategori;
use common\models\TblPakaian;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Produk Pakaian';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tbl-pakaian-index card">

    <div class="card-header alert alert-primary">
        <h4><?= Html::encode($this->title) ?>
            <span class="float-right">
                <?= Html::a('Tambah Pakaian', ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
            </span>
        </h4>
    </div>

    <div class="card-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_pakaian',
            'tblKategori.nama_kategori',
            [
                'attribute' => 'gambar',
                'format' => ['image', ['width'=>'100']],
                'value' => function($model) { return $model->urlgambar; },
            ],
            [
                'header' => 'Aksi',
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblPakaian $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>
    </div>

</div>
