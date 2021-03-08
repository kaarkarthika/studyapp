<?php

namespace backend\controllers;

use Yii;
use backend\models\UserManagement;
use backend\models\UserManagementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserManagementController implements the CRUD actions for UserManagement model.
 */
class UserManagementController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all UserManagement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserManagementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserManagement model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserManagement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserManagement();
        $session = Yii::$app->session; 
        if($model->load(Yii::$app->request->post())) {
        $password=Yii::$app->request->post('UserManagement')['password'];
        $model->password = Yii::$app->security->generatePasswordHash($password);
        $model->auth_key = Yii::$app->security->generateRandomString();
        if ($formTokenValue = Yii::$app->request->post('UserManagement')['hidden_Input']) {   
          $sessionTokenValue =  $session['hidden_token'];
          if ($formTokenValue == $sessionTokenValue ){
        if ($model->save()) {
            Yii::$app->session->remove('hidden_token');
            Yii::$app->getSession()->setFlash('success', 'User Saved successfully.');
           return $this->redirect(['index']); 
         }else{
          Yii::$app->getSession()->setFlash('error', 'Something went wrong !');
          $formTokenName = uniqid();
          $session['hidden_token']=$formTokenName;
               return $this->render('create', [
               'model' => $model,
               'token_name' => $formTokenName,
                ]);
                }
              }else{
               return $this->redirect(['index']); } 
              }
          }else {
            $formTokenName = uniqid();
            $session['hidden_token']=$formTokenName;
                return $this->render('create', [
                    'model' => $model,
                    'token_name' => $formTokenName,
                ]);
        }
    }

    /**
     * Updates an existing UserManagement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
         $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
         $password=Yii::$app->request->post('UserManagement')['password'];
        if(!empty($password)){
            $model->password = Yii::$app->security->generatePasswordHash($password);
         }else{
        $model21 = UserManagement::find()
        ->where(['auto_id'=> $id ])
        ->asArray()
        ->one();
        $password=$model21['password'];   
         $model->password=$password;    
         }
        if($model->save()){
            
         Yii::$app->getSession()->setFlash('success', 'User Updated successfully.');
         return $this->redirect(['index']);
        }else{
            echo "<pre>";print_r($model->getErrors());die;
        }
        } else {
        $formTokenName = uniqid();
        $session['hidden_token']=$formTokenName;
            return $this->render('update', [
                'model' => $model,
                'token_name' => $formTokenName,
            ]);
        }
    }

    /**
     * Deletes an existing UserManagement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserManagement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserManagement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
