<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ApiServiceLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Api Service Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-service-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Api Service Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'autoid',
            'request_data:ntext',
            'event_key',
            'response_data:ntext',
            'status',
            //'created_at',
            //'modified_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
