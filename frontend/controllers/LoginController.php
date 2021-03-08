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
use yii\db\Expression;
use yii\db\Query;
use common\models\User;

class LoginController extends Controller
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
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
}

/*Login*/
 public function actionLogin()
{ 
  $list = array();
  $postd=(Yii::$app ->request ->rawBody);
  $requestInput = json_decode($postd,true);
  $data=Url::base(true); 
  $list['status'] = 'error';
  $list['message'] = 'Nill';
    
    $field_check=array('username','password');
    $model_log=new ApiServiceLog();
    $model_log->request_data=$postd;
    $model_log->event_key="login";
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
    $UserManagement = UserManagement::find()->where(['email_id'=>$requestInput['username']])->one();
    if(!empty($UserManagement)){ 
       $password=$requestInput['password'];
       $haspassword=$UserManagement->password;
    if(Yii::$app->security->validatePassword($password,$haspassword)){         
        $list['status'] = "success";
        $list['message'] = "Logged In successfully"; 
        $list['login_name']= $requestInput['username'];
        $list['auto_id'] =$UserManagement->auto_id;
        $list['name']= $UserManagement->first_name.$UserManagement->last_name;
        $list['age']= $UserManagement->age;
        $list['mobile_number']= $UserManagement->mobile_number;
        $list['address']= $UserManagement->address;
        $list['description']= $UserManagement->short_description;
        $list['auth_key']= $UserManagement->auth_key;
        $list['profile_pic'] = $data."/".$UserManagement->profile_pic;
      }else{
        $list['status'] = "error";
        $list['message'] = 'Invalid Login';

      }
    }else{
        $list['status'] = "error";
        $list['message'] = 'Invalid Login';
    }
   }
   //Log Table 
  if($log_id!=''){
      $model_log=ApiServiceLog::find()->where(['autoid'=>$log_id])->one();
      $model_log->response_data=json_encode($list);
      $model_log->save();
    }
        $response['Output'][] = $list;
        return json_encode($response);
    
}

/*AddAccount*/

public function actionRegistration(){
  $list = array();
  $data=Url::base(true);
  $postd=(Yii::$app ->request ->rawBody);
  $requestInput = json_decode($postd,true);
  
  $list['status'] = 'error';
  $list['message'] = 'Nill';
  
  $field_check=array('first_name','last_name','age','mobile_number','address','email_id','password','description');
  $model_log=new ApiServiceLog();
  $model_log->request_data=$postd;
  $model_log->event_key="registration";
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
    $model = new UserManagement();
    $model->first_name = $requestInput['first_name'];
    $model->last_name = $requestInput['last_name'];
    $model->age = $requestInput['age'];
    $model->mobile_number= $requestInput['mobile_number'];
    $model->address= $requestInput['address'];
    $model->email_id= $requestInput['email_id'];
    $password=$requestInput['password'];
    $model->password = Yii::$app->security->generatePasswordHash($password);
    $model->auth_key = Yii::$app->security->generateRandomString();
    $model->short_description=$requestInput['description'];
    if($model->save()) {
      $list['user_id'] = $model->auto_id;
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
  $response['Output'][] = $list;
  return json_encode($response);
   
}

 
}
