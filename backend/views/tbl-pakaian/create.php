<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TblPakaian $model */

$this->title = 'Tambah Pakaian';
$this->params['breadcrumbs'][] = ['label' => 'Pakaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-pakaian-create card">

    <div class="card-header alert alert-primary">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="card-body">

        <?= $this->render('_form', [
            'model' => $model,
            'items' => $items,
        ]); ?>
    
    </div>

</div>
