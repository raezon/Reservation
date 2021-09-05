<?php

namespace app\controllers;

use Yii;
use app\models\ProductLanguages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;

/**
 * ProductLanguagesController implements the CRUD actions for ProductLanguages model.
 */
class ProductTypeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all ProductLanguages models.
     * @return mixed
     */
    public function actionIndex()
    {
        
       
          if(User::getCurrentUser()->id!=1){
             $this->layout = 'main2';
            
       
        }
         return $this->render('index');
    }

    /**
     * Displays a single ProductLanguages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
            if(User::getCurrentUser()->id!=1){
             $this->layout = 'main2';
            
       
        }
         return $this->render('view');
    }

    /**
     * Creates a new ProductLanguages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
           if(User::getCurrentUser()->id!=1){
             $this->layout = 'main2';
            
       
        }
         return $this->render('create');
    }

    /**
     * Updates an existing ProductLanguages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
           if(User::getCurrentUser()->id!=1){
             $this->layout = 'main2';
            
       
        }
         return $this->render('update');
    
    }

    /**
     * Deletes an existing ProductLanguages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
           if(User::getCurrentUser()->id!=1){
             $this->layout = 'main2';
            
       
        }
         return $this->render('delete');
    }
    
    /**
     * 
     * Export ProductLanguages information into PDF format.
     * @param integer $id
     * @return mixed


    
    /**
     * Finds the ProductLanguages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductLanguages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductLanguages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
