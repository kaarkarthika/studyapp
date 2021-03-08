<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ApiServiceLog */

$this->title = 'Update Api Service Log: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Api Service Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->autoid, 'url' => ['view', 'id' => $model->autoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="api-service-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
