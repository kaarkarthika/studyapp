<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserManagement */

//$this->title = 'Update User Management: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-management-update">

<!--     <h1><?//= Html::encode($this->title) ?></h1>
 -->
    <?= $this->render('_form', [
        'model' => $model,
        'token_name' => $token_name,
    ]) ?>

</div>
