<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\dropDownList;

/* @var $this yii\web\View */
/* @var $model backend\models\Userdetails */
/* @var $form yii\widgets\ActiveForm */
?>

  <?php $form = ActiveForm::begin(); ?>
<div class="box box-primary">
  <div class=" box-header with-border box-header-bg">
    <h3 class="box-title pull-left " >User Details</h3>
   <!-- <div class=" pull-right">      <button type="button" class="btn btn-default btn-sm">Back</button>    </div> -->
  </div>
  <div class="box-body min-height-box" >
     <div class="row">
    <div class="col-md-12">

    <div class="form-group col-md-6">
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>
    </div>
        <div class="form-group col-md-6">

	<?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>
	</div>
	</div>
	<div class="col-md-12">
	<div class="form-group col-md-6">
	<?= $form->field($model, 'designation')->textInput(['maxlength' => true, 'placeholder' => 'Designation']) ?>
	</div>
	<div class="form-group col-md-6">
	<?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true, 'placeholder' => 'Mobile Number']) ?>
	</div>
	</div>
	<div class="col-md-12">
	 <div class="form-group col-md-6">
    <?php echo $form->field($model, 'user_type')->dropDownList(
            ['A' => 'Admin', 'E' => 'Event Manager'] ); ?>
    	</div>
      <div class="form-group col-md-6">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Login Username']) ?>
    </div>
	</div>
	 <div class="col-md-12">
       <div class='col-sm-6 form-group' >
               <?php if($model->isNewRecord){ ?>
               <?php 
                  echo $form->field($model, 'password_hash')->passwordInput(['maxlength' => true,'placeholder'=>'Password','class'=>'form-control', 'value'=>'', 'required'=>true])->label('Password');?>
               <?php }else{ ?>
               <?php 
                  echo $form->field($model, 'password_hash')->passwordInput(['maxlength' => true,'placeholder'=>'Password','class'=>'form-control', 'value'=>''])->label('Password');?>
               <?php } ?>
            </div>
	</div>
</div>
</div>
    <div class="box-footer">
    <div class="form-group pull-right">      
      <?= Html::a('Cancel',['index'], ['class' =>'btn btn-default']) ?>      
      <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-create createBtn btn-success' : 'btn btn-primary','required'=>true]) ?>    
    </div>
  </div>
</div>
    <?php ActiveForm::end(); ?>



<script type="text/javascript">
    $(".datepicker").datepicker();
    </script>