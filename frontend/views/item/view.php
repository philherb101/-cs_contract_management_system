<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Item $model */

$this->title = $model->size;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'master_activity_code',
                'label' => 'Activity',
                'value' => $model->masterActivityCode->activity_name,
            ],
            [
                'attribute' => 'item_type_id',
                'label' => 'Item Type',
                'value' => $model->itemType->type_name,
            ],
            'size',
            'class',
            'description:ntext',

        ],
    ]) ?>

</div>
