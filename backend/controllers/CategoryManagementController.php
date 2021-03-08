<?php

namespace backend\controllers;

use Yii;
use backend\models\CategoryManagement;
use backend\models\CategoryManagementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryManagementController implements the CRUD actions for CategoryManagement model.
 */
class CategoryManagementController extends Controller
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
     * Lists all CategoryManagement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryManagementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryManagement model.
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
     * Creates a new CategoryManagement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        $model = new CategoryManagement();

        $session = Yii::$app->session; 
        if($model->load(Yii::$app->request->post())) {
             if ($_FILES['CategoryManagement']['error']['category_image'] == 0) {
                 //echo"sds";die;               
                    $rand = rand(0, 99999); // random number generation for unique image save
                  //  $model->scenario = 'imageUploaded';
                    $model->file = UploadedFile::getInstance($model, 'category_image');
                    $image_name = 'images/' . $model->file->basename . $rand . "." . $model->file->extension;
                    $model->file->saveAs($image_name);
                    $model->category_image = $image_name;
            }
        if ($formTokenValue = Yii::$app->request->post('CategoryManagement')['hidden_Input']) {   
          $sessionTokenValue =  $session['hidden_token'];
          if ($formTokenValue == $sessionTokenValue ){
        if ($model->save()) {
            Yii::$app->session->remove('hidden_token');
            Yii::$app->getSession()->setFlash('success', 'Category Saved successfully.');
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
     * Updates an existing EventCategoryManagement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $current_image1=$model->category_image; 
        if ($model->load(Yii::$app->request->post())) {
            if ($_FILES['CategoryManagement']['error']['category_image'] == 0) {
                 //echo"sds";die;               
                    $rand = rand(0, 99999); // random number generation for unique image save
                  //  $model->scenario = 'imageUploaded';
                    $model->file = UploadedFile::getInstance($model, 'category_image');
                    $image_name = 'images/' . $model->file->basename . $rand . "." . $model->file->extension;
                    $model->file->saveAs($image_name);
                    $model->category_image = $image_name;
            }else{
               $model->category_image = $current_image1;
            }
           
        if($model->save()){
            
         Yii::$app->getSession()->setFlash('success', 'Category Updated successfully.');
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
     * Deletes an existing CategoryManagement model.
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
     * Finds the CategoryManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryManagement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryManagement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
