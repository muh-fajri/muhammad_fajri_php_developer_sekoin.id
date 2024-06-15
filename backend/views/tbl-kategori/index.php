<?php

use common\models\TblKategori;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-kategori-index card">

    <div class="card-header alert alert-primary">
        <h4><?= Html::encode($this->title) ?>
        <span class="float-right"><?= Html::a('Tambah Item', ['create'], ['class' => 'btn btn-sm btn-primary']) ?></h4>
    </div>
    <div class="card-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama_kategori',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblKategori $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    </div>

</div>


</div>
