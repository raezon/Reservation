<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\ProductItem;
use app\models\ProductItemSearch;
use app\models\ProductParent;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\db\ActiveQuery;
use app\models\Partner;
use yii\db\Expression;



/**
 * ProductItemController implements the CRUD actions for ProductItem model.
 */
class ProductItemController extends Controller
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
    * Lists all ProductItem models.
    * @return mixed
    */
   public function actionIndex()
   {
      $array_id_parent = array();
      if (User::getCurrentUser()->id == 180) {
         $array_id_parent;
         $query = ProductItem::find();
         $searchModel = new ProductItemSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $array_id_parent);
         return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
         ]);
      } else {
         $this->layout = 'main';
         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         if (!empty($partner)) {
            $product_parent = ProductParent::find()->andwhere(['partner_id' => $partner->id])->all();

            foreach ($product_parent  as $child) {
               if (!empty($child->id))
                  $array_id_parent[] = $child->id;
            }
            //$query =ProductItem::find()->andwhere(['product_id'=>$array_id_parent])->one();

            $searchModel = new ProductItemSearch();
            if (!empty($array_id_parent)) {
               $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $array_id_parent);
               return $this->render('index', [
                  'searchModel' => $searchModel,
                  'dataProvider' => $dataProvider,
               ]);
            } else {
               $data = ProductItem::find()->andwhere(['product_id' => -1]);
               $dataProvider = new ActiveDataProvider([
                  'query' => $data,
                  'pagination' => [
                     'pageSize' => 10,
                  ],
                  'sort' => [
                     'defaultOrder' => [
                        'created_at' => SORT_DESC,
                        'title' => SORT_ASC,
                     ]
                  ],
               ]);

               return $this->render('index', [
                  'searchModel' => $searchModel,
                  'dataProvider' => $dataProvider,
               ]);
            }
         }
      }
   }

   /**
    * Displays a single ProductItem model.
    * @param integer $id
    * @return mixed
    */
   public function actionView($id)
   {

      if (User::getCurrentUser()->id != 180) {
         $this->layout = 'main';
      }
      $product = ProductItem::find()->andwhere(['id' => $id])->one();

      $model = $this->findModel($id);

      return $this->render('view', [
         'model' => $this->findModel($id),
      ]);
   }

   /**
    * Creates a new ProductItem model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
   public function actionCreate()
   {
      if (User::getCurrentUser()->id != 180) {
         $this->layout = 'main';
      }
      $model = new ProductItem();

      if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
         return $this->redirect(['view', 'id' => $model->id]);
      } else {
         return $this->render('create', [
            'model' => $model,
         ]);
      }
   }

   /**
    * Updates an existing ProductItem model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
   public function actionUpdate($id)
   {
     
      $expression = new Expression('NOW()');
      $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
      $timestamp = strtotime($now);;
      if (User::getCurrentUser()->id != 180) {
         $this->layout = 'main';
      }
      $model = ProductItem::find()->andwhere(['id' => $id])->one();
      $product = ProductItem::find()->andwhere(['id' => $id])->one();
      $product_parent = ProductParent::find()->andwhere(['id' => $model->product_id])->One();
      $model3=new \app\models\forms\ServicesAndPriceForm();
      $product_parent_old = $product_parent;

      if ($model->loadAll(Yii::$app->request->post()) && $model3->load(Yii::$app->request->post())) {
         $string_data = '';
         if ($product->partner_category == 7) {
            $array_langues['Arabic'] = $model->Arabic;
            $array_langues['Frensh'] = $model->Frensh;
            $array_langues['English'] = $model->English;
            $array_langues['Deutsh'] = $model->Deutsh;
            $array_langues['Japenesse'] = $model->Japenesse;

            $model->languages = json_encode($array_langues, true);
         }
         if ($product->partner_category == 3) {
            $jsonData = array();

            $jsonData['vegan'] = $model->vegan;
            $jsonData['Vegetarian'] = $model->Vegetarian;
            $jsonData['Organic'] = $model->Organic;
            $jsonData['Gluten_free'] = $model->Gluten_free;
            $jsonData['Halal'] = $model->Halal;
            $jsonData['Cacher'] = $model->Cacher;
            $jsonData['Without_porc'] = $model->Without_porc;
            $string_data = json_encode($jsonData);
            $model->checkbox = $string_data;
         }


         if ($model->number_of_agent != 0) {
            $model->people_number = $model->number_of_agent;
         } else {
            $model->number_of_agent = 0;
         }
         if ($product->partner_category == 1) {
            $services = json_encode($model->services);
            $services_facilities = $model->services_F;

            $services_possiblity = $model->extra_p;
            $services_transport = $model->extra_t;

            if (empty($model->area))
               $model->area = "0";
            $array_type_room_rental[0]["area"] = $model->area;
            if (empty($model->caution))
               $model->caution = "0";
            $array_type_room_rental[0]["caution"] = $model->caution;
            if (empty($model->event_cake))
               $model->event_cake = "0";
            $array_type_room_rental[0]["event_cake"] = $model->event_cake;
            if (empty($model->drink))
               $model->drink = "0";
            $array_type_room_rental[0]["drink"] = $model->drink;
            if (empty($model->External_food))
               $model->External_food = "0";
            $array_type_room_rental[0]["External_food"] = $model->External_food;
            if (empty($model->External_Catering))
               $model->External_Catering = "0";
            $array_type_room_rental[0]["External_Catering"] = $model->External_Catering;
            if (empty($model->Internal_Catering))
               $model->Internal_Catering = "0";
            $array_type_room_rental[0]["Internal_Catering"] = $model->Internal_Catering;
            if (empty($model->Without_guarantee))
               $model->Without_guarantee = "0";
            $array_type_room_rental[0]["Without_guarantee"] = $model->Without_guarantee;
            if (empty($model->Minimum_consumption_Price))
               $model->Minimum_consumption_Price = "0";
            $array_type_room_rental[0]["Minimum_consumption_Price"] = $model->Minimum_consumption_Price;
            if (empty($model->Wifi))
               $model->Wifi = "0";
            $array_type_room_rental[0]["Wifi"] = $model->Wifi;
            if (empty($model->Board))
               $model->Board = "0";
            $array_type_room_rental[0]["Board"] = $model->Board;
            if (empty($model->System_Sound))
               $model->System_Sound = "0";
            $array_type_room_rental[0]["System_Sound"] = $model->System_Sound;
            if (empty($model->Video_projector))
               $model->Video_projector = "0";
            $array_type_room_rental[0]["Video_projector"] = $model->Video_projector;
            if (empty($model->Micro))
               $model->Micro = "0";
            $array_type_room_rental[0]["Micro"] = $model->Micro;
            if (empty($model->To_bring_back_cake_of_the_event))
               $model->To_bring_back_cake_of_the_event = "0";
            $array_type_room_rental[0]["To_bring_back_cake_of_the_event"] = $model->To_bring_back_cake_of_the_event;
            if (empty($model->To_bring_back_drinks))
               $model->To_bring_back_drinks = "0";
            $array_type_room_rental[0]["To_bring_back_drinks"] = $model->To_bring_back_drinks;
            if (empty($model->Parking_lot))
               $model->Parking_lot = "0";
            if (empty($model->Parking_lot_field))
               $model->Parking_lot_field = "0";
            $array_type_room_rental[0]["Parking_lot"]["name"] = $model->Parking_lot;
            $array_type_room_rental[0]["Parking_lot"]["field"] = $model->Parking_lot_field;
            if (empty($model->Subway))
               $model->Subway = "0";
            if (empty($model->Subway_field))
               $model->Subway_field = "0";
            $array_type_room_rental[0]["Subway"]["name"] = $model->Subway;
            $array_type_room_rental[0]["Subway"]["field"] = $model->Subway_field;
            if (empty($model->Train))
               $model->Train = "0";
            if (empty($model->Train_field))
               $model->Train_field = "0";
            $array_type_room_rental[0]["Train"]["name"] = $model->Train;
            $array_type_room_rental[0]["Train"]["field"] = $model->Train_field;
            if (empty($model->Bus))
               $model->Bus = "0";
            if (empty($model->Bus_field))
               $model->Bus_field = "0";
            $array_type_room_rental[0]["Bus"]["name"] = $model->Bus;
            $array_type_room_rental[0]["Bus"]["field"] = $model->Bus_field;
            if($services_facilities){
               $array_type_room_rental[0][0]["services_facilities"]['name'] = $services_facilities[0]['Description'];
            $array_type_room_rental[0][1]["services_facilities"]['name'] = $services_facilities[1]['Description'];
            $array_type_room_rental[0][2]["services_facilities"]['name'] = $services_facilities[2]['Description'];
            $array_type_room_rental[0][3]["services_facilities"]['name'] = $services_facilities[3]['Description'];
            $array_type_room_rental[0][4]["services_facilities"]['name'] = $services_facilities[0]['Description2'];
            $array_type_room_rental[0][5]["services_facilities"]['name'] = $services_facilities[1]['Description2'];
            $array_type_room_rental[0][6]["services_facilities"]['name'] = $services_facilities[2]['Description2'];
            $array_type_room_rental[0][7]["services_facilities"]['name'] = $services_facilities[3]['Description2'];
            }
            if($services_possiblity){
                //possiblity array extra
            $array_type_room_rental[0][0]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[0]['Possibility_check_name'];
            $array_type_room_rental[0][1]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[1]['Possibility_check_name'];
            $array_type_room_rental[0][2]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[2]['Possibility_check_name'];
            $array_type_room_rental[0][3]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[3]['Possibility_check_name'];;
            $array_type_room_rental[0][4]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[0]['Possibility_check_name2'];
            $array_type_room_rental[0][5]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[1]['Possibility_check_name2'];
            $array_type_room_rental[0][6]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[2]['Possibility_check_name2'];
            $array_type_room_rental[0][7]["services_possiblity"]['Possibility_check_name'] = $services_possiblity[3]['Possibility_check_name2'];;;
            }
            if($services_transport){
                //services transport extra
            $array_type_room_rental[0][0]["services_transport"]['Transportation_name'] = $services_transport[0]['Transportation_name'];
            $array_type_room_rental[0][0]["services_transport"]['route number'] = $services_transport[0]['route number'];
            $array_type_room_rental[0][1]["services_transport"]['Transportation_name'] = $services_transport[1]['Transportation_name'];
            $array_type_room_rental[0][1]["services_transport"]['route number'] = $services_transport[1]['route number'];
            $array_type_room_rental[0][2]["services_transport"]['Transportation_name'] = $services_transport[2]['Transportation_name'];
            $array_type_room_rental[0][2]["services_transport"]['route number'] = $services_transport[2]['route number'];
            $array_type_room_rental[0][3]["services_transport"]['Transportation_name'] = $services_transport[3]['Transportation_name'];
            $array_type_room_rental[0][3]["services_transport"]['route number'] = $services_transport[3]['route number'];
            $array_type_room_rental[0][4]["services_transport"]['Transportation_name'] = $services_transport[4]['Transportation_name'];
            $array_type_room_rental[0][4]["services_transport"]['route number'] = $services_transport[4]['route number'];
            $array_type_room_rental[0][5]["services_transport"]['Transportation_name'] = $services_transport[5]['Transportation_name'];
            $array_type_room_rental[0][5]["services_transport"]['route number'] = $services_transport[5]['route number'];
            $array_type_room_rental[0][6]["services_transport"]['Transportation_name'] = $services_transport[6]['Transportation_name'];
            $array_type_room_rental[0][6]["services_transport"]['route number'] = $services_transport[6]['route number'];
            $array_type_room_rental[0][7]["services_transport"]['Transportation_name'] = $services_transport[7]['Transportation_name'];
            $array_type_room_rental[0][7]["services_transport"]['route number'] = $services_transport[7]['route number'];
            }
            // $array_type_room_rental[]=$array_type_room_rental;
            $array_type_room_rental_compressed = json_encode($array_type_room_rental, true);
            $model->product_type = $array_type_room_rental_compressed;
            //
            $ouvertureFermuture=array();
            $ouvertureFermutureAll=array();
            $periodeValueIndex=['period1','period2','period3','period4','period5','period6'];
            $periodeNameIndex=['From','To','Banquet \ Dinner','Cinema','Cocktail','Conference','Meeting','Theater'];
            $index=0;
            $informationConcerningRoom[0]=$model3->minRentalPeriode;
            $informationConcerningRoom[1]=$model3->maxRentalPeriode;
            $informationConcerningRoom[2]=$model3->minNumberGuest;
            $informationConcerningRoom[3]=$model3->maxSeats;
            $informationConcerningRoom[4]=json_encode($model3->closedDay,true);
            $informationConcerningRoom[5]=$model3->weekendSurcharge;
            $informationConcerningRoom[6]=$model3->deposit;
            $informationConcerningRoom[7]=$model3->advancePayment;
            //I need to do cleansing of the overtureFermuture json array
            $ouverture=$model3->ouvertureFermuture;
            $dayIncrement=true;
            for($i=0;$i<6;$i++){
              for($j=1;$j<=8;$j++){
                //cleansing of the date two cases
                if($ouverture[$j-1][$periodeValueIndex[$i]]){
                
                  if(strlen($ouverture[$j-1][$periodeValueIndex[$i]])==3 && $j-1==0 ){
                    
                    $ouverture[$j-1][$periodeValueIndex[$i]] = $ouverture[$j-1][$periodeValueIndex[$i]][0] . ":" . substr($ouverture[$j-1][$periodeValueIndex[$i]], 1)."AM";
                    if($dayIncrement==false){
                      $datetime = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
                      $datetime = new \DateTime($datetime);
                      $datetime->modify('+1 day');
                      $ouverture[$j-1][$periodeValueIndex[$i]]  = $datetime->format('H:i:s');
                    
                    }else{
                      $ouverture[$j-1][$periodeValueIndex[$i]]  = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
                    }
                  }
                  if(strlen($ouverture[$j-1][$periodeValueIndex[$i]])==4 && $j-1==0)
                  {
                    $twodigitime=substr($ouverture[$j-1][$periodeValueIndex[$i]],0,2);
                    $twodigitime=(int)$twodigitime;
          
                    if($twodigitime>=13 && $dayIncrement)
                       $dayIncrement=false;
                    
                    if($dayIncrement==false && $twodigitime<13){
                  
                    $datetime = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
                    $datetime = new \DateTime($datetime);
                    $datetime->modify('+1 day');
                    $ouverture[$j-1][$periodeValueIndex[$i]]  = $datetime->format('H:i:s');
                    $ouverture[$j-1][$periodeValueIndex[$i]].="AM";
                    }
                    if($dayIncrement==true && $twodigitime>=13){
                      $ouverture[$j-1][$periodeValueIndex[$i]] = substr($ouverture[$j-1][$periodeValueIndex[$i]],0,2) . ":" . substr($ouverture[$j-1][$periodeValueIndex[$i]], 2);
                      $ouverture[$j-1][$periodeValueIndex[$i]]  = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
                    }
                    if($twodigitime>=13){
                    $ouverture[$j-1][$periodeValueIndex[$i]] = substr($ouverture[$j-1][$periodeValueIndex[$i]],0,2) . ":" . substr($ouverture[$j-1][$periodeValueIndex[$i]], 2);
                    $ouverture[$j-1][$periodeValueIndex[$i]] =date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
                    }
                   
                  }
                }
                if($j<8)
                if($ouverture[$j][$periodeValueIndex[$i]] ){
                  if(strlen($ouverture[$j][$periodeValueIndex[$i]])==3 && $j==1){
                  
                    $ouverture[$j][$periodeValueIndex[$i]] = $ouverture[$j][$periodeValueIndex[$i]][0]. ":" . substr($ouverture[$j][$periodeValueIndex[$i]], 1)."AM";
                    if($dayIncrement==false){
                      $datetime = date("g:iA", strtotime($ouverture[$j][$periodeValueIndex[$i]]  ));
                      $datetime = new \DateTime($datetime);
                      $datetime->modify('+1 day');
                      $ouverture[$j][$periodeValueIndex[$i]]  = $datetime->format('H:i:s');
                      $ouverture[$j][$periodeValueIndex[$i]].="AM";
                
                    }else{
                      $ouverture[$j][$periodeValueIndex[$i]]  = date("g:iA", strtotime($ouverture[$j-1][$periodeValueIndex[$i]] ));
                    }
                   // echo $datetime->format('Y-m-d H:i:s');
                   // die();
                 
                  }
                  if(strlen($ouverture[$j][$periodeValueIndex[$i]])==4 && $j==1)
                  {
                    if($dayIncrement==true)
                      $dayIncrement=false;
        
                    $ouverture[$j][$periodeValueIndex[$i]] = substr($ouverture[$j][$periodeValueIndex[$i]],0,2) . ":" . substr($ouverture[$j][$periodeValueIndex[$i]], 2);
                    $ouverture[$j][$periodeValueIndex[$i]] =date("g:iA", strtotime($ouverture[$j][$periodeValueIndex[$i]] ));
                  }
        
                }
                $ouvertureFermuture[$periodeNameIndex[$j-1]]=$ouverture[$j-1][$periodeValueIndex[$i]];
              }
              $ouvertureFermutureAll[]=$ouvertureFermuture;
              $ouvertureFermuture=array();
             
            } 
         
        
           /* echo "<pre>"; 
            echo json_encode($ouvertureFermuture, JSON_PRETTY_PRINT);
            echo "</pre>"; */
            //die();
            $informationConcerningRoom[8]=$ouvertureFermutureAll;
            $informationConcerningRoom[9]=$model3->fullDay;
        
            $model->checkbox = json_encode($informationConcerningRoom,true);
            $model->min_price = 0.0;
         }
         $product_parent->extra = json_encode($product_parent->extra, true);


         $product_parent->name = $product_parent->name;


         $product_parent->description = $product_parent->description;


         if (!empty($product_parent->kind_of_food))
            $product_parent->kind_of_food;
         else
            $product_parent->kind_of_food = "empty";
         if (!empty($product_parent->min))
            $product_parent->min = $product_parent->min;
         else
            $product_parent->min = "empty";

         $product_parent->update();
     
         if (!($_FILES['ServicesAndPriceForm']["name"]["imageFile"] == "")) {

            $length = sizeof($_FILES['ServicesAndPriceForm']["name"]["imageFile"]);

            $array_image = array();
            // if ($j < 1) {
     
            for ($k = 0; $k < $length; $k++) {
               $e =  $_FILES['ServicesAndPriceForm']["name"]["imageFile"][$k];
               $type = $_FILES['ServicesAndPriceForm']["type"]["imageFile"][$k];
               $name = $_FILES['ServicesAndPriceForm']["tmp_name"]["imageFile"][$k];
               $extension = explode(".", $e);

               $array_image[] = 'products' . $model->name . $k . $timestamp . '.' . $extension[1];
               $extension = explode(".", $e);
               $previous_array_image = $array_image;
               $image = 'products' . $model->name  . $k . $timestamp . '.' . $extension[1];
               $images = json_encode($array_image, true);
               $model->picture = (string) $images;
               $model->image = (string) $images;
               $reverse_image = json_decode($images, true);
               $target = 'img/products/' . basename($image);
               if (move_uploaded_file($name, $target)) {
                  $fp = fopen($target, "r");
               }
            }


            if ($extension[1] == 'jpg') {
               if (file_exists('img/products/' . $model->picture))
                  unlink('img/products/' . $model->picture);
            }

            if ($extension == "png") {
               $image = imagecreatefrompng($target);
               $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
               imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
               imagealphablending($bg, TRUE);
               imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
               imagedestroy($image);
               $quality = 50; // 0 = low / smaller file, 100 = better / bigger file 
               imagejpeg($bg, $target . ".jpg", $quality);
               imagedestroy($bg);
               if (move_uploaded_file($bg, $target)) {

                  $fp = fopen($target, "r");
               }
            }

            if (move_uploaded_file($name, $target) && $extension[1] = "jpg") {

               $fp = fopen($target, "r");
            }
         }
         $model->status = 0;
         if ($model->saveAll()) {
         } else {
            echo "ggg";
            print_r($model->getErrors());
            die();
         }

         return $this->redirect(['view', 'id' => $model->id]);
      } else {
         return $this->render('update', [
            'model' => $model,
            'product_parent' => $product_parent
         ]);
      }
   }
   public function actionConfirm($id)
   {
      if (User::getCurrentUser()->id == 180) {
         $this->layout = 'main';
         $product = ProductItem::find()->andwhere(['id' => $id])->one();
         if ($product->status == 0)
            $product->status = 1;
         else
            $product->status = 0;
         if (empty($product->number_of_agent))
            $product->number_of_agent = 0;

         if ($product->update()) {
         } else {
            print_r($product->getErrors());
            die();
         }
         return $this->redirect(['index']);
      } else {
         return $this->redirect(['index']);
      }
   }
   /**
    * Deletes an existing ProductItem model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    */
   public function actionDelete($id)
   {
      if (User::getCurrentUser()->id != 180) {
         $this->layout = 'main';
      }
      $parent = $this->findModel($id);
      $this->findModel($id)->deleteWithRelated();
      $this->findModelParent($parent->product_id)->deleteWithRelated();


      if (Yii::$app->request->isAjax) {
         Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         return ['success' => true];
      }
      return $this->redirect(['index']);
   }


   /**
    * Finds the ProductItem model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return ProductItem the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
   protected function findModel($id)
   {
      if (($model = ProductItem::findOne($id)) !== null) {
         return $model;
      } else {
         throw new NotFoundHttpException('The requested page does not exist.');
      }
   }
   protected function findModelParent($id)
   {
      if (($model = ProductParent::findOne($id)) !== null) {
         return $model;
      } else {
         throw new NotFoundHttpException('The requested page does not exist.');
      }
   }
}
