<?php

namespace backend\controllers;

use Yii;
use backend\models\ChapterManagement;
use backend\models\ChapterManagementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChapterManagementController implements the CRUD actions for ChapterManagement model.
 */
class ChapterManagementController extends Controller
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
     * Lists all ChapterManagement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChapterManagementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChapterManagement model.
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
     * Creates a new ChapterManagement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ChapterManagement();

        $session = Yii::$app->session; 
        if($model->load(Yii::$app->request->post())) {
        if ($formTokenValue = Yii::$app->request->post('ChapterManagement')['hidden_Input']) {   
          $sessionTokenValue =  $session['hidden_token'];
          if ($formTokenValue == $sessionTokenValue ){
        if ($model->save()) {
            Yii::$app->session->remove('hidden_token');
            Yii::$app->getSession()->setFlash('success', 'Chapter Saved successfully.');
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
        if ($model->load(Yii::$app->request->post())) {
           
        if($model->save()){
            
         Yii::$app->getSession()->setFlash('success', 'Chapter Updated successfully.');
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
     * Deletes an existing ChapterManagement model.
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
     * Finds the ChapterManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChapterManagement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChapterManagement::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
