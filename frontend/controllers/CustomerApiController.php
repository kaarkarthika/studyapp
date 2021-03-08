<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use backend\models\ApiServiceLog;
use backend\models\UserManagement;
use backend\models\EventManagement;
use backend\models\EventCategoryManagement;
use backend\models\BookmarkLog;
use yii\db\Expression;
use yii\db\Query;
use common\models\User;

class CustomerApiController extends Controller
{

           public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

public function beforeAction($action) {    
    $params = (Yii::$app->request->headers);
 
    if($authorization=$params['authorization']){    
      $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }else{
       $list = array();
       $list['status'] = 'error';
       $list['message'] = 'Bad Request!';   
       $response['Output'][]=$list;
        echo json_encode($response);
    }
} 
function authorization(){  
  $params = (Yii::$app->request->headers);
  $authorization=$params['authorization'];
  $authorization=str_replace('Bearer', '', $authorization);
  $authorization=trim($authorization);
  $model = UserManagement::find()
          ->where(['auth_key'=>$authorization])
          ->one();
  if($model){ 
    return $model;
  }else{ 
    return false;
  }
}

/*Profile Upload*/
public function actionProfileUpload(){
  $list = array();
  $list['status'] = 'error';
  $list['message'] = 'Invalid Authorization Request';
  if($model=$this->authorization()){
  $user_id=$model->auto_id;
  $postd=(Yii::$app ->request ->rawBody);
  //$requestInput = json_decode($postd,true);
  $model_log=new ApiServiceLog();
  $model_log->request_data=$postd;
  $model_log->event_key="profileupload";
  $model_log->created_at=date("Y-m-d H:i:s");
  $model_log->save();
  $log_id=$model_log->autoid;
    if ($_FILES["profile_pic"]["name"] == 0)
      {
          $insert_order=rand();
          $company_logo_path = 'images/'.$insert_order.$_FILES['profile_pic']['name'];
          if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $company_logo_path))
          {
              UserManagement::UpdateAll(['profile_pic'=>$company_logo_path,'updated_at'=>date('Y-m-d H:i:s')],['auto_id'=>$user_id]);
        $list['status']='success';
        $list['message']='profile updated Successfully';
      }
      }else{
      $list['status'] = "error";
      $list['message'] = 'Profile List not Available';
      }
   //Log Table 
  if($log_id!=''){
      $model_log=ApiServiceLog::find()->where(['autoid'=>$log_id])->one();
      $model_log->response_data=json_encode($list);
      $model_log->save();
    }
  }
   $response['Output'][] = $list;
   return json_encode($response);
}

