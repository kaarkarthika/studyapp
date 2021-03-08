<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use yii\widgets\Breadcrumbs;
  use yii\helpers\Url;
  use yii\helpers\ArrayHelper;
  use backend\models\SubCategory;
  use backend\models\CategoryManagement;
  use backend\models\ChapterManagement;
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
    <h3 class="box-title pull-left " >Video Management</h3>
    <div class=" pull-right">   
    </div>
  </div>
  <div class="box-body min-height-box" >
    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
    <div class="row">
      <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-4 form-group">
         <?php echo  $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(CategoryManagement::find()->all(),'auto_id','category_name'), ['prompt'=>'--Select category--','style'=>'height: 35px']) ?>
      </div>
      <div class='col-sm-4 form-group'>
        <?php echo  $form->field($model, 'sub_category_id')->dropDownList(ArrayHelper::map(SubCategory::find()->all(),'auto_id','sub_category_name'), ['prompt'=>'--Select Sub category--','style'=>'height: 35px']) ?>
        <?= $form->field($model, 'hidden_Input')->hiddenInput(['id'=>'hidden_Input','class'=>'form-control','value'=>$token_name])->label(false)?>
      </div>
      <div class='col-sm-4 form-group'>
        <?php echo  $form->field($model, 'chapter_id')->dropDownList(ArrayHelper::map(ChapterManagement::find()->all(),'auto_id','chapter_name'), ['prompt'=>'--Select Chapter--','style'=>'height: 35px']) ?>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-4 form-group">
         <?php
            $prevIng = $user_image_url = "";
            $no = "no";
            if($model->upload_video!=""){
                $no = "yes";
                $user_image_url = url::base(true)."/".$model->upload_video; 
            }
            if($user_image_url!=""){
                    $prevIng = ' <span style="color:green;" >Update Image : '.$user_image_url.'</span>';
                }
         ?>
     <label>Upload Video</label>
          <input type="file" id="input-file-now-custom-1" class="dropify" name="ContentManagement[upload_video]" data-default-file="<?php echo $user_image_url; ?>" data-height="290" /><br />
      </div>
    <?php if($model->isNewRecord){ $model->status = 1;}?>          
          <div class="col-sm-4 form-group">          
          <?= $form->field($model, 'status', [ 'template' => "<div class='checkbox checkbox-custom' style='margin-top:30px; margin-left:20px;'>{input}<label>Active</label></div>{error}",])->checkbox([],false) ?>          
      </div>
      </div>
    </div>
  </div>
  <div class="box-footer">
    <div class="form-group pull-right">                         
    <?= Html::a('Cancel',['videoindex'], ['class' =>'btn btn-default']) ?>                          
    <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-create createBtn btn-success' : 'btn btn-primary','required'=>true]) ?>
    </div>
    <?php ActiveForm::end(); ?>                 
  </div>
</div>
<script>
    $(document).ready(function(){
        
         $('.dropify').dropify();
        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element){
            console.log('Has Errors');
        });

       
    });   
</script>

