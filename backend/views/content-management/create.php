<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContentManagement */

$this->title = 'Add Content Management';
$this->params['breadcrumbs'][] = ['label' => 'Content Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-management-create">

    <?= $this->render('_form', [
        'model' => $model,
        'token_name' => $token_name,
    ]) ?>

</div>
s