/*Profile Details Retrieved Data*/
public function actionProfileRetrieve(){
  $list = array();
  $data=Url::base(true);
  $list['status'] = 'error';
  $list['message'] = 'Invalid Authorization Request';
  if($model=$this->authorization()){
  $user_id=$model->auto_id;
  $postd=(Yii::$app ->request ->rawBody);
  $requestInput = json_decode($postd,true);
  
  $field_check=array('api_method');
  $model_log=new ApiServiceLog();
  $model_log->request_data=$postd;
  $model_log->event_key="profileretrieve";
  $model_log->created_at=date("Y-m-d H:i:s");
  $model_log->save();
  $log_id=$model_log->autoid;
   $is_error = '';
   foreach ($field_check as $one_key) {
      $key_val =isset($requestInput[$one_key]);
      if ($key_val == '') {
        $is_error = 'yes';
        $is_error_note = $one_key;
        break;
      }
  } 
  if ($is_error == "yes") {
      $list['status'] = 'error';
      $list['message'] = $is_error_note . ' is Mandatory.';
}else{
  $api_method = $requestInput['api_method'];
  if($api_method=="profile-retrieve"){
    $UserManagement = UserManagement::find()
    ->where(['auto_id'=>$user_id])
    ->asArray()
    ->one();
    if(!empty($UserManagement)){
        $list['auto_id'] = $UserManagement['auto_id'];
        $list['first name'] = $UserManagement['first_name'];
        $list['last name'] = $UserManagement['last_name'];
        $list['age'] = $UserManagement['age'];
        $list['mobile_number'] = $UserManagement['mobile_number'];
        $list['email_id'] = $UserManagement['email_id'];
        $list['address'] = $UserManagement['address'];
        $list['description'] = $UserManagement['short_description'];
        $list['profile_pic'] = $data."/".$UserManagement['profile_pic'];  
        $list['status']='success';
        $list['message']='success';
      }else{
      $list['status'] = "error";
      $list['message'] = 'Profile List not Available';
      }
      }else{
      $list['status'] = "error";
      $list['message'] = 'Invalid Api Method';
      }
  }
   //Log Table 
  if($log_id!=''){
      $model_log=ApiServiceLog::find()->where(['autoid'=>$log_id])->one();
      $model_log->response_data=json_encode($list);
      $model_log->save();
    }
  }
   $response['Output'][] = $list;
   return json_encode($response);
}
/*Profile Details Update*/
public function actionProfileUpdate()
{
  $list = array();
  $list['status'] = 'error';
  $list['message'] = 'Invalid Authorization Request';
  if($model=$this->authorization()){
  $user_id=$model->auto_id;
  $postd=(Yii::$app ->request ->rawBody);
  $requestInput = json_decode($postd,true);
  $field_check=array('first_name','last_name','age','mobile_number','address','email_id','description');
  $model_log=new ApiServiceLog();
  $model_log->request_data=$postd;
  $model_log->event_key="profileupdate";
  $model_log->created_at=date("Y-m-d H:i:s");
  $model_log->save();
  $log_id=$model_log->autoid;
   $is_error = '';
   foreach ($field_check as $one_key) {
      $key_val =isset($requestInput[$one_key]);
      if ($key_val == '') {
        $is_error = 'yes';
        $is_error_note = $one_key;
        break;
      }
  } 
  if ($is_error == "yes") {
      $list['status'] = 'error';
      $list['message'] = $is_error_note . ' is Mandatory.';
  }else{
      $first_name = $requestInput['first_name'];
      $last_name = $requestInput['last_name'];
      $age = $requestInput['age'];
      $mobile_number = $requestInput['mobile_number'];
      $address = $requestInput['address'];
      $email_id = $requestInput['email_id'];
      $description = $requestInput['description'];
        $UserManagement=UserManagement::find()
          ->where(['auto_id'=>$user_id])
          ->asArray()
          ->one();
       if(!empty($UserManagement)){
         UserManagement::updateAll(['first_name'=>$first_name,'last_name'=>$last_name,'age'=>$age,'mobile_number'=>$mobile_number,'address'=>$address,'email_id'=>$email_id,'short_description'=>$description],['auto_id'=>$user_id]);
         $list['status']='success';
         $list['message']='Updated Successfully';
      }else{
        $list['status']='success';
        $list['message']='NOT Available';
      }
  }
  //Log Table 
  if($log_id!=''){
      $model_log=ApiServiceLog::find()->where(['autoid'=>$log_id])->one();
      $model_log->response_data=json_encode($list);
      $model_log->save();
    }
  }
  $response['Output'][] = $list;
  return json_encode($response);
}
/*Event List and Search Data*/
public function actionEventList(){
  $list = array();
  $data=Url::base(true);
  $list['status'] = 'error';
  $list['message'] = 'Invalid Authorization Request';
  if($model=$this->authorization()){
  $user_id=$model->auto_id;
  $postd=(Yii::$app ->request ->rawBody);
  $requestInput = json_decode($postd,true);
  $field_check=array('apk_key','search_key');
  $model_log=new ApiServiceLog();
  $model_log->request_data=$postd;
  $model_log->event_key="eventlist";
  $model_log->created_at=date("Y-m-d H:i:s");
  $model_log->save();
  $log_id=$model_log->autoid;
     $is_error = '';
     foreach ($field_check as $one_key) {
        $key_val =isset($requestInput[$one_key]);
        if ($key_val == '') {
          $is_error = 'yes';
          $is_error_note = $one_key;
          break;
        }
    } 

    if ($is_error == "yes") {
        $list['status'] = 'error';
        $list['message'] = $is_error_note . ' is Mandatory.';
       
    }else{ 
      $apk_key = $requestInput['apk_key'];
      $search_key = $requestInput['search_key'];
       $categorylist=EventCategoryManagement::find()
        ->asArray()
        ->all();
         if(!empty($categorylist)){  
         $categorylistindex=ArrayHelper::index($categorylist,'auto_id');
        }
      if($apk_key=="event_list"){
        if($search_key == ""){
       $EventManagement = EventManagement::find() ->orderBy(['event_date' => SORT_DESC])->asArray()->all();
       }else{
       $EventManagement = EventManagement::find()->where(['like', 'event_title', $search_key]) ->orderBy(['event_date' => SORT_DESC])->asArray()->all();
       }
        if(!empty($EventManagement)){
        foreach ($EventManagement as $key => $value) {
          $det['auto_id'] = $value['auto_id'];
          $category_id = $value['category_id'];
          $categoryname="";
         if(isset($categorylistindex[$category_id])){
          $categoryname=ucfirst($categorylistindex[$category_id]['category_name']);
           }
          $det['categoryname'] = $categoryname;
          $det['title'] = $value['event_title'];
          $det['event_image'] = $data."/backend/web/".$value['event_image'];       
          $det['event_date']= $value['event_date'];
          $det['short_description']= $value['short_description'];
          $det['description']= $value['description'];
          $det['event_price']= $value['event_price'];
          $det['place']= $value['place'];
          $det['contact_number']= $value['contact_number'];
          $det['email']= $value['email'];
          $det['age']= $value['from_age']."-".$value['to_age'];
          $det1[]=$det;
        }
        $list['status']='success';
        $list['message']='success';
        $list['category_list']=$det1;
      }else{
        $list['status']='success';
        $list['message']='Details Not Available';
        $list['category_list']=array();
      }
} 
}
//Log Table 
  if($log_id!=''){
      $model_log=ApiServiceLog::find()->where(['autoid'=>$log_id])->one();
      $model_log->response_data=json_encode($list);
      $model_log->save();
    }
  }
  $response['Output'][] = $list;
  return json_encode($response);
}

