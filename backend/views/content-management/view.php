<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\EventManagement */

?>
<div class="content-management-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'auto_id',
            'categoryname',
            'subcategoryname',
            'chaptername',
            'option_key',
            'upload_link',
            'upload_file',
            //'upload_video',
            ['attribute'=>'status',
            'value'=>function($models, $keys){
            if($models->status=="1"){
                return  "Active";
             }else{
                return  "Inactive";
             }
            },
          ],
            //'created_at',
           // 'updated_at',
        ],
    ]) ?>

</div>
