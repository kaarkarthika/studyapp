<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

$session = Yii::$app->session;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoryManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'PDF Management';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="event-management-index">

    <div class="box box-primary  ">
      
   
        <div class=" box-header with-border box-header-bg">


        <h3 class="box-title pull-left " ><?= Html::encode($this->title) ?></h3>
                <div class=" pull-right">
                    <?= Html::a('Add PDF', ['create'], ['class' => 'btn btn-default btn-sm']) ?>
                </div>
    </div>
   
<div class=" box-body min-height-table">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
          // 'auto_id',
            'categoryname',
            'subcategoryname',
            'chaptername',            
            'option_key',
             [
               'attribute' => 'upload_file',
               //'label' => 'Partner Name',
                   'format' => 'raw',
              // 'headerOptions' => ['class' => 'actionPartnername'],
               'value' => function ($data) {
                   $options = array_merge([
                                            'class' => 'btn btn-danger btn-xs update gridbtncustom',
                                            'data-toggle'=>'tooltip',
                                            'title' => Yii::t('yii', 'upload_file'),
                                            'aria-label' => Yii::t('yii', 'upload_file'),
                                            'data-pjax' => '0',
                                        ]);
                   $url=Url::base().'/'.$data->upload_file; 
                                        return Html::a('<span class="fa fa-file-pdf-o"> PDF </span>', $url, $options);


                       }
           ],
            //'upload_link',
            //'upload_file',
            //'upload_video',
            //'status',
            //'created_at',
            //'updated_at',
            ['attribute'=>'status',
             
            'value'=>function($models, $keys){
             

             if($models->status=="1"){

                return  "Active";
             }else{
                return  "Inactive";
             }
               
            },
            'filter'=>array('0'=>'Inactive','1'=>'Active'),
          ],
            //'event_price',
            //'description',
            //'place',
            //'contact_number',
            //'email:email',
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
             $('#operationalheader').html('<span> <i class="fa fa-fw fa-th-large"></i>PDF Management</span>');
             $('#operationalmodal').modal('show').find('#modalContenttwo').load(url);
             return false;
         });
     </script>
