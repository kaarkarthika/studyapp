<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\EventCategoryManagement */

?>
<div class="category-management-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'auto_id',
            'category_name',
           [
            'attribute' =>   'category_image',
            'value'=>$model->category_image,           
            'format' => ['image',['width'=>'80']],
            ],
            ['attribute'=>'status',
            'value'=>function($models, $keys){
             if($models->status=="1"){
                return  "Active";
             }else{
                return  "Inactive";
             }
            },
          ],
            // 'created_at',
            // 'updated_at',
        ],
    ]) ?>

</div>
