<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserManagementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-management-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'auto_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'mobile_number') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'email_id') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
