<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\base\ProductItem;
use app\models\ProductItemSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Product;
use app\models\User;

/**
 * ProductLanguagesController implements the CRUD actions for ProductLanguages model.
 */
class ProductCheckboxController extends Controller
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
        
       
        $this->layout = 'main2';
        $searchModel = new ProductItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $query = ProductItem::find()->where(['partner_category'=>3]);
         $provider = new ActiveDataProvider([
              'query' => $query,
              'pagination' => [
                 'pageSize' => 10,
              ],
           ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
            'model'=>  $query
        ]);
    }

    /**
     * Displays a single ProductLanguages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
          $this->layout = 'main2';
          $model = ProductItem::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new ProductLanguages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
          $this->layout = 'main2';
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
          $this->layout = 'main2';
           $model = ProductItem::findOne($id);

        if ($model->loadAll(Yii::$app->request->post())) {
                 $jsonData=array();
                 $string_data;
                 $jsonData['vegan']=$model->vegan;
                 $jsonData['Vegetarian']=$model->Vegetarian;
                 $jsonData['Organic']=$model->Organic;
                 $jsonData['Gluten_free']=$model->Gluten_free;
                 $jsonData['Halal']=$model->Halal;
                 $jsonData['Cacher']=$model->Cacher;
                 $jsonData['Without_porc']=$model->Without_porc;
                 $jsonData[]=$jsonData;
                 $string_data= json_encode($jsonData);
                 $model->checkbox=$string_data;
                 $model->status="0";
                 
                if($model->update()){

            }else{
                echo "string";
                  print_r( $model->getErrors());
                die();
                
            }

            
              
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    
    }

    /**
     * Deletes an existing ProductLanguages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    
          $this->layout = 'main2';
           $model = ProductItem::findOne($id);

      
                 $jsonData=array();
                 $jsonData['vegan']="vide";
                 $jsonData['Vegetarian']="vide";
                 $jsonData['Organic']="vide";
                 $jsonData['Gluten_free']="vide";
                 $jsonData['Halal']="vide";
                 $jsonData['Cacher']="vide";
                 $jsonData['Without_porc']="vide";
                 $jsonData= json_encode($jsonData);
                 $model->checkbox=$jsonData;
                 
               $model->update();

            
              
        
       

        return $this->redirect(['index']);
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
