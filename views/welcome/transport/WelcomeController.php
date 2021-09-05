<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Plat;
use app\models\Product;
use app\models\ProductItem;
use app\models\ProductOption;
use app\models\ProductOptionS;
use app\models\ProductType;
use app\models\Partner;
use app\models\Other;
use app\models\PartnerCategory;
use app\models\base\QuestionsList;
use app\models\base\Questions;
use app\models\base\QuestionsPartner;
use app\models\forms\ServicesAndPriceForm;
use app\models\AccountNotification;
use yii\db\Expression;
use app\models\base\Event;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\db\Query;
use yii\db\Connection;


class WelcomeController extends \yii\web\Controller
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
                'class' => AccessControl::className(),
                'only' => ['index','save'],
                'rules' => [
                    [
                        'allow' => true,
//                        'actions' => ['index'],
//                        'roles' => ['@']
                        'roles' => [User::ROLE_PARTNER]
                    ],
//                    [
//                        'allow' => false
//                    ]
                ]
            ]
        ];
    }


    public function actionIndex()
    {
        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();

        $id_questionPartner=$partner->questionsPartner->questions_id;
        if ($partner){
         //now i should do some request to get the question url



                     $questionsList = QuestionsList::find()->where([
                          'id' =>$id_questionPartner])->One();

                    $questions = Questions::find()->where([
                        'questions_list_id' => $questionsList->id,'status'=>0])->All();


                    return Yii::$app->response->redirect($questions[0]->url)->send();


                     $this->layout = 'blank';
                    $categories = PartnerCategory::find()->all();
                     //partie des insertion des produits
                    return $this->render('index', [
                        'categories' => $categories
                    ]);






        }
        //in case partenair doesn't exist
        // 2- create a step by step filling forms, redirect as necessary
        $categories = PartnerCategory::find()->all();

         //1partie des insertion des produits
        $user_id=User::getCurrentUser()->id;
        $name=bin2hex(openssl_random_pseudo_bytes(4));
        $this->save_partner($user_id,9,$name.'');
       // $this->layout = 'blank';

        return $this->render('index', [
            'categories' => $categories
        ]);
    }
    function save_partner($user_id,$category_id,$name){
               //crée un nom aléatoire
               //verifier si partenair don't exisit
            $partenaire_existance=Partner::find()
            ->where( [ 'user_id' => $user_id ] )
            ->exists();
            //verifier si le partenair exisit
             $product_model=Partner::find()
            ->where( [ 'user_id' => $user_id ] )->one();
            //echo $partenaire_existance;
         //dans le cas partenaire n'existe pas
         if(!$partenaire_existance)
            {
              $Name= bin2hex(openssl_random_pseudo_bytes(4));
                      $product_model=new Partner();
                  }
                    $expression = new Expression('NOW()');
                    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW();
                     // prints the current date
          // prints the current date
                   $product_model->name=$name;
                   $product_model->description="xxxx";
                   $product_model->address="xxxx";
                   $product_model->tel="xxxx";
                   $product_model->fax="xxxx";
                   $product_model->web_site="xxxx";
                   $product_model->country="xxxx" ;
                   $product_model->city="xxxxx";
                   $product_model->postal_code="xxxx";
                   $product_model->keywords="xxxx";
                   $product_model->email="xxxx";
                   $product_model->picture="xxxx";
                   $product_model->user_id=$user_id;
                   $product_model->category_id=$category_id;
                   $product_model->status=0;
                   $expression = new Expression('NOW()');
                   $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
                     $timestamp = strtotime($now);;
                     $product_model->created_at=$timestamp;
                     $product_model->updated_at=$timestamp;
                     //$product_model->updated_at=$timestamp;
//dans le cas que le partenair exist dej
                  if ( $partenaire_existance) {
                      if($product_model->update())
                        {
                          //echo "sucess update partenair";
                      }
                       else {
                        echo "UPDAT MODEL NOT SAVED partenair";
                        //print_r( $product_model->getAttributes());
                        print_r( $product_model->getErrors());
                        exit;
                    }
                }
//dans le cas que le partenaire n'exist pas
                else {
                   if($product_model->save())
                        {
                          echo "sucess save";
                      }
                       else {
                             echo "SAVE";
                        echo "MODEL NOT SAVED";
                        print_r( $product_model->getAttributes());
                        print_r( $product_model->getErrors());
                        exit;
                    }
                }
    }

    public function actionOther($other,$id,$category_id,$partner_id,$type)
    {
      //une methode utiliser lors de la sauvgarde dans l'étape 3 de la catégorie room rental

           $Produit_option= [

          ['id' => '1', 'name' => '  Some tables'],

          ['id' => '2', 'name' => 'Enclosed space'],

          ['id' => '3', 'name' => 'Full privatization'],


        ];
             $Produit_type= [

          ['id' => '1', 'name' => 'Meeting'],

          ['id' => '2', 'name' => 'Conference'],

          ['id' => '3', 'name' => 'Cocktail'],

          ['id' => '4', 'name' => 'Dinatoire'],

          ['id' => '5', 'name' => 'Theater'],

          ['id' => '6', 'name' => 'Cinema']
        ];
        //first model
        $category = PartnerCategory::find()->where(['id' => $category_id])->one();
        $model3 = new \app\models\forms\ServicesAndPriceForm();
        // you will get the value of sample
        //saving the other in database
            $model_other=new Other();
            $model_other->name=$other;
            $model_other->type=$type;
            $model_other->partener_id=$partner_id;
            if($model_other->save())
                        {
                            echo "other sucess";
                        }
                         else {
                             echo "SAVE";
                              echo "MODEL NOT SAVED other";
                              print_r( $model_other->getAttributes());
                              print_r( $model_other->getErrors());
                              exit;
                          }
      // now i must fetch the other and construct my product option and my product type
          $id_user=User::getCurrentUser()->id;
      //traying to getting partener id
         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         $partner_id=$partner->id;
         $other_options=Other::find()->andwhere(['partener_id'=>$partner_id,'type'=>0])->all();
         $other_types=Other::find()->andwhere(['partener_id'=>$partner_id,'type'=>1])->all();
          $i=0;
          $i=$i+3;
          foreach ($other_options as $other_option) {
            $i++;
            $Produit_option[$i]['name']=$other_option->name;
          }
          $i=$i+1;
          $Produit_option[$i]['name']="Other";
          $i=0;
          $i=$i+6;
          foreach ($other_types as $other_type) {
            $i++;
            $Produit_type[$i]['name']=$other_type->name;
          }

          $i=$i+1;
          $Produit_type[$i]['name']="Other";
            return $this->render('Room_Rental/step'.$id, [
            'model' =>  new \app\models\forms\GeneralInformationForm(),
            'model3'=>$model3,
            'Produit_option'=>$Produit_option,
            'Produit_type'=>$Produit_type,
        ]);
           //trying to get the id and category id
          //redirect to url
    }
    public function actionCategory($id = 0) {
        /*$post = Yii::$app->request->post();
        if ($post && $post['category_id']){
            $category_id = (int) $post['category_id'];
            $category = PartnerCategory::find()->where(['id' => $category_id])->one();
            if ($category){
                return $this->redirect(['welcome/step', 'id' => 1,
                    'model' => new \app\models\forms\GeneralInformationForm(),
                    'category_id' => $category->id
                ]);
            }
        }*/
        //creating the intial
        $category = PartnerCategory::find()->where(['id' => $id])->one();
        if ($category){
            //task to do finalise the
            return $this->redirect(['welcome/step', 'id' => 1,
                'model' => new \app\models\forms\GeneralInformationForm(),
                'category_id' => $category->id
            ]);
        }

        return $this->redirect(['welcome/index']);
    }
    function actionLists($id){
        //indépendant dropDown for the catégori roomRental

         $Produit_Options= [

          ['id' => '1', 'name' => 'Individual plate','produit_id'=>'2','category_id'=>'3'],

          ['id' => '2', 'name' => 'Dish to share','produit_id'=>'2','category_id'=>'3'],

          ['id' => '3', 'name' => 'lunchbox ','produit_id'=>'2','category_id'=>'3'],

          ['id' => '4', 'name' => 'meal trays','produit_id'=>'2','category_id'=>'3'],

          ['id' => '5', 'name' => 'other','produit_id'=>'2','category_id'=>'3'],

        ];
        //without using active record returning the count of elments and the value corresponding
         $model=new ProductOption();
         $count=0;
         foreach ($Produit_Options as $Produit_Option) {
            if($Produit_Option['produit_id']==$id){
             $model->id=$Produit_Option['id'];
             $model->name=$Produit_Option['name'];
             $model->product_id=$Produit_Option['produit_id'];
             $model->category_id=$Produit_Option['category_id'];
             $count++;
            }

         }

        if($count > 0){
              foreach ($Produit_Options as $Produit_Option) {
             echo "<option value='" .$Produit_Option['id'] . "'>" . $Produit_Option['name'] . "</option>";
         }
        }else{
            echo "<option>-</option>";
        }

    }
    function save_partner_step1($user_id,$category_id,$name,$email,$tel,$fax){
      //first we need to check if the partenaire exist
            $partenaire_existance=Partner::find()
            ->where( [ 'user_id' => $user_id ] )
            ->exists();
     //we get a model from the product
             $product_model=Partner::find()
            ->where( [ 'user_id' => $user_id ] )->one();
         if(!$partenaire_existance)
            {
              $Name= bin2hex(openssl_random_pseudo_bytes(4));
                      $product_model=new Partner();
                  }
                    $expression = new Expression('NOW()');
                    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW();
                     // prints the current date
          // we fill the default partenair identification
                   $product_model->name=$name;
                   $product_model->description="xxxx";
                   $product_model->address="xxxx";
                   $product_model->tel="xxxx";
                   $product_model->fax=$fax;
                   $product_model->web_site="xxxx";
                   $product_model->country="xxxx" ;
                   $product_model->city="xxxxx";
                   $product_model->postal_code="xxxx";
                   $product_model->keywords="xxxx";
                   $product_model->email=$email;
                   $product_model->picture="xxxx";
                   $product_model->user_id=$user_id;
                   $product_model->category_id=$category_id;
                   $product_model->status=0;
                   $expression = new Expression('NOW()');
                   $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
                   $timestamp = strtotime($now);;
                   $product_model->created_at=$timestamp;
                   $product_model->updated_at=$timestamp;

                  //$product_model->updated_at=$timestamp;
//dans le cas que le partenair exist dej
                  if ( $partenaire_existance) {
                      if($product_model->update())
                        {
                          echo "sucess update partenair";
                      }
                       else {
                        echo "UPDAT MODEL NOT SAVED partenair";
                        //print_r( $product_model->getAttributes());
                        print_r( $product_model->getErrors());
                        exit;
                    }
                }
//dans le cas que le partenaire n'exist pas
                else {
                   if($product_model->save())
                        {
                          echo "sucess save";
                      }
                       else {
                             echo "SAVE";
                        echo "MODEL NOT SAVED";
                        print_r( $product_model->getAttributes());
                        print_r( $product_model->getErrors());
                        exit;
                    }
                }
    }
    function save_partner_step2($user_id,$category_id,$companyAddress,$companyAddress_N,$city,$state,$postalCode,$country){
             $product_model=Partner::find()
            ->where( [ 'user_id' => $user_id ] )->one();
                   $address=$companyAddress." ".$companyAddress_N;
                   $product_model->address=$address;
                   $product_model->country=$country;
                   $product_model->city=$city;
                   $product_model->postal_code=$postalCode;
                   $product_model->category_id=$category_id;
                   $expression = new Expression('NOW()');
                   $now = (new \yii\db\Query)->select($expression)->scalar();
                   $expression = new Expression('NOW()');
                   $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
                   $timestamp = strtotime($now);;
                   $product_model->created_at=$timestamp;
                   $product_model->updated_at=$timestamp;
                      if($product_model->update())
                        {
                          echo "sucess update";
                      }
                       else {
                        echo "UPDAT MODEL NOT SAVED partenaire in step2";
                        print_r( $product_model->getAttributes());
                        print_r( $product_model->getErrors());
                        exit;
                    }
    }
        function save_partner_step3($user_id,$category_id,$produit_nom,$produit_description,$produit_image,$produit_nombre_de_perssone,$produit_nombre_de_equipement,$produit_price, $produit_prix_heure,$array_services,$produit_check_day,$produit_check_night,$produit_price_day,$produit_price_night,$produit_l_arbic,$produit_l_frensh,$produit_l_english,$produit_l_deutsh,$produit_l_japenesse,$Produit_type,$produit_l_area,$produit_l_caution,$produit_l_produit_option,$produit_l_produit_type,$produit_l_event_cake,$produit_l_drink,$produit_l_External_food,$produit_l_External_Catering,$produit_l_Internal_Catering,$produit_l_Without_guarantee,$produit_l_Minimum_consumption_Price,$produit_l_Wifi,$produit_l_Board,$produit_l_System_Sound,$produit_l_Micro,$produit_l_To_bring_back_cake_of_the_event,$produit_l_To_bring_back_drinks,$produit_l_Parking_lot,$produit_l_Parking_lot_field,$produit_l_Subway,$produit_l_Subway_field,$produit_l_Train,$produit_l_Train_field,$produit_l_Bus,$produit_l_Bus_field,$name_of_meal,$option_of_meal,$type_of_meal,$vegan,$glutenfree,$Halal,$Kosher,$Organic,$Withoutpork,$price_serveur,$min_consomation,$produit_image_Name){

          //partie currencies
          $currencies_symbol="$";
          $geoip = new \lysenkobv\GeoIP\GeoIP();
          $ip = $geoip->ip(Yii::$app->request->getUserIP()); // current user ip
          $currencies = json_decode(file_get_contents('data.json'), true);
          foreach ($currencies as $currency) {
              if (strtoupper($currency['country']) == strtoupper($ip->isoCode)) {
                 $currencies_symbol= $currency['currency'];
              }
          }
          if(empty($currencies_symbol))
             $currencies_symbol="$";
          $msg=array();
         //   getting the array of Product Type with other ida kayn
              $Produit_type_array= [

                ['id' => '1', 'name' => 'Minibus-'],

                ['id' => '2', 'name' => 'Bus'],

                ['id' => '3', 'name' => 'Coach'],

                ['id' => '4', 'name' => 'other']
              ];
                $Produit_option= [

                ['id' => '1', 'name' => '  Some tables'],

                ['id' => '2', 'name' => 'Enclosed space'],

                ['id' => '3', 'name' => 'Full privatization'],


                ['id' => '5', 'name' => 'Other']

              ];
           $Produit_type_room_rental= [

                ['id' => '1', 'name' => 'Meeting'],

                ['id' => '2', 'name' => 'Conference'],

                ['id' => '3', 'name' => 'Cocktail'],

                ['id' => '4', 'name' => 'Dinatoire'],

                ['id' => '5', 'name' => 'Theater'],

                ['id' => '6', 'name' => 'Cinema'],

                ['id' => '7', 'name' => 'Other'],
              ];
               if($category_id==3){
                 $array_type_caters=array();
                  $array_type_caters["name_of_meal"]=$name_of_meal;
                  $array_type_caters["option_of_meal"]=$option_of_meal;
                  $array_type_caters["type_of_meal"]=$type_of_meal;
                  $array_type_caters["vegan"]=$vegan;
                  $array_type_caters["glutenfree"]=$glutenfree;
                  $array_type_caters["Halal"]=$Halal;
                  $array_type_caters["Kosher"]=$Kosher;
                  $array_type_caters["Organic"]=$Organic;
                  $array_type_caters["Withoutpork"]=$Withoutpork;
                  $array_type_caters["price_serveur"]=$price_serveur;
                  $array_type_caters["minimal_consamtion"]=$min_consomation;
                  ////
                  $array_type_caters_compressed=json_encode($array_type_caters);
                //affecter le type des champre au tableau message qui sera affecter dans la notifivation
                $msg['type']= $array_type_caters_compressed;

               }
              //we will construct array for type room_rental
                $array_type_room_rental=array();
              //Space for Rent and Type of Room and Are in m2 and some question
              //here construct the array of room_rental
               //$array_type_room_rental["."]
                $array_type_room_rental["area"]=$produit_l_area;
                $array_type_room_rental["caution"]=$produit_l_caution;
                $array_type_room_rental["produit_option"]=$produit_l_produit_option;
                $array_type_room_rental["produit_type"]=$produit_l_produit_type;
                $array_type_room_rental["event_cake"]=$produit_l_event_cake;
                $array_type_room_rental["drink"]=$produit_l_drink;
                $array_type_room_rental["External_food"]=$produit_l_External_food;
                $array_type_room_rental["External_Catering"]=$produit_l_External_Catering;
                $array_type_room_rental["Internal_Catering"]=$produit_l_Internal_Catering;
                $array_type_room_rental["Without_guarantee"]=$produit_l_Without_guarantee;
                $array_type_room_rental["Minimum_consumption_Price"]=$produit_l_Minimum_consumption_Price;
                $array_type_room_rental["Wifi"]=$produit_l_Wifi;
                $array_type_room_rental["Board"]=$produit_l_Board;
                $array_type_room_rental["System_Sound"]=$produit_l_System_Sound;
                $array_type_room_rental["Micro"]=$produit_l_Micro;
                $array_type_room_rental["To_bring_back_cake_of_the_event"]=$produit_l_To_bring_back_cake_of_the_event;
                $array_type_room_rental["To_bring_back_drinks"]=$produit_l_To_bring_back_drinks;
                $array_type_room_rental["Parking_lot"]["name"]=$produit_l_Parking_lot;
                $array_type_room_rental["Parking_lot"]["field"]=$produit_l_Parking_lot_field;
                $array_type_room_rental["Subway"]["name"]=$produit_l_Subway;
                $array_type_room_rental["Subway"]["field"]=$produit_l_Subway_field;
                $array_type_room_rental["Train"]["name"]=$produit_l_Train;
                $array_type_room_rental["Train"]["field"]=$produit_l_Train_field;
                $array_type_room_rental["Bus"]["name"]=$produit_l_Bus;
                $array_type_room_rental["Bus"]["name"]=$produit_l_Bus_field;
                $array_type_room_rental_compressed=json_encode($array_type_room_rental);
                //affecter le type des champre au tableau message qui sera affecter dans la notifivation
                $msg['type']= $array_type_room_rental_compressed;
               //first saving the option of the produtct
                $id_product_option=0;
                $id_product_type=0;

                $product_type=new ProductType();
             if($category_id==8){
              $product_type->nom=$Produit_type_array[$Produit_type]['name'];
                  if($product_type->save())
                  {
                      $id_product_type=$product_type->id;
                   /// echo "sucess saving product_option_array";
                }else{
                  echo "Fail saving product_option_array";
                  print_r( $product_type->getAttributes());
                  print_r( $product_type->getErrors());
                  exit;
                }
             }   if($category_id==1||$category_id==3){
                      if($category_id==1)
                       $product_type->nom=$array_type_room_rental_compressed;
                      if($category_id==3)
                       $product_type->nom=$array_type_caters_compressed;

                  if($product_type->save())
                  {
                      $id_product_type=$product_type->id;
                    //echo "sucess saving product_option_array";
                }else{
                  echo "Fail saving product_option_array";
                  print_r( $product_type->getAttributes());
                  print_r( $product_type->getErrors());
                  exit;
                }
             }

             $partenaire_model=Partner::find()
            ->where( [ 'user_id' => $user_id ] )->one();
             //creating a json array of product_option
             //
             $product_option_array= array();
             //$product_option_array['id']=$produit_price_day;
             //$product_option_array['product_name']=$produit_price_day;
             $product_option_array['price_day']=$produit_price_day;
             $product_option_array['price_night']=$produit_price_night;
             //for product options

             //if existing languages adding them to the array
             if($category_id==6)
             {
              if($produit_l_arbic==1)
              $product_option_array['arabic']="arabic";
              if($produit_l_frensh==1)
              $product_option_array['french']="frensh";
              if($produit_l_english==1)
              $product_option_array['english']="english";
              if($produit_l_deutsh==1)
              $product_option_array['deutsh']="deutsh";
              if($produit_l_japenesse==1)
              $product_option_array['japenesse']="japenesse";
             }
             $product_array=json_encode($product_option_array);
              $product_option=new ProductOption();
             $product_option->name= $product_array;

              if($product_option->save())
                  {
                      $id_product_option=$product_option->id;
                      //we need to do an update on the json stored on the name
                      $array=json_decode($product_option->name,true);
                      $array['id']=$id_product_option;
                      $name=json_encode($array);
                      $model=ProductOption::find()->andwhere(['id'=>$id_product_option])->one();
                      $model->name=$name;
                      $model->update();
                 //   echo "sucess saving product_option_array";
                }else{
                  echo "Fail saving product_option_array";
                  print_r( $product_option->getAttributes());
                  print_r( $product_option->getErrors());
                  exit;
                }
                //afecter les option au tableau msg
              $msg['option']=$product_array;


             $partenaire_category_model=PartnerCategory::find()->where(['id'=>$category_id])->one();
             $product_model=new Product();
             $expression = new Expression('NOW()');
             $now = (new \yii\db\Query)->select($expression)->scalar();
             $product_model->partner_category=$partenaire_category_model->id;
             $product_model->name=$produit_nom;
             $product_model->description="xx";
             $product_model->picture=$produit_image_Name;
          if($product_model->validate()){
              $product_model->photo->saveAs('uploads/' . $product_model->photo->baseName . '.' . $product_model->photo->extension);
              $product_model->save();
              //return $this->redirect(['index']);
          }

             $product_model->price=$produit_price;
             $product_model->currencies_symbol=$currencies_symbol;
             $product_model->number_people=0;
             if($category_id==5)
             $product_model->number_people=$produit_nombre_de_perssone;
             $product_model->quantity=$produit_nombre_de_equipement;
             $product_model->duration=0;
            // $product_model->product_type_id=0;
             if($category_id==8||$category_id==1)
               $product_model->product_type_id=$id_product_type."";
               $product_model->product_option_id=$id_product_option;
               $product_model->condition="xxx";
               $product_model->availability="xxx";
               $product_model->partner_id=$partenaire_model->id;
               $product_model->extra=$array_services;
               $product_model->status="s";
               $expression = new Expression('NOW()');
               $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
               $timestamp = strtotime($now);
               $product_model->created_at=$timestamp;
               $product_model->updated_at=$timestamp;
               $msg['partner_category']=$product_model->partner_category;
               $msg['name']=$product_model->name;
               $msg['description']=$product_model->description;
               $msg['picture']=$product_model->picture;
               $msg['price']=$product_model->price;
               $msg['number_people']=$product_model->number_people;
               $msg['quantity']=$product_model->quantity;
               $msg['duration']=$product_model->duration;
               $msg['product_type_id']=$product_model->product_type_id;
               $msg['product_option_id']=$product_model->product_option_id;
               $msg['condition']=$product_model->condition;
               $msg['availability']=$product_model->availability;
               $msg['partner_id']=$product_model->partner_id;
               $msg['extra']=$product_model->extra;
               $msg['status']=$product_model->status;
               $msg['created_at']=$product_model->created_at;
               $msg['updated_at']=$product_model->updated_at;
               // the max of auto inctrement
               $isok=true;

             //  $transaction = Yii::$app->db->beginTransaction();
           /*   if(!$product_model->save()){ // can be saved normally
                     echo "string";
                     $isok=false;
                     die();
              }


        if ($isok == true) {
           $transaction->commit();
            echo 'successful!';
        } else {
        $transaction->rollBack();
           echo 'something wrong!';

        }*/


             if($product_model->save())
                  {
                    echo "sauvgarde";
                   //  echo   $product_model->id."nex id";
                   // echo "sucess saving step3";
                }else{
                     if($product_model->update())
                  {
                    echo "sucess updating step3";
                }
                 else {
                  echo "Fail updat Step3";
                  print_r( $product_model->getAttributes());
                  print_r( $product_model->getErrors());
                  exit;
              }
                }


            return($msg);
    }

    public function actionSend()
{

          $msg=array();
          $Produit_option= [

          ['id' => '1', 'name' => '  Some tables'],

          ['id' => '2', 'name' => 'Enclosed space'],

          ['id' => '3', 'name' => 'Full privatization'],

          ['id' => '4', 'name' => 'Other']

        ];
         $Produit_type= [

          ['id' => '1', 'name' => 'Meeting'],

          ['id' => '2', 'name' => 'Conference'],

          ['id' => '3', 'name' => 'Cocktail'],

          ['id' => '4', 'name' => 'Dinatoire'],

          ['id' => '5', 'name' => 'Theater'],

          ['id' => '6', 'name' => 'Cinema'],

          ['id' => '7', 'name' => 'Other'],
        ];
            $model= new \app\models\forms\GeneralInformationForm();
            $model3 = new \app\models\forms\ServicesAndPriceForm();
    if ($model->load(Yii::$app->request->post())){
            $category_id=$model->cat_id;
            $user_id=User::getCurrentUser()->id;
  ///partie 1 du formulaire
            if($model->idi==1){
              $name=$model->firstName;
              $lastName=$model->lastName;
              $tel=$model->tel;
              $mobile=$model->mobile;
              $fax=$model->fax;
              $email=$model->email;

              $this->save_partner_step1($user_id,$category_id,$name,$email,$tel,$fax);
              }
//parite 2 du forumlaire
              if($model->idi==2){

              $companyAddress=$model->companyAddress;
              $companyAddress_N=$model->companyAddress_N;
              $city=$model->city;
              $state=$model->state;
              $postalCode=$model->postalCode;
              $country=$model->country;

              $this->save_partner_step2($user_id,$category_id,$companyAddress,$companyAddress_N,$city,$state,$postalCode,$country);

              }

              if($model->idi==3&&$model3->load(Yii::$app->request->post())){

                //methode de sauvgarde de tous ces données
                $produit_nom= $model3->description;
                $produit_description= $model3->description1;
                //saving image
                Yii::setAlias('@productImgPath','C:\xampp\htdocs\clicangoevent\mainrepo\web\img\products');
                $produit_image= $model3->imageFile;
                $produit_image =UploadedFile::getInstance($model3, 'imageFile');
                $produit_image_Name='product'.$produit_nom.'.'.$produit_image->getExtension();
                $produit_image->saveAs(Yii::getAlias('@productImgPath').'/'.$produit_image_Name);
                $produit_nombre_de_perssone= $model3->nombre_de_persson;
                $produit_nombre_de_equipement= $model3->nombre_de_equipement;
                $produit_check_day=$model3->working_day;
                $produit_check_night=$model3->working_night;
                $produit_price_day=$model3->prix_day;
                $produit_price_night=$model3->prix_night;
                $produit_l_arbic=$model3->Arabic;
                $produit_l_frensh=$model3->Frensh;
                $produit_l_english=$model3->English;
                $produit_l_deutsh=$model3->Deutsh;
                $produit_l_japenesse=$model3->Japenesse;
                //for the room rental

                $produit_l_area= $model3->area;
                $produit_l_caution= $model3->caution;
                if($category_id==1){
                  $produit_l_produit_option= $Produit_option[$model3->produit_option]['name'];
                $produit_l_produit_type= $Produit_type[$model3->produit_type]['name'];
              }else{
                 $produit_l_produit_option= "xxx";
                $produit_l_produit_type= "xxx";

              }

                $produit_l_event_cake= $model3->event_cake;
                $produit_l_drink= $model3->drink;
                $produit_l_External_food= $model3->External_food;
                $produit_l_External_Catering=$model3->External_Catering;
                $produit_l_Internal_Catering= $model3->Internal_Catering;
                $produit_l_Without_guarantee=$model3->Without_guarantee;
                $produit_l_Minimum_consumption_Price=$model3->Minimum_consumption_Price;
                $produit_l_Wifi=$model3->Wifi;
                $produit_l_Board=$model3->Board;
                $produit_l_System_Sound=$model3->System_Sound;
                $produit_l_Micro=$model3->Micro;
                $produit_l_To_bring_back_cake_of_the_event=$model3->To_bring_back_cake_of_the_event;
                $produit_l_To_bring_back_drinks=$model3->To_bring_back_drinks;
                $produit_l_Parking_lot=$model3->Parking_lot;
                $produit_l_Parking_lot_field=$model3->Parking_lot_field;
                $produit_l_Subway=$model3->Subway;
                $produit_l_Subway_field=$model3->Subway_field;
                $produit_l_Train=$model3->Train;
                $produit_l_Train_field=$model3->Train_field;
                $produit_l_Bus=$model3->Bus;
                $produit_l_Bus_field=$model3->Bus_field;
                $produit_type=$model3->produit_type;
                //if($category_id==3){
                  $name_of_meal=$model3->produit_nom;
                  $option_of_meal=$model3->produit_option;
                  $type_of_meal=$model3->produit_type;
                  $vegan=$model3->vegan;
                  $glutenfree=$model3->glutenfree;
                  $Halal=$model3->Halal;
                  $Kosher=$model3->Kosher;
                  $Organic=$model3->Organic;
                  $Withoutpork=$model3->Withoutpork;
                  $price_serveur=$model3->prix_serveur;
                  $min_consomation=$model3->min_consomation;
               // }

                if($category_id==4||$category_id==5||$category_id==6||$category_id==7||$category_id==8||$category_id==3)
                  $produit_price= 0.0;
                else
                  $produit_price= $model3->price;
                $produit_prix_heure= $model3->prix_heure;
                //array
                $array=array();

                foreach ($model3->services as $elements) {
                  //echo $elements['Description'].'/';
                 // echo $elements['Quantity'].'/';
                //echo $elements['Price'].'/';
                  //push
                 // $array[]=json_encode($elements);

                }

                $services=json_encode($model3->services);




               $msg[]=$this->save_partner_step3($user_id,$category_id,$produit_nom,$produit_description,$produit_image,$produit_nombre_de_perssone,$produit_nombre_de_equipement,$produit_price, $produit_prix_heure,$services,$produit_check_day,$produit_check_night,$produit_price_day,$produit_price_night,$produit_l_arbic,$produit_l_frensh,$produit_l_english,$produit_l_deutsh,$produit_l_japenesse,$produit_type,$produit_l_area,$produit_l_caution,$produit_l_produit_option,$produit_l_produit_type,$produit_l_event_cake,$produit_l_drink,$produit_l_External_food,$produit_l_External_Catering,$produit_l_Internal_Catering,$produit_l_Without_guarantee,$produit_l_Minimum_consumption_Price,$produit_l_Wifi,$produit_l_Board,$produit_l_System_Sound,$produit_l_Micro,$produit_l_To_bring_back_cake_of_the_event,$produit_l_To_bring_back_drinks,$produit_l_Parking_lot,$produit_l_Parking_lot_field,$produit_l_Subway,$produit_l_Subway_field,$produit_l_Train,$produit_l_Train_field,$produit_l_Bus,$produit_l_Bus_field,$name_of_meal,$option_of_meal,$type_of_meal,$vegan,$glutenfree,$Halal,$Kosher,$Organic,$Withoutpork,$price_serveur,$min_consomation,$produit_image_Name);
              }
                //créeer partie question partenair et partie question
                 $Questions= [

                ['id' => '1', 'name' => 'General Information'],

                ['id' => '2', 'name' => 'Availability and Displacement'],

                ['id' => '3', 'name' => 'Service and Prices'],

                ['id' => '4', 'name' => 'Conditions'],

                ['id' => '5', 'name' => 'Payments'],

                ['id' => '6', 'name' => 'Messages'],
              ];
                //insert data into qstList
            $qstList=new QuestionsList();
                $qstList->partner_category_id=$category_id;
             if ( $qstList->save()) {
                   echo "question_list saved";
             }
                else {
                  echo "question_list_no_sauvgarder";
                  print_r( $qstList->getAttributes());
                  print_r( $qstList->getErrors());
                  exit;
                }
               $id= User::getCurrentUser()->id;
               $id_p=Partner::find()->andwhere(['user_id' =>$id])->one();
               //a reflichir
               //partie question list a revoir apres
               $id_int=(int)$id_p->id;
               $id_qst_list=$qstList->id;
              // $id_qst_list = QuestionsList::find()->max('id');
               $id_qst_partner_to_next_id_partner= QuestionsPartner::find()->max('id')+1;
//partie sauvgarde du question partenaire
                $qstpartnair_exist=QuestionsPartner::find()->andwhere(['questions_id'=>$id_qst_list])->one();
                $qstpartnair=new QuestionsPartner();
                $qstpartnair->id=$id_qst_partner_to_next_id_partner;
                $qstpartnair->questions_id=$id_qst_list;
                $qstpartnair->partner_id=$id_int;
               // $qstpartnair->lock=1;
                $qstpartnair->status=1;
                $expression = new Expression('NOW()');
                $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
                $timestamp = strtotime($now);;
                $qstpartnair->created_at=$timestamp;
                //
                $qstpartnair->updated_at=$timestamp;

               // echo $qstpartnair_exist->id;
             $isok=true;
               $transaction = Yii::$app->db->beginTransaction();
               if($qstpartnair->isNewRecord )
                 {
                  $qstpartnair->save();
                  $isok=true;
                }
               else
              if(!$qstpartnair->save()){ // can be saved normally
                     echo "string";
              }
        if ($isok == true) {
           $transaction->commit();
            echo 'successful!';
        } else {
        $transaction->rollBack();
           echo 'something wrong!';

        }

            if (!empty($qstpartnair_exist)){


                if ( $qstpartnair->update()) {
                    echo "qst partenaire updated";
               }
                else{
                echo "MODEL qst_partenaire NOT updated";
                    print_r( $qstpartnair->getAttributes());
                    print_r( $qstpartnair->getErrors());
                    exit;
               }
            }  else{
                 if ( $qstpartnair->save()) {
                    echo "qst partenaire saved";
               }
              else {

                echo "MODEL qst_partenaire NOT SAVED";
                    print_r( $qstpartnair->getAttributes());
                    print_r( $qstpartnair->getErrors());
                    exit;
                  }

            }

        //think to save data in the question with the checing the face of passing and saving data to pass to the next step

        $url=$model->idi;
        $id_of_url=1;
        foreach ($Questions as $question) {
          $question_model=new Questions();
          $question_model->questions_list_id=$id_qst_list;
          $question_model->name=$question['name'];
          $question_model->status=0;
          echo $question['id'];
          if($url==$question['id'])
            $question_model->status=1;
          $question_model->url='?r=welcome/step&id='.$id_of_url.'&category_id='.$category_id;
          $id_of_url++;
          //partie de sauvgarde
               if ( $question_model->save()) {
                    echo "Question saved";
             }
            else {
                  if($question_model->update()) {
                    echo "Question updated";
             } else{
               echo "Questiin NOT SAVED";
                   print_r( $question_model->getAttributes());
                   print_r( $question_model->getErrors());
                   exit;
             }

        }
      }
          if($model->idi==3){

             $msg=json_encode($msg);

             $user = User::find()->where(['id'=>1])->one();

          AccountNotification::create(AccountNotification::KEY_NEW_PRODUCT,$msg,
                     ['user' =>$user])->send();
             Yii::$app->session->setFlash('success', "Add another product");
              return $this->redirect(Url::to(['welcome/step','id'=>$model->idi,'category_id'=>$category_id]));
          }
          

          return $this->redirect(Url::to(['welcome/step','id'=>$model->idi+1,'category_id'=>$category_id]));

        }

}

    function actionStep($id, $category_id) {
           $model = new \app\models\forms\GeneralInformationForm();
           $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
           $id_partenaire=$partner->id;
      //  if($id==2){
            //creer un partenaire avec des valeur de champs vide

        // if($category_id==3){
             //creation array for caters
                 //$caters=array();
                 //$caters=["Breakfast","Lunch/Dinner","Lunch","Dinner","Cocktails(sweet and savoury","Salty buffet","Sweet Buffet","Sweet & salty buffet" ];
                 //

                 //create model production
              /*   $product_model=new Product();
                 //get the id of the partenair

                 $id_partenaire=Partner::find()->andwhere(['id'=>User::getCurrentUser()->id]);
             foreach ($caters as $cater) {
                 $product_model->name=$cater;
                 $product_model->price=0;
                 $product_model->quantity=0;
                 $product_model->product_type_id=0;
                 $product_model->condition="xxxx";
                 $product_model->availability="xxxxx";
                 $product_model->partner_id=$id_partenaire;
                 //$product_model->save();
             }*/
             //insertdata
       //           } else {


       //  }

       // }
        /*if($id==4){
            echo "string";
                $model3 = new \app\models\forms\ServicesAndPriceForm();
             if ($model3->load(Yii::$app->request->post()) && $model->validate()){

                $model3->save(); // skip validation as model is already validated

        }*/


 //   }

        $category = PartnerCategory::find()->where(['id' => $category_id])->one();
        $Produit = Product::find()->andwhere(['partner_category' => $category_id])->all();
        $Produit_option=array();
        //hint i've deleted the category and product id from the table product option
       // $Produit_option=ProductOption::find()->andwhere(['category_id'=> $category_id])->all();
        //$Produit_type=ProductType::find()->andwhere(['category_id' => $category_id])->all();
       // print_r($Produit);
        if (!$category){
            return $this->redirect(['welcome/index']);
        }
        $this->layout = 'welcome';

        $model3 = new \app\models\forms\ServicesAndPriceForm();
        if (Yii::$app->request->post() && $model->validate()){

            $partner = new Partner();
            $partner->user_id = User::getCurrentUser()->id;
            $partner->name = $model->companyName;
            $partner->description = $model->firstName.', '.$category->name;
            $partner->address = $model->companyAddress;
            $partner->country = '<Country>';
            $partner->city = '<City>';
            $partner->category_id = $category->id;
            if ($partner->save()){
                return $this->render('step2', [
//                    'welcome/step', 'id' => 2,
                    'model' => new \app\models\forms\AvailabilityForm(),
                    'category_id' => $category->id]);
            } else {
//
                Yii::$app->session->setFlash('danger',Yii::t('app',
                    'Cannot validate Partner information.')
                );
                return $this->render('index',[
                    'errors' => $partner->errors,
                   'categories' => PartnerCategory::find()->all()
                ]);
            }
        }
         $questionsList = QuestionsList::find()->one();
         $questions = Questions::find()->where(['id' => $questionsList->id])->all();
         //gathering data from the data
         $eventos=[];

        $ProductItem=[new ProductItem];
       ///partie des produit option et type
                $Produit_option= [

          ['id' => '1', 'name' => '  Some tables'],

          ['id' => '2', 'name' => 'Enclosed space'],

          ['id' => '3', 'name' => 'Full privatization'],

        ];

         $Produit_type= [

          ['id' => '1', 'name' => 'Meeting'],

          ['id' => '2', 'name' => 'Conference'],

          ['id' => '3', 'name' => 'Cocktail'],

          ['id' => '4', 'name' => 'Dinatoire'],

          ['id' => '5', 'name' => 'Theater'],

          ['id' => '6', 'name' => 'Cinema'],

          ['id' => '7', 'name' => 'Other'],
        ];
        $id_user=User::getCurrentUser()->id;
      //traying to getting partener id
        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
        $partner_id=$partner->id;
         $other_options=Other::find()->andwhere(['partener_id'=>$partner_id,'type'=>0])->all();
            $other_types=Other::find()->andwhere(['partener_id'=>$partner_id,'type'=>1])->all();
          $i=0;
          $i=$i+3;
          foreach ($other_options as $other_option) {

            $i++;
           // echo $i;
            $Produit_option[$i]['name']=$other_option->name;
            //echo $other_option->name ;

          }
          $i=$i+1;
          $Produit_option[$i]['name']="Other";
          $i=0;
          //die();

    if($category_id==1)
       return $this->render('Room_Rental/step'.$id, [
            'model' => $model,
            'model3'=>$model3,
            'Produit'=>$Produit,
            'Produit_option'=>$Produit_option,
            'Produit_type'=>$Produit_type,

            'id_partenaire'=> $id_partenaire


        ]);
        //check the category_type to send to different folder
     if($category_id==2)
       return $this->render('equipment/step'.$id, [
            'model' => $model,
            'model3'=>$model3,
            'Produit'=>$Produit,
            'Produit_option'=>$Produit_option,
            'id_partenaire'=> $id_partenaire,
            'ProductsItem'=>$ProductItem
        ]);
    if($category_id==3)
       return $this->render('CATERERS/step'.$id, [
            'model' => $model,
            'model3'=>$model3,
            'Produit'=>$Produit,
            'Produit_option'=>$Produit_option,
            'Produit_type'=>$Produit_type,
            'events'=> $eventos,
            'ProductsItem'=>$ProductItem,
            'id_partenaire'=> $id_partenaire
        ]);
    if($category_id==4)
       return $this->render('photo/step'.$id, [
            'model' => $model,
            'model3'=>$model3,
            'Produit'=>$Produit,
            'Produit_option'=>$Produit_option,
            'Produit_type'=>$Produit_type,
            'events'=> $eventos,
            'id_partenaire'=> $id_partenaire
        ]);
        //check the category_type to send to different folder
     if($category_id==5)
       return $this->render('animation/step'.$id, [
            'model' => $model,
            'model3'=>$model3,
            'Produit'=>$Produit,
            'Produit_option'=>$Produit_option,
            'Produit_type'=>$Produit_type,
            'events'=> $eventos,
            'id_partenaire'=> $id_partenaire
        ]);
    if($category_id==6)
       return $this->render('security/step'.$id, [
            'model' => $model,
            'model3'=>$model3,
            'Produit'=>$Produit,
            'Produit_option'=>$Produit_option,
            'Produit_type'=>$Produit_type,
            'events'=> $eventos,
            'id_partenaire'=> $id_partenaire
        ]);
   if($category_id==7)
       return $this->render('hosts/step'.$id, [
            'model' => $model,
            'model3'=>$model3,
            'Produit'=>$Produit,
            'Produit_option'=>$Produit_option,
            'events'=> $eventos,
            'id_partenaire'=> $id_partenaire
        ]);
        $Produit_type= [

          ['id' => '1', 'name' => 'Minibus-'],

          ['id' => '2', 'name' => 'Bus'],

          ['id' => '3', 'name' => 'Coach'],

          ['id' => '4', 'name' => 'other']
        ];
   if($category_id==8)
       return $this->render('transport/step'.$id, [
            'model' => $model,
            'model3'=>$model3,
            'Produit'=>$Produit,
            'Produit_option'=>$Produit_option,
            'events'=> $eventos,
            'Produit_type'=>$Produit_type,
            'id_partenaire'=> $id_partenaire
        ]);
    }
    public function actionBlank(){
      return $this->render('blank');
    }
}
