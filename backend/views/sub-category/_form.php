<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use yii\widgets\Breadcrumbs;
  use yii\helpers\Url;
  use yii\helpers\ArrayHelper;
  use backend\models\CategoryManagement;
  $session = Yii::$app->session;
  ?>
<style>  
textarea{  resize: none;  } 
 .checkbox input[type="checkbox"] 
 {  cursor: pointer;  opacity: 0;  z-index: 1;  outline: none !important;  }  
 .upper {  text-transform: uppercase;  }  
 .checkbox-custom input[type="checkbox"]:checked + label::before {  background-color: #5fbeaa;  border-color: #5fbeaa;  } 
 .checkbox label::before { 
 -o-transition: 0.3s ease-in-out; 
 -webkit-transition: 0.3s ease-in-out; 
 background-color: #ffffff; 
 /* border-radius: 3px; */  border: 1px solid #cccccc; 
 content: "";  display: inline-block; 
 height: 17px;  left: 0!important; 
 margin-left: -20px!important; 
 position: absolute;  
 transition: 0.3s ease-in-out;  
 width: 17px;  outline: none !important;  }  
 .checkbox input[type="checkbox"]:checked + label::after {  
 content: "\f00c";  font-family: 'FontAwesome';  color: #fff;  
 position: relative;  right: 59px;  bottom: 1px;  } 
 .checkbox label {  display: inline-block;  padding-left: 5px;  position: relative;  }
 </style>
<div class="box box-primary">
  <div class=" box-header with-border box-header-bg">
    <h3 class="box-title pull-left " >Sub Category</h3>
    <div class=" pull-right">   
    </div>
  </div>
  <div class="box-body min-height-box" >
    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
    <div class="row">
      <div class="col-sm-12">
    <div class="row">
      <div class='col-sm-6 form-group' >
        <?php echo  $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(CategoryManagement::find()->all(),'auto_id','category_name'), ['prompt'=>'--Select category--','style'=>'height: 35px']) ?>
        <?= $form->field($model, 'hidden_Input')->hiddenInput(['id'=>'hidden_Input','class'=>'form-control','value'=>$token_name])->label(false)?>
      </div>
      <div class="col-sm-6 form-group">
        <?= $form->field($model, 'sub_category_name')->textInput(['maxlength' => true]) ?>
      </div>
    </div>
    <div class="row">
    <?php if($model->isNewRecord){ $model->status = 1;}?>          
          <div class="col-sm-6 form-group">          
          <?= $form->field($model, 'status', [ 'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px; margin-left:20px;'>{input}<label>Active</label></div>{error}",])->checkbox([],false) ?>          
      </div>
      </div>
    </div>
  </div>
  <div class="box-footer">
    <div class="form-group pull-right">                         
    <?= Html::a('Cancel',['index'], ['class' =>'btn btn-default']) ?>                          
    <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-create createBtn btn-success' : 'btn btn-primary','required'=>true]) ?>
    </div>
    <?php ActiveForm::end(); ?>                 
  </div>
</div>