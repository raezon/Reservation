<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Product;
use app\models\ProductItem;
use app\models\ProductItemCamera;
use app\models\ProductParent;
use app\models\base\TblEvents;
use app\models\Partner;
use app\models\PartnerCategory;
use app\models\AccountNotification;
use yii\db\Expression;
use yii\helpers\Url;
use app\models\PaymentCondition;
use DateTime;
use DatePeriod;
use DateInterval;

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
        'only' => ['index', 'save'],
        'rules' => [
          [
            'allow' => true,
            //                      'actions' => ['index'],
            //                        'roles' => ['@']
            'roles' => [User::ROLE_PARTNER,'@']
          ],
          //                    [
          //                        'allow' => false
          //                    ]
        ]
      ]
    ];
  }

  function getDatesFromRange($start, $end, $format = 'Y-m-d')
  {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach ($period as $date) {
      $array[] = $date->format($format);
    }

    return $array;
  }
  public function actionIndex()
  {
   
    $this->layout = 'main2';
    $user_id = User::getCurrentUser()->id;
    $name = bin2hex(openssl_random_pseudo_bytes(4));
    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    if (empty($partner))
      $this->save_partner($user_id, 9, $name . '');
    
    $session = Yii::$app->session;
    $session->open(); // open a session
    if (!empty($partner)) {
      $id_partenaire = $partner->id;
      $session['partner_id'] = $id_partenaire;
    }
 
    $categories = PartnerCategory::find()->all();
    //Partie event 
    $date_of_starting = date("Y-m-d");
    $end_of_starting = date('Y-m-d', strtotime('+3 Years'));
    //adding to the date of now
    //partie insertion dans la table event
    $date_of_starting = date("Y-m-d");
    $end_of_starting = date('Y-m-d', strtotime('+3 Years'));
    //adding to the date of now
    $array = $this->getDatesFromRange($date_of_starting, $end_of_starting);
    //insert $data in the model even
    $i = 0;
    $numItems = count($array);

    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    $id_partenaire = $partner->id;
    $exist = TblEvents::find()->where(['partner_id' => $partner->id])->one();
    $i =  TblEvents::find()->orderBy('id DESC')->limit(1)->one();
    $i = $i->id + 1;
    if (is_null($exist)) {
      $session['refresh'] = 1;
      foreach ($array as $key => $value) {
        $model5 = new TblEvents();
        $model5->id = $i;
        $model5->title = "Availability";
        $time1 = strtotime($array[$key]);
        $value1 = date('Y-m-d', $time1);
        if (++$i == $numItems) {
          $time2 = strtotime($array[$key]);
          $value2 = date('Y-m-d', $time2);
        } else {
          if (array_key_exists($key + 1, $array)) {
            $time2 = strtotime($array[$key + 1]);
            $value2 = date('Y-m-d', $time2);
          }
        }

        $model5->title = "Available";
        $model5->partner_id = $id_partenaire;
        $model5->start = $value1;
        $model5->end = $value2;
        $model5->save();
        if (++$i == $numItems) {
        }
      }
    }
    // $this->layout = 'blank';
    //doing our checking

    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    if (!empty($partner)) {
      $product_parent = ProductParent::find()->andwhere(['partner_id' => $partner->id])->one();
      if (!empty($product_parent))
        return $this->redirect(Url::to(['welcome/step', 'id' => 3, 'category_id' => $product_parent->partner_category]));
      else{
       // print_r($partner);
      //  die();
        return $this->render('index', [
          'categories' => $categories
        ]);
      }
        
    }
    return $this->render('index', [
      'categories' => $categories
    ]);
  }
  function save_partner($user_id, $category_id, $name)
  {
    //crée un nom aléatoire
    //verifier si partenair don't exisit
    $partenaire_existance = Partner::find()
      ->where(['user_id' => $user_id])
      ->exists();
    //verifier si le partenair exisit
    $product_model = Partner::find()
      ->where(['user_id' => $user_id])->one();
    //dans le cas partenaire n'existe pas
    if (!$partenaire_existance) {
      $Name = bin2hex(openssl_random_pseudo_bytes(4));
      $product_model = new Partner();
    }
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW();
    // prints the current date
    // prints the current date
    $product_model->name = $name;
    $product_model->description = "xxxx";
    $product_model->address = "xxxx";
    $product_model->tel = "xxxx";
    $product_model->fax = "xxxx";
    $product_model->web_site = "xxxx";
    $product_model->country = "xxxx";
    $product_model->city = "xxxx";
    $product_model->companyAddress = "xxxx";
    $product_model->companyAddress_N = "xxxx";
    $product_model->postal_code = "xxxx";
    $product_model->keywords = "xxxx";
    $product_model->email = "xxxx";
    $product_model->picture = "xxxx";
    $product_model->user_id = $user_id;
    $product_model->category_id = $category_id;
    $product_model->status = 0;
    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
    $timestamp = strtotime($now);;
    $product_model->created_at = $timestamp;
    $product_model->updated_at = $timestamp;
    //$product_model->updated_at=$timestamp;
    //dans le cas que le partenair exist dej
    if ($partenaire_existance) {
      if ($product_model->update()) {
        //echo "sucess update partenair";
      } else {
        echo "UPDAT MODEL NOT SAVED partenair";
        //print_r( $product_model->getAttributes());
        print_r($product_model->getErrors());
        exit;
      }
    }
    //dans le cas que le partenaire n'exist pas
    else {
      if ($product_model->save()) {
      } else {
        echo "SAVE";
        echo "MODEL NOT SAVED";
        print_r($product_model->getAttributes());
        print_r($product_model->getErrors());
        exit;
      }
    }
  }

  public function actionCategory($id = 0)
  {
    //creating the intial
    $category = PartnerCategory::find()->where(['id' => $id])->one();
    if ($category) {
      //task to do finalise the
      return $this->redirect([
        'welcome/step', 'id' => 1,
        'model' => new \app\models\forms\GeneralInformationForm(),
        'category_id' => $category->id
      ]);
    }
    return $this->redirect(['welcome/index']);
  }

  public function actionSend()
  {
    $modelStep1 = new \app\models\forms\GeneralInformationForm();
    $modelStep2 = new \app\models\forms\AvailabilityForm();
    $modelStep3 = new \app\models\forms\ServicesAndPriceForm();
    $msg = array();

    if ($modelStep1->load(Yii::$app->request->post())  || $modelStep2->load(Yii::$app->request->post())  || $modelStep3->load(Yii::$app->request->post())) {

      $category_id = $modelStep1->cat_id;
      $user_id = User::getCurrentUser()->id;
      ///partie 1 du formulaire
      if ($modelStep1->idi == 1) {
        Yii::$app->step1->save_partner_step1($modelStep1, $user_id, $category_id,null);
        return $this->redirect(Url::to(['welcome/step', 'id' => $modelStep1->idi + 1, 'category_id' => $category_id]));
      }

      //parite 2 du forumlaire
      if ($modelStep2->idi == 2) {
        $category_id = $modelStep2->cat_id;
        Yii::$app->step2->save_partner_step2($user_id, $category_id, $modelStep2);
        return $this->redirect(Url::to(['welcome/step', 'id' => $modelStep2->idi + 1, 'category_id' => $category_id]));
      }
      //parite 3 du forumlaire
      if ($modelStep1->idi == 3 && $modelStep3->load(Yii::$app->request->post())) {
        $category_id = 1;
        $msg[] = Yii::$app->step3->save_partner_step3($user_id, $category_id, $modelStep3);
      }
      //sending Notification if it is okey
      if ($modelStep3->idi == 3) {
        $msg = json_encode($msg);
        $user = User::find()->where(['id' => User::getCurrentUser()->id])->one();
        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
        AccountNotification::create(
          AccountNotification::KEY_NEW_PRODUCT,
          $msg,
          $user->username,
          $partner->name
        )->send();
        //sending a flash message
        Yii::$app->session->setFlash('success', "Add another product");
        return $this->redirect(Url::to(['welcome/step', 'id' => $modelStep3->idi, 'category_id' => $category_id]));
      }
      return $this->redirect(Url::to(['welcome/step', 'id' => $modelStep1->idi + 1, 'category_id' => $category_id]));
    }
  }

  function actionStep($id, $category_id)
  {
    $this->layout = 'welcome';
    //partie declaration
    $modelStep1 = new \app\models\forms\GeneralInformationForm();
    $modelStep2 = new \app\models\forms\AvailabilityForm();
    $modelStep3 = new \app\models\forms\ServicesAndPriceForm();
    $ProductParent = new \app\models\ProductParent();
    $ProductItem = [new ProductItem];
    $ProductItemCamera = [new ProductItemCamera];
    $Produit = Product::find()->andwhere(['partner_category' => $category_id])->all();
    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    $id_partenaire = $partner->id;
    $category = PartnerCategory::find()->where(['id' => $category_id])->one();
    if (!$category) {
      return $this->redirect(['welcome/index']);
    }

    if (Yii::$app->request->post() && $modelStep1->validate()) {

      $partner = new Partner();
      $partner->user_id = User::getCurrentUser()->id;
      $partner->name = $modelStep1->companyName;
      $partner->description = $modelStep1->firstName . ', ' . $category->name;
      $partner->address = $modelStep1->companyAddress;
      $partner->country = '<Country>';
      $partner->city = '<City>';
      $partner->category_id = $category->id;
      if ($partner->save()) {
        return $this->render('step2', [
          'model' => new \app\models\forms\AvailabilityForm(),
          'category_id' => $category->id
        ]);
      } else {
        //
        Yii::$app->session->setFlash('danger', Yii::t(
          'app',
          'Cannot validate Partner information.'
        ));
        return $this->render('index', [
          'errors' => $partner->errors,
          'categories' => PartnerCategory::find()->all()
        ]);
      }
    }

    $payments_conditions = new PaymentCondition();
    if ($category_id == 1)
      return $this->render('Room_Rental/step' . $id, [
        'model' => $modelStep1,
        'model2' => $modelStep2,
        'model3' => $modelStep3,
        'model5' => $payments_conditions,
        'Produit' => $Produit,
        'ProductsItem' => $ProductItem,
        'id_partenaire' => $id_partenaire
      ]);
    //check the category_type to send to different folder
    if ($category_id == 2)
      return $this->render('equipment/step' . $id, [
        'model' => $modelStep1,
        'model2' => $modelStep2,
        'model3' => $ProductParent,
        'model5' => $payments_conditions,
        'ProductsItem' => $ProductItem,
        'id_partenaire' => $id_partenaire
      ]);
    if ($category_id == 3)
      return $this->render('CATERERS/step' . $id, [
        'model' => $modelStep1,
        'model2' => $modelStep2,
        'model3' => $ProductParent,
        'model5' => $payments_conditions,
        'ProductsItem' => $ProductItem,
        'id_partenaire' => $id_partenaire
      ]);
    if ($category_id == 4)
      return $this->render('photo/step' . $id, [
        'model' => $modelStep1,
        'model2' => $modelStep2,
        'model3' => $ProductParent,
        'model5' => $payments_conditions,
        'ProductsItem' => $ProductItemCamera,
        'id_partenaire' => $id_partenaire
      ]);
    //check the category_type to send to different folder
    if ($category_id == 5)
      return $this->render('animation/step' . $id, [
        'model' => $modelStep1,
        'model2' => $modelStep2,
        'model3' => $ProductParent,
        'model5' => $payments_conditions,
        'ProductsItem' => $ProductItem,
        'id_partenaire' => $id_partenaire
      ]);
    if ($category_id == 6)
      return $this->render('security/step' . $id, [
        'model' => $modelStep1,
        'model2' => $modelStep2,
        'model3' => $ProductParent,
        'model5' => $payments_conditions,
        'ProductsItem' => $ProductItem,
        'id_partenaire' => $id_partenaire
      ]);
    if ($category_id == 7)
      return $this->render('hosts/step' . $id, [
        'model' => $modelStep1,
        'model2' => $modelStep2,
        'model3' => $ProductParent,
        'model5' => $payments_conditions,
        'ProductsItem' => $ProductItem,
        'id_partenaire' => $id_partenaire
      ]);
    if ($category_id == 9)
      return $this->render('other/step' . $id, [
        'model' => $modelStep1,
        'model2' => $modelStep2,
        'model3' => $ProductParent,
        'model5' => $payments_conditions,
        'ProductsItem' => $ProductItem,
        'id_partenaire' => $id_partenaire
      ]);
  }

  public function actionPayments($id, $category_id)
  {
    //a find
    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    $model1 = PaymentCondition::find()->where(['partner_id' => $partner->id])->one();
    $model = new PaymentCondition();
    if ($model->load(Yii::$app->request->post())) {

      $model1->iban = $model->iban;
      $model1->bic = $model->bic;
      $model1->bankname = $model->bankname;
      $model1->bankcountry = $model->bankcountry;
      $model1->File = "empty";
      if ($model1->update()) {
      } else {

        print_r($model1->getErrors());
        die();
      }
      return $this->redirect(Url::to(['welcome/step', 'id' => $id, 'category_id' => $category_id]));
    }
  }
  public function actionCondition($id, $category_id)
  {
    $model = new PaymentCondition();
    if ($model->load(Yii::$app->request->post())) {

      $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
      $model->iban = 0;
      $model->bic = 0;
      $model->bankname = "empty";
      $model->bankcountry = "empty";
      $model->File = "empty";
      $model->partner_id = $partner->id;
      $model->condition1 = "valid";
      if ($model->save()) {
      } else {
        print_r($model->getErrors());
        die();
      }
      return $this->redirect(Url::to(['welcome/step', 'id' => $id, 'category_id' => $category_id]));
    }
  }
  public function currenciesSymbol()
  {
    $currencies_symbol = "$";
    $geoip = new \lysenkobv\GeoIP\GeoIP();
    $ip = $geoip->ip(Yii::$app->request->getUserIP()); // current user ip
    $currencies = json_decode(file_get_contents('data.json'), true);
    foreach ($currencies as $currency) {
      if (strtoupper($currency['country']) == strtoupper($ip->isoCode)) {
        $currencies_symbol = $currency['currency'];
      }
    }
    if (empty($currencies_symbol))
      $currencies_symbol = "$";
    return $currencies_symbol;
  }
  public function  actionNext($id)
  {
    $modelCustomer = new ProductParent;
    $modelsAddress = [new ProductItem];
    $cat = 0;

    $expression = new Expression('NOW()');
    $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
    $timestamp = strtotime($now);
    //commanceant par sauvgarder le produit 
    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    //curencies
    $currencies_symbol = $this->currenciesSymbol();
    //component Next
    Yii::$app->saveNext->saveProduct($modelCustomer, $modelsAddress, $currencies_symbol, $timestamp);

    //Save Our Room Rental
    $msg = array();
    $model = new \app\models\forms\GeneralInformationForm();
    $model3 = new \app\models\forms\ServicesAndPriceForm();
    if ($model->load(Yii::$app->request->post())) {
      $category_id = $model->cat_id;
      $user_id = User::getCurrentUser()->id;
      ///partie 3 du formulaire
      if ($model->idi == 3 && $category_id == 1 && $model3->load(Yii::$app->request->post())) {
        $msg[] = Yii::$app->step3->save_partner_step3($user_id, $category_id, $model3);
      }
      //créeer partie question partenair et partie question
    }
    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    $model = PaymentCondition::find()->where(['partner_id' => $partner->id])->one();
    //Conditions de l'avancement du produits
    if (empty($cat))
      $cat = 1;
    if (!empty($model)) {

      if (!empty($model->iban))
        return $this->redirect(Url::to(['welcome/step', 'id' => 6, 'category_id' => $cat]));

      if (!empty($model->condition1 == "valid"))
        return $this->redirect(Url::to(['welcome/step', 'id' => 5, 'category_id' => $cat]));
    } else {
      return $this->redirect(Url::to(['welcome/step', 'id' => 4, 'category_id' => $cat]));
    }

    return $this->redirect(Url::to(['welcome/step', 'id' => 4, 'category_id' => $cat]));
  }
}
