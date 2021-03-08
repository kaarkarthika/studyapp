<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentManagementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-management-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'auto_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'sub_category_id') ?>

    <?= $form->field($model, 'chapter_id') ?>

    <?= $form->field($model, 'option_key') ?>

    <?php // echo $form->field($model, 'upload_link') ?>

    <?php // echo $form->field($model, 'upload_file') ?>

    <?php // echo $form->field($model, 'upload_video') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
