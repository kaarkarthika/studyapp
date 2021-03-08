<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentManagement */

$this->title = 'Update Content Management';
$this->params['breadcrumbs'][] = ['label' => 'Content Management', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->auto_id, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content-management-update">

    <?= $this->render('_videoform', [
        'model' => $model,
        'token_name' => $token_name,
    ]) ?>

</div>
