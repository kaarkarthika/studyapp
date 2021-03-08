<?php

namespace backend\controllers;

use Yii;
use backend\models\ContentManagement;
use backend\models\ContentManagementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ContentManagementController implements the CRUD actions for ContentManagement model.
 */
class ContentManagementController extends Controller
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
     * Lists all ContentManagement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentManagementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionVideoindex()
    {
        $searchModel = new ContentManagementSearch();
        $dataProvider = $searchModel->search1(Yii::$app->request->queryParams);

        return $this->render('videoindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentManagement model.
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

    public function actionVideoview($id)
    {
        return $this->renderAjax('videoview', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ContentManagement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

  public function actionCreate()
    {
        $model = new ContentManagement();

        $session = Yii::$app->session; 
        if($model->load(Yii::$app->request->post())) {
             if ($_FILES['ContentManagement']['error']['upload_file'] == 0) {
                 //echo"sds";die;               
                    $rand = rand(0, 99999); // random number generation for unique image save
                  //  $model->scenario = 'imageUploaded';
                    $model->file = UploadedFile::getInstance($model, 'upload_file');
                    $image_name = 'images/' . $model->file->basename . $rand . "." . $model->file->extension;
                    $model->file->saveAs($image_name);
                    $model->upload_file = $image_name;
            }
        if ($formTokenValue = Yii::$app->request->post('ContentManagement')['hidden_Input']) {   
          $sessionTokenValue =  $session['hidden_token'];
          if ($formTokenValue == $sessionTokenValue ){
        if ($model->save()) {
            Yii::$app->session->remove('hidden_token');
            Yii::$app->getSession()->setFlash('success', 'PDF Saved successfully.');
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
     * Updates an existing ContentManagement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $current_image1=$model->upload_file; 
        if ($model->load(Yii::$app->request->post())) {
            if ($_FILES['ContentManagement']['error']['upload_file'] == 0) {
                 //echo"sds";die;               
                    $rand = rand(0, 99999); // random number generation for unique image save
                  //  $model->scenario = 'imageUploaded';
                    $model->file = UploadedFile::getInstance($model, 'upload_file');
                    $image_name = 'images/' . $model->file->basename . $rand . "." . $model->file->extension;
                    $model->file->saveAs($image_name);
                    $model->upload_file = $image_name;
            }else{
               $model->upload_file = $current_image1;
            }
           
        if($model->save()){
            
         Yii::$app->getSession()->setFlash('success', 'PDF Updated successfully.');
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


     public function actionVideocreate()
    {
        $model = new ContentManagement();

        $session = Yii::$app->session; 
        if($model->load(Yii::$app->request->post())) {
             if ($_FILES['ContentManagement']['error']['upload_video'] == 0) {
                 //echo"sds";die;               
                    $rand = rand(0, 99999); // random number generation for unique image save
                  //  $model->scenario = 'imageUploaded';
                    $model->file = UploadedFile::getInstance($model, 'upload_video');
                    $image_name = 'images/' . $model->file->basename . $rand . "." . $model->file->extension;
                    $model->file->saveAs($image_name);
                    $model->upload_video = $image_name;
            }
        $model->option_key = "V";
        if ($formTokenValue = Yii::$app->request->post('ContentManagement')['hidden_Input']) {   
          $sessionTokenValue =  $session['hidden_token'];
          if ($formTokenValue == $sessionTokenValue ){
        if ($model->save()) {
            Yii::$app->session->remove('hidden_token');
            Yii::$app->getSession()->setFlash('success', 'Video Saved successfully.');
           return $this->redirect(['videoindex']); 
         }else{
          Yii::$app->getSession()->setFlash('error', 'Something went wrong !');
          $formTokenName = uniqid();
          $session['hidden_token']=$formTokenName;
               return $this->render('videocreate', [
               'model' => $model,
               'token_name' => $formTokenName,
                ]);
                }
              }else{
               return $this->redirect(['videoindex']); } 
              }
          }else {
            $formTokenName = uniqid();
            $session['hidden_token']=$formTokenName;
                return $this->render('videocreate', [
                    'model' => $model,
                    'token_name' => $formTokenName,
                ]);
        }
    }

    public function actionVideoupdate($id)
    {
        $model = $this->findModel($id);
        $current_image1=$model->upload_video; 
        if ($model->load(Yii::$app->request->post())) {
            if ($_FILES['ContentManagement']['error']['upload_video'] == 0) {
                 //echo"sds";die;               
                    $rand = rand(0, 99999); // random number generation for unique image save
                  //  $model->scenario = 'imageUploaded';
                    $model->file = UploadedFile::getInstance($model, 'upload_video');
                    $image_name = 'images/' . $model->file->basename . $rand . "." . $model->file->extension;
                    $model->file->saveAs($image_name);
                    $model->upload_video = $image_name;
            }else{
               $model->upload_file = $current_image1;
            }
           
        if($model->save()){
            
         Yii::$app->getSession()->setFlash('success', 'Video Updated successfully.');
         return $this->redirect(['videoindex']);
        }else{
            echo "<pre>";print_r($model->getErrors());die;
        }
        } else {
        $formTokenName = uniqid();
        $session['hidden_token']=$formTokenName;
            return $this->render('videoupdate', [
                'model' => $model,
                'token_name' => $formTokenName,
            ]);
        }
    }

    /**
     * Deletes an existing ContentManagement model.
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
     * Finds the ContentManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentManagement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentManagement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