/*RESET PASSWORD*/
public function actionResetPassword()
{

  $data=Url::base(true);
  $list = array();
  $list['status'] = 'error';
  $list['message'] = 'Invalid Authorization Request!';
  if($model=$this->authorization()){
  $user_id=$model->auto_id;  
  $postd=(Yii::$app ->request ->rawBody);
  $requestInput = json_decode($postd,true); 
  $field_check=array('email_id','password','old_password');
  $model_log=new ApiServiceLog();
  $model_log->request_data=$postd;
  $model_log->event_key="resetpassword";
  $model_log->created_at=date("Y-m-d H:i:s");
  $model_log->save();
  $log_id=$model_log->autoid;
     $is_error = '';
     foreach ($field_check as $one_key) {
        $key_val =isset($requestInput[$one_key]);
        if ($key_val == '') {
          $is_error = 'yes';
          $is_error_note = $one_key;
          break;
        }
    } 

    if ($is_error == "yes") {
        $list['status'] = 'error';
        $list['message'] = $is_error_note . ' is Mandatory.';
       
    }else{ 
        $email_id = $requestInput['email_id'];
        $password = $requestInput['password'];
        $old_password = $requestInput['old_password'];

        $UserManagement=UserManagement::find()
          ->where(['email_id'=>$email_id])
          ->asArray()
          ->one();
        if(!empty($UserManagement)){
              //foreach ($UserManagement as $key => $value){ 
            $haspassword=$UserManagement['password'];
         //echo "<pre>"; print_r($old_password);die;
              if(!empty($haspassword))
              {
                    if(Yii::$app->security->validatePassword($old_password,$haspassword))
                    { 
                      if($UserManagement['email_id'] == $email_id)
                      {
                    if(!empty($password))
                          {
                     $password_change=Yii::$app->security->generatePasswordHash($password);
                        UserManagement::updateAll(['password'=>$password_change],['email_id'=>$email_id]);
                        $list['status']='success';
                        $list['message']='Updated Successfully';                          }
                          else
                          {
                              $list['status'] = "not exist";
                               $list['message']='Invalid';   
                          }
                      }
                      else
                      {
                          $list['status'] = "not exist";
                           $list['message']='Invalid';   
                      }
                  }
                  else
                  {

                      $list['status'] = "not exist";
                       $list['message']='Invalid';   
                  }
              }
               else
                  {

                      $list['status'] = "not exist";
                       $list['message']='Invalid';   
                  }
       // }
      }
        else
        {
            $list['error'] = "not exist";
             $list['message']='Invalid';   
        }
   
}
//Log Table 
  if($log_id!=''){
      $model_log=ApiServiceLog::find()->where(['autoid'=>$log_id])->one();
      $model_log->response_data=json_encode($list);
      $model_log->save();
    }
  }
  $response['Output'][] = $list;
  return json_encode($response);
}

