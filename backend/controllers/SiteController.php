<?php
namespace backend\controllers;
error_reporting(E_ALL ^ E_NOTICE);
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\User;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
             
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],

            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

     public function actionIndex()
    { 
        return $this->render('index');
    }


    public function actionLogin()
    {
        
    	$this->layout='loginLayout';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $isError = "no";
        $model = new LoginForm();
    		if(Yii::$app->request->post()){
                if ($model->load(Yii::$app->request->post()) && $model->login()) {

                $username = $_REQUEST['LoginForm']['username'];
                $user_data = User::find()->where(['username' => $username])->one();
                return $this->goHome(); //goBack changed as goHome
            }else{
                $isError = "yes";
                $this->layout = 'loginLayoutNew';
                return $this->render('login', [
                    'model' => $model,
                    'isError' => $isError,
                ]);
            }
        }
        
            $this->layout = 'loginLayoutNew';
            return $this->render('login', [
                'model' => $model,
                'isError' => $isError,
            ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $session = Yii::$app->session;
        $session->destroy();


        return $this->goHome();
    }

    
}
