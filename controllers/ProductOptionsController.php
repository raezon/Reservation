<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\ProductExtra;
use app\models\ProductSearch;
use app\models\Partner;
use app\models\Product;
use app\models\ProductParent;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * ProductOptionsController implements the CRUD actions for ProductOptions model.
 */
class ProductOptionsController extends Controller
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
        ];
    }

    /**
     * Lists all ProductOptions models.
     * @return mixed
     */
    public function actionIndex()
    {
           if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        
         $searchModel = new ProductSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         
         $query = new  yii\db\Query;
         $query =   Product::find()->andwhere(['partner_id'=>$partner->id])->all();
         $query1 =  ProductParent::find()->andwhere(['partner_id'=>$partner->id])->all();
         $query_all=array();
         
         //construction the json array 
         $i=0;
         foreach ($query  as $q) {
            
            if(!empty($q->extra))
             $query_all[$i]=json_decode($q->extra,true);
             $query_all[$i]['id']=$q->id;
             $query_all[$i]['category_id']=$q->partner_category;
             $query_all[$i]['currencies_symbol']=$q->currencies_symbol;
             $i++;

         }
          $i=0;
         foreach ($query1  as $q) {
            if(!empty($q->extra))
             $query_all[$i]=json_decode($q->extra,true);
             $query_all[$i]['id']=$q->id;
             $query_all[$i]['category_id']=$q->partner_category;
             $query_all[$i]['currencies_symbol']=$q->currencies_symbol;
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
            'model'=>  $query_all
        ]);
    }
        
       
    

    /**
     * Displays a single ProductOptions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$category_id)
    {
           if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        
        
         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         
         $query = new  yii\db\Query;
         $query =  Product::find()->andwhere(['id'=>$id,'partner_category'=>$category_id,'partner_id'=>$partner->id])->one();
         if(empty($query))
             $query=  ProductParent::find()->andwhere(['id'=>$id,'partner_category'=>$category_id,'partner_id'=>$partner->id])->one();
         $query_all=array();
         
         //construction the json array 
         
          $k=0;
            
            if(!empty($query->extra)){
                 $query_all[$k]=json_decode($query->extra,true);
                $query_all[$k]['id']=$query->id;
                $query_all[$k]['currencies_symbol']=$query->currencies_symbol;
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
            'model'=>  $query_all[$k]
        ]);
    }

    /**
     * Creates a new ProductOptions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
           if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        $model = new ProductOptions();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductOptions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$category_id)
    {
        
                  if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        
        
         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         
         $query = new  yii\db\Query;
         $query =  Product::find()->andwhere(['id'=>$id,'partner_category'=>$category_id,'partner_id'=>$partner->id])->one();
         if(empty($query))
             $query=  ProductParent::find()->andwhere(['id'=>$id,'partner_category'=>$category_id,'partner_id'=>$partner->id])->one();
         $query_all=array();
         
         //construction the json array 
         
          $k=0;
            
            if(!empty($query->extra)){
                 $query_all[$k]=json_decode($query->extra,true);
                $query_all[$k]['id']=$query->id;
                $query_all[$k]['currencies_symbol']="";
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
         
     
         
         $model=Product::find()->andwhere(['id'=>$id])->One();
         $type_model=0;
         if(empty($model))
           {
            $model=ProductParent::find()->andwhere(['id'=>$id])->One();
            $type_model=1;
           } 
          
         $array_extra=array();


      $k=0;
      if ($model->loadAll(Yii::$app->request->post())) {
            $model->id=$id;
            $array_extra[$k]['id']=$id;
            $array_extra[$k]['Description']=$model->description ;
            $array_extra[$k]['Price']=$model->price ;
            $array_extra[$k]['Quantity']=$model->quantity ;
            if($type_model==1){
                if(empty($model->name))
                 $model->name="vide";
                if(empty($model->kind_of_food))
                 $model->kind_of_food="vide";
                if(empty($model->min))
                 $model->min="vide";
            }else{

                if($model->name="")
                 $model->name="vide";
                if($model->kind_of_food="")
                 $model->kind_of_food="vide";
                if($model->min="")
                 $model->min="vide";
            
            }
            $model->status="0";
           // $model1=Product::find()->andwhere(['id'=>$model->id])->One();
            $model->extra=json_encode($array_extra,true);
            if($model->update()){

            }else{
                echo "string";
                  print_r( $model->getErrors());
                die();
                
            }
           
             
           
            return $this->redirect(['view', 'id' => $id]);
        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductOptions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$category_id)
    {
              
                  if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        
        
         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         
         $query = new  yii\db\Query;
         $query =  Product::find()->andwhere(['id'=>$id,'partner_category'=>$category_id,'partner_id'=>$partner->id])->one();
         if(empty($query))
             $query=  ProductParent::find()->andwhere(['id'=>$id,'partner_category'=>$category_id,'partner_id'=>$partner->id])->one();
         $query_all=array();
         
         //construction the json array 
         
          $k=0;
            
            if(!empty($query->extra)){
                 $query_all[$k]=json_decode($query->extra,true);
                $query_all[$k]['id']=$query->id;
                $query_all[$k]['currencies_symbol']="";
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
         
     
         
         $model=Product::find()->andwhere(['id'=>$id,'partner_category'=>$category_id])->One();
         $type_model=0;
         if(empty($model))
           {
            $model=ProductParent::find()->andwhere(['id'=>$id,'partner_category'=>$category_id])->One();
            $type_model=1;
           } 
         $array_extra=array();
      $k=0;
            $model->id=$id;
            $array_extra[$k]['id']=$id;
            $array_extra[$k]['Description']="vide" ;
            $array_extra[$k]['Price']=0.0 ;
            $array_extra[$k]['Quantity']=0 ;
            if($type_model==1){
                if(empty($model->name))
                 $model->name="vide";
                if(empty($model->kind_of_food))
                  $model->kind_of_food="vide";
                if(empty($model->min))
                  $model->min="vide";
            }else{

                if(empty($model->name))
                 $model->name="vide";
                
            
            }
            $model->status="0";
           // $model1=Product::find()->andwhere(['id'=>$model->id])->One();
            $model->extra=json_encode($array_extra,true);
            if($model->update()){

            }else{
                echo "string";
                  print_r( $model->getErrors());
                die();
                
            }
           
             
           
            return $this->redirect(['index']);
        
    }

    
    /**
     * Finds the ProductOptions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductOptions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductOptions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
