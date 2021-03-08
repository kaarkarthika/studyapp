<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserManagement */

//$this->title = 'User Management';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-management-create">

<!--     <h1><?//= Html::encode($this->title) ?></h1>
 -->
    <?= $this->render('_form', [
        'model' => $model,
        'token_name' => $token_name,

    ]) ?>

</div>
