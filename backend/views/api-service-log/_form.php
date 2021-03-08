<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ApiServiceLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="api-service-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'request_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'event_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'response_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'A' => 'A', 'I' => 'I', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'modified_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
