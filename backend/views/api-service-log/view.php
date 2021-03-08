<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ApiServiceLog */

$this->title = $model->autoid;
$this->params['breadcrumbs'][] = ['label' => 'Api Service Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-service-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->autoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->autoid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'autoid',
            'request_data:ntext',
            'event_key',
            'response_data:ntext',
            'status',
            'created_at',
            'modified_at',
        ],
    ]) ?>

</div>
