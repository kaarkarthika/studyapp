<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventCategoryManagement */

//$this->title = 'Update Event Category Management: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sub Category', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->auto_id, 'url' => ['view', 'id' => $model->auto_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sub-category-update">

    <!-- <h1><?//= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'token_name' => $token_name,
    ]) ?>

</div>
