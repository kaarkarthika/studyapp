<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UserManagement */

?>
<div class="user-management-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'auto_id',
           'first_name', 
            'age',
            'mobile_number',
            'address',
            'email_id:email',
            'password',
            // 'created_at',
            // 'updated_at',
        ],
    ]) ?>

</div>
