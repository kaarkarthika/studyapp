<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EventCategoryManagement */

$this->title = 'Add Chapter';
$this->params['breadcrumbs'][] = ['label' => 'Chapter Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chapter-management-create">

<!--     <h1><?//= Html::encode($this->title) ?></h1>
 -->
    <?= $this->render('_form', [
        'model' => $model,
        'token_name' => $token_name,
    ]) ?>

</div>
