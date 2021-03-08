<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
$session = Yii::$app->session;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoryManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'User Management';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-management-index">

    <div class="box box-primary  ">
      <div class=" ">
   
        <div class=" box-header with-border box-header-bg">


        <h3 class="box-title pull-left " ><?= Html::encode($this->title) ?></h3>
    </div>
    </div>
<div class=" box-body min-height-table">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
           [
            'attribute' =>   'first_name',
            'label' =>'User Name',
             'value' => function($model, $key, $index){
                return ucfirst($model->first_name).' '.ucfirst($model->last_name);
             }
            ], 
            'mobile_number',
            'email_id:email',
            'address',
            'age',
            //'password',
            //'created_at',
            //'updated_at',
          ['class' => 'yii\grid\ActionColumn',
               'header'=> 'Action',
                 'headerOptions' => ['style' => 'width:150px;color:#337ab7;'],
               'template'=>'{view}{update}{delete}',
                            'buttons'=>[
                              'view' => function ($url, $model, $key) {
                               
                                   // return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                                   return Html::button('<i class="glyphicon glyphicon-eye-open"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-primary btn-xs view view gridbtncustom modalView', 'data-toggle'=>'tooltip', 'title' =>'View' ]);
                                }, 
                             'update' => function ($url, $model, $key) {
                                        $options = array_merge([
                                            'class' => 'btn btn-warning btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'Update'),
                                            'aria-label' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                        ]);
                                        return Html::a('<span class="fa fa-edit"></span>', $url, $options);
                                    },
                              
                                'delete' => function ($url, $model, $key) {
                                   
                                    
                                        return Html::button('<i class="fa fa-trash"></i>', ['value' => $url, 'style'=>'margin-right:4px;','class' => 'btn btn-danger btn-xs delete gridbtncustom modalDelete', 'data-toggle'=>'tooltip', 'title' =>'Delete' ]);
                                  },
                          ] ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>
</div>

<script type="text/javascript">
     $('body').on("click",".modalView",function(){
             var url = $(this).attr('value');
             $('#operationalheader_large').html('<span> <i class="fa fa-fw fa-th-large"></i>User Management</span>');
             $('#operationalmodal_large').modal('show').find('#modalContenttwo_large').load(url);
             return false;
         });
     </script>
