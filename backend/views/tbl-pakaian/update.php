<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TblPakaian $model */

$this->title = 'Ubah Pakaian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pakaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="tbl-pakaian-update card">

    <div class="card-header alert alert-primary">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="card-body">

        <?= $this->render('_form', [
            'model' => $model,
            'items' => $items,
        ]) ?>

    </div>

</div>
