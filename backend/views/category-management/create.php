<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EventCategoryManagement */

$this->title = 'Add Category';
$this->params['breadcrumbs'][] = ['label' => 'Category Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-management-create">

<!--     <h1><?//= Html::encode($this->title) ?></h1>
 -->
    <?= $this->render('_form', [
        'model' => $model,
        'token_name' => $token_name,
    ]) ?>

</div>
