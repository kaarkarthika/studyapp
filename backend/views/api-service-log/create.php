<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ApiServiceLog */

$this->title = 'Create Api Service Log';
$this->params['breadcrumbs'][] = ['label' => 'Api Service Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-service-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
