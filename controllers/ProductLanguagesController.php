<?php

namespace app\controllers;

use Yii;
use app\models\ProductLanguages;
use app\models\ProductItem;
use app\models\ProductItemSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Partner;

use yii\data\ArrayDataProvider;

/**
 * ProductLanguagesController implements the CRUD actions for ProductLanguages model.
 */
class ProductLanguagesController extends Controller
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
    public function actionIndex(){
       if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        
        
         $searchModel = new ProductItemSearch();
         $query =  ProductItem::find()->andwhere(['partner_category'=>7])->all();
         $query_all=array();
         //construction the json array 
         $i=0;
         foreach ($query  as $q) {
            
            if(!empty($q->languages)){
             $query_all[$i]=json_decode($q->languages,true);
             $query_all[$i]['id']=$q->id;

            }
            $i++;

         }
         
         
         
         $provider = new ArrayDataProvider([
      'allModels' => $query_all,
      'pagination' => [
         'pageSize' => 3,
      ],
      'sort' => [
         'attributes' => ['id', 'name'],
      ],
   ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
            'model'=>$query
        ]);
    }

    /**
     * Displays a single ProductLanguages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
           if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }

         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         
         $query =  ProductItem::find()->andwhere(['partner_category'=>7])->all();
         
         
         //construction the json array 
         $query_all=array();
          $i=0;
         foreach ($query  as $q) {
           
            if(!empty($q->languages)){
                
                
                $query_all[$i]=json_decode($q->languages,true);
                $query_all[$i]['id']=$q->id;
            }
            $i++;
             

         }
        
         $provider = new ArrayDataProvider([
      'allModels' => $query_all,
      'pagination' => [
         'pageSize' => 3,
      ],
      'sort' => [
         'attributes' => ['id', 'name'],
      ],
   ]);
         
     
        
        // return $this->render('view', ['view', 'model' => $model]);
           return $this->render('view', [
            'dataProvider' => $provider,
            'model'=>  $query_all[$id]
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
                     if(User::getCurrentUser()->id!=1){
             $this->layout = 'main2';
            
       
        }
        
    
           if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }

         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         
         $query =  ProductItem::find()->andwhere(['partner_category'=>7])->all();
         
         
         //construction the json array 
         $query_all=array();
          $i=0;
         foreach ($query  as $q) {
           
            if(!empty($q->languages)){
                
                
                $query_all[$i]=json_decode($q->languages,true);
                $query_all[$i]['id']=$q->id;
            }
            $i++;
             

         }
         
         $provider = new ArrayDataProvider([
      'allModels' => $query_all,
      'pagination' => [
         'pageSize' => 3,
      ],
      'sort' => [
         'attributes' => ['id', 'name'],
      ],
   ]);
         
         //
      
         $model=ProductItem::find()->andwhere(['id'=>$query_all[$id]['id']])->One();
         
         
         $array_langues=array();

        $array_langues['id']=$query_all[$id]['id'];
  

        if ($model->loadAll(Yii::$app->request->post())) {
           // $model->id=$query_all[$id+1]['id'];
            $array_langues['id']=$query_all[$id+1]['id'];
            $array_langues['Arabic']=$model->Arabic ;
            $array_langues['Frensh']=$model->Frensh ;
            $array_langues['English']=$model->English ;
            $array_langues['Deutsh']=$model->Deutsh ;
            $array_langues['Japenesse']=$model->Japenesse ;
            $model->status="0";
           // $model1=Product::find()->andwhere(['id'=>$model->id])->One();
            $model->languages=json_encode($array_langues,true);
            if($model->update()){

            }else{
                echo "string";
                  print_r( $model->getErrors());
                die();
                
            }
           
           /* $model->description=$query_all[$id][0]['Description'] ;
             $model->price=$query_all[$id][0]['Price'] ;
             $model->quantity=$query_all[$id][0]['Quantity'] ;*/
           // $model->update();
            return $this->redirect(['view', 'id' => $id]);
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
                         if(User::getCurrentUser()->id!=1){
             $this->layout = 'main2';
            
       
        }
        
    
           if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }

         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         
         $query =  ProductItem::find()->andwhere(['partner_category'=>7])->all();
         
         
         //construction the json array 
         $query_all=array();
          $i=0;
         foreach ($query  as $q) {
           
            if(!empty($q->languages)){
                
                
                $query_all[$i]=json_decode($q->languages,true);
                $query_all[$i]['id']=$q->id;
            }
            $i++;
             

         }
         
         $provider = new ArrayDataProvider([
      'allModels' => $query_all,
      'pagination' => [
         'pageSize' => 3,
      ],
      'sort' => [
         'attributes' => ['id', 'name'],
      ],
   ]);
         
         //
      
         $model=ProductItem::find()->andwhere(['id'=>$query_all[$id]['id']])->One();
         
         
         $array_langues=array();

        $array_langues['id']=$query_all[$id]['id'];
  

        
           // $model->id=$query_all[$id+1]['id'];
            $array_langues['id']=$query_all[$id+1]['id'];
            $array_langues['Arabic']="not speaken";
            $array_langues['Frensh']="not speaken";
            $array_langues['English']="not speaken";
            $array_langues['Deutsh']="not speaken";
            $array_langues['Japenesse']="not speaken";
            $model->status="0";
       
            $model->languages=json_encode($array_langues,true);
            if($model->update()){

            }else{
                echo "string";
                  print_r( $model->getErrors());
                die();
                
            }
           
           /* $model->description=$query_all[$id][0]['Description'] ;
             $model->price=$query_all[$id][0]['Price'] ;
             $model->quantity=$query_all[$id][0]['Quantity'] ;*/
           // $model->update();
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
