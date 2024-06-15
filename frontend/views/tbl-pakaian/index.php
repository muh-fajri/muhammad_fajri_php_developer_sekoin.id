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

    <div class="card-header alert alert-warning">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="card-body">

    <?php $pakaian = new TblPakaian; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_pakaian',
            'tblKategori.nama_kategori',
            'gambar',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
            ],
        ],
    ]); ?>

    </div>

</div>