/*Add Bookmark*/
public function actionAddBookmark(){
  $list = array();
  $data=Url::base(true);
  $list['status'] = 'error';
  $list['message'] = 'Invalid Authorization Request';
  if($model=$this->authorization()){
  $user_id=$model->auto_id;
  $postd=(Yii::$app ->request ->rawBody);
  $requestInput = json_decode($postd,true);
  $field_check=array('event_id','status');
  $model_log=new ApiServiceLog();
  $model_log->request_data=$postd;
  $model_log->event_key="add bookmark";
  $model_log->created_at=date("Y-m-d H:i:s");
  $model_log->save();
  $log_id=$model_log->autoid;
     $is_error = '';
     foreach ($field_check as $one_key) {
        $key_val =isset($requestInput[$one_key]);
        if ($key_val == '') {
          $is_error = 'yes';
          $is_error_note = $one_key;
          break;
        }
    } 

    if ($is_error == "yes") {
        $list['status'] = 'error';
        $list['message'] = $is_error_note . ' is Mandatory.';
       
    }else{ 
      $BookmarkLog = new BookmarkLog();
      $BookmarkLog->event_id = $requestInput['event_id'];
      $BookmarkLog->user_id = $user_id;
      $BookmarkLog->bookmark_status = $requestInput['status'];
      if($BookmarkLog->save()){
      $list['bookmark_id'] = $model->auto_id;
      $list['status'] = "success";
      $list['message'] = 'Data Saved Successfully';
      }else{
      $list['status'] = "error";
      $list['message'] = $model->getErrors();
      }
} 
//Log Table 
  if($log_id!=''){
      $model_log=ApiServiceLog::find()->where(['autoid'=>$log_id])->one();
      $model_log->response_data=json_encode($list);
      $model_log->save();
    }
  }
  $response['Output'][] = $list;
  return json_encode($response);
}
/*Bookmark History*/
public function actionBookmarkHistory(){
  $list = array();
  $data=Url::base(true);
  $list['status'] = 'error';
  $list['message'] = 'Invalid Authorization Request';
  if($model=$this->authorization()){
  $user_id=$model->auto_id;
  $first_name=$model->first_name;
  $postd=(Yii::$app ->request ->rawBody);
  $requestInput = json_decode($postd,true);
  $field_check=array('apk_key');
  $model_log=new ApiServiceLog();
  $model_log->request_data=$postd;
  $model_log->event_key="bookmarkhistory";
  $model_log->created_at=date("Y-m-d H:i:s");
  $model_log->save();
  $log_id=$model_log->autoid;
     $is_error = '';
     foreach ($field_check as $one_key) {
        $key_val =isset($requestInput[$one_key]);
        if ($key_val == '') {
          $is_error = 'yes';
          $is_error_note = $one_key;
          break;
        }
    } 

    if ($is_error == "yes") {
        $list['status'] = 'error';
        $list['message'] = $is_error_note . ' is Mandatory.';
       
    }else{ 
     $eventlist=EventManagement::find()
        ->asArray()
        ->all();
         if(!empty($eventlist)){  
         $eventlistindex=ArrayHelper::index($eventlist,'auto_id');
        }
        $apk_key = $requestInput['apk_key'];
        if($apk_key == "bookmark_history"){
          $bookmarkhistory = BookmarkLog::find()->where(['user_id'=>$user_id])->asArray()->all();
        if(!empty($bookmarkhistory)){
        foreach ($bookmarkhistory as $key => $value) {
          $det['auto_id'] = $value['auto_id'];
          $event_id = $value['event_id'];
          $eventname="";
         if(isset($eventlistindex[$event_id])){
          $eventname=ucfirst($eventlistindex[$event_id]['event_title']);
           }
          $det['eventname'] = $eventname;
          $det['bookmark_status'] = $value['bookmark_status'];
          $det['name'] = $first_name;
          $det1[]=$det;
        }
        $list['status']='success';
        $list['message']='success';
        $list['category_list']=$det1;
      }else{
        $list['status']='success';
        $list['message']='Details Not Available';
        $list['bookmarkhistory']=array();
      }
    }else{
        $list['status']='success';
        $list['message']='Invalid Api Method';
    }
    }
//Log Table 
  if($log_id!=''){
      $model_log=ApiServiceLog::find()->where(['autoid'=>$log_id])->one();
      $model_log->response_data=json_encode($list);
      $model_log->save();
    }
  }
  $response['Output'][] = $list;
  return json_encode($response);
}
}
