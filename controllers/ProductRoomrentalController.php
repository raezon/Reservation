<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductLanguagesController implements the CRUD actions for ProductLanguages model.
 */
class ProductRoomrentalController extends Controller
{
    public function behaviors()
    {
                return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   
                ],
            ],
        ];
           
            
    }

    /**
     * Lists all ProductLanguages models.
     * @return mixed
     */
    public function actionIndex()
    {
        
            if(User::getCurrentUser()->id!=180){
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
           if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
          $this->layout = 'main2';
         return $this->render('view');
    }

    /**
     * Creates a new ProductLanguages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
           if(User::getCurrentUser()->id!=180){
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
            if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
          $model=ProductType::find()->andwhere(['id'=>$id])->one();
      
             if ($model->load(Yii::$app->request->post())) {
              $array_type_room_rental["area"]=$model->area;
              $array_type_room_rental["caution"]=$model->caution;
              $array_type_room_rental["event_cake"]=$model->event_cake;
              $array_type_room_rental["drink"]=$model->drink;
              $array_type_room_rental["External_food"]=$model->External_food;
              $array_type_room_rental["External_Catering"]=$model->External_Catering;
              $array_type_room_rental["Internal_Catering"]=$model->Internal_Catering;
              $array_type_room_rental["Without_guarantee"]=$model->Without_guarantee;
              $array_type_room_rental["Minimum_consumption_Price"]=$model->Minimum_consumption_Price;

              $array_type_room_rental["Wifi"]=$model->Wifi;
              $array_type_room_rental["Board"]=$model->Board;
              $array_type_room_rental["System_Sound"]=$model->System_Sound;
              $array_type_room_rental["Micro"]=$model->Micro;
              $array_type_room_rental["To_bring_back_cake_of_the_event"]=$model->To_bring_back_cake_of_the_event;
              $array_type_room_rental["To_bring_back_drinks"]=$model->To_bring_back_drinks;
              $array_type_room_rental["Parking_lot"]["name"]=$model->Parking_lot;
              $array_type_room_rental["Parking_lot"]["field"]=$model->Parking_lot_field;
              $array_type_room_rental["Subway"]["name"]=$model->Subway;
              $array_type_room_rental["Subway"]["field"]=$model->Subway_field;
              $array_type_room_rental["Train"]["name"]=$model->Train;
              $array_type_room_rental["Train"]["field"]=$model->Train_field;
              $array_type_room_rental["Bus"]["name"]=$model->Bus;
              $array_type_room_rental["Bus"]["field"]=$model->Bus_field;
              $array_type_room_rental[]=$array_type_room_rental;
              $array_type_room_rental_compressed=json_encode($array_type_room_rental,true);
           
            $model->nom=$array_type_room_rental_compressed;
             if($model->update()){
                //echo "sucess";
            }else{
               // echo "erreur sauvgarder dans le model productOption";
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

            if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
             $model=ProductType::find()->andwhere(['id'=>$id])->one();
      
             
              $array_type_room_rental["area"]="";
              $array_type_room_rental["caution"]="";
              $array_type_room_rental["event_cake"]="";
              $array_type_room_rental["drink"]="";
              $array_type_room_rental["External_food"]="";
              $array_type_room_rental["External_Catering"]="";
              $array_type_room_rental["Internal_Catering"]="";
              $array_type_room_rental["Without_guarantee"]="";
              $array_type_room_rental["Minimum_consumption_Price"]="";

              $array_type_room_rental["Wifi"]="";
              $array_type_room_rental["Board"]="";
              $array_type_room_rental["System_Sound"]="";
              $array_type_room_rental["Micro"]="";
              $array_type_room_rental["To_bring_back_cake_of_the_event"]="";
              $array_type_room_rental["To_bring_back_drinks"]="";
              $array_type_room_rental["Parking_lot"]["name"]="";
              $array_type_room_rental["Parking_lot"]["field"]="";
              $array_type_room_rental["Subway"]["name"]="";
              $array_type_room_rental["Subway"]["field"]="";
              $array_type_room_rental["Train"]["name"]="";
              $array_type_room_rental["Train"]["field"]="";
              $array_type_room_rental["Bus"]["name"]="";
              $array_type_room_rental["Bus"]["field"]="";
              $array_type_room_rental_compressed=json_encode($array_type_room_rental);
           
              $model->nom=$array_type_room_rental_compressed;
             if($model->update()){
                
            }else{
               // echo "erreur sauvgarder dans le model productOption";
                print_r($model->getErrors());
                die();
            }
          
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
