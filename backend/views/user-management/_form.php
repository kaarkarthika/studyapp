<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use yii\widgets\Breadcrumbs;
  use yii\helpers\Url;
  use yii\helpers\ArrayHelper;
  
  $session = Yii::$app->session;
  ?>
<style>
  textarea{
  resize: none;
  }
</style>
<div class="box box-primary">
  <div class=" box-header with-border box-header-bg">
    <h3 class="box-title pull-left " >User Management</h3>
    <div class=" pull-right">   
  	<!-- <button type="button" class="btn btn-default btn-sm">Back</button>                      -->
	</div>
  </div>
  <div class="box-body min-height-box" >
    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
	<div class="row">
	  <div class="col-sm-8">
    <div class="row">
      <div class='col-sm-6 form-group' >
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'hidden_Input')->hiddenInput(['id'=>'hidden_Input','class'=>'form-control','value'=>$token_name])->label(false)?>
      </div>
      <div class="col-sm-6 form-group">
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
      </div>
     
    </div>
	
	<div class="row">
	   <div class="col-sm-6 form-group">
        <?= $form->field($model, 'mobile_number')->textInput(['onkeypress'=>'return isNumberKey(event)']) ?>
      </div>
	  <div class="col-sm-6 form-group">
        <?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>
      </div>
	</div>
	
	
	  <div class="row">
       <div class="col-sm-6 form-group">
        <?= $form->field($model, 'short_description')->textArea(['rows' => '2']) ?>
      </div>
	    <div class="col-sm-2 form-group">
        <?= $form->field($model, 'age')->textInput(['maxlength'=>true,'onkeypress'=>'return isNumberKey(event)']) ?>
      </div>
      <div class='col-sm-4' >
        <?php if($model->isNewRecord){ ?>
        <?php 
          echo $form->field($model, 'password')->passwordInput(['maxlength' => true,'value'=>'', 'required'=>true])?>
        <?php }else{ ?>
        <?php 
          echo $form->field($model, 'password')->passwordInput(['maxlength' => true,'value'=>''])?>
        <?php } ?>
      </div>
    </div>
    <div class="row">
       <?php if($model->isNewRecord){ ?>
                <div class='col-sm-4' >
                     <?= $form->field($model, 'profile_pic')->fileInput(['maxlength' => true,'class'=>'form-control','required'=>true]) ?>
                 <?php
                  if($model->profile_pic!=""){
                   $base=Url::base(true);
                   $profile_pic=$base."/".$model->profile_pic;
                   ?>

                   <img src="<?php echo $profile_pic;?>" style="width:70px;height:70px;">
                   <?php
                   }
                   else{
                 //echo "No Images !!!";
                   }
                     ?>
                  </div>
                      <?php }else{ ?>
                        <div class='col-sm-4' >
                     <?= $form->field($model, 'profile_pic')->fileInput(['maxlength' => true,'class'=>'form-control']) ?> 
                      <?php
                  if($model->profile_pic!=""){
                   $base=Url::base(true);
                   $profile_pic=$base."/".$model->profile_pic;
                   ?>

                   <img src="<?php echo $profile_pic;?>" style="width:70px;height:70px;">
                   <?php
                   }
                   else{
                   //  echo "No Images !!!";
                   } ?>
                  </div>                
                     <?php } ?>
      <!--  <div class="col-sm-4">
        <?//= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div> -->
    </div>
	 
	
	  </div>
	  <div class="col-sm-4">
	    <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
	  </div>

	</div>
	
	
    
  
   
  </div>
  <div class="box-footer">
    <div class="form-group pull-right">                         
	<?= Html::a('Cancel',['index'], ['class' =>'btn btn-default']) ?>                          
	<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-create createBtn btn-success' : 'btn btn-primary','required'=>true]) ?>                                                    </div>
    <?php ActiveForm::end(); ?>					
  </div>
</div>
<script type="text/javascript">
  function isNumberKey(evt)
  {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
      return true;
  }
</script>