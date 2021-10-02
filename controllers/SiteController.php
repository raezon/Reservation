<?php

namespace app\controllers;

use app\components\Filter;
use app\components\FilterBien;
use app\components\FilterCater;
use app\components\FilterHost;
use app\components\FilterOther;
use app\components\FilterPhoto;
use app\components\FilterRoom;
use app\components\FilterSecurity;
use app\components\FiltreAnimation;
use app\components\FiltreEquipement;
use app\controllers\notification\AccountNotification;
use app\models\base\TblEvents;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\modelMap;
use app\models\Notificationsuser;
use app\models\Partner;
use app\models\partner\RegistrationForm;
use app\models\Payment;
use app\models\Product;
use app\models\ProductItem;
use app\models\ProductItemSearch;
use app\models\ProductParent;
use app\models\Reservation;
use app\models\User;
use app\modules\survey\models\SurveyStat;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\Session;
use yii\web\UploadedFile;

class SiteController extends Controller
{

    //    public $defaultAction = 'login';
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        // for Access Control checkout: https://github.com/dektrium/yii2-user/blob/master/docs/custom-access-control.md
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
     * {@inheritdoc}
     */
    public function actionLog()
    {
        Yii::trace('trace log message');
        Yii::info('info log message');
        Yii::warning('warning log message');
        Yii::error('error log message');
    }
    public function actionSendAvis($product_id)
    {
        $model = new \app\models\Avis();

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($model->load(Yii::$app->request->post())) {
                $model->product_id = $product_id;
                $model->date = date("Y/m/d");
                $model->name=\app\models\User::find()->where(['id'=>User::getCurrentUser()->id])->one()->username;
                if ($model->save()) {
                  //  Yii::$app->session->setFlash('success', "Avis envoyer avec success");
                } else {
                    print_r($model->errors);
                    die();
                }
            }

        
        $model1 = \app\models\ProductItem::find()->where(['id'=>$product_id])->one();

        return $this->redirect(['/site/detail','amount' => $model1->price, 'product_id' => $model1->product_id, 'id' => $model1->id, 'deliveryPrice' => 0]);

    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @function getDistance()
     * Calculates the distance between two address
     *
     * @params
     * $addressFrom - Starting point
     * $addressTo - End point
     * $unit - Unit type
     *
     * @author CodexWorld
     * @url https://www.codexworld.com
     *
     */
    public function actionCongras()
    {
        return $this->render('reservation', []);
    }
    public function getDistance($addressFrom, $addressTo, $unit = '')
    {

        // Google API key
        $apiKey = 'AIzaSyB7Iz5ZKGr0_5l_LD47xNf9umU7GSiUVuw';

        // Change address format
        $formattedAddrTo = str_replace(' ', '+', $addressTo);
        $array_partner_filtered_by_address = array();
        // Geocoding API request with end address
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $apiKey);
        $outputTo = json_decode($geocodeTo);
        if (!empty($outputTo->error_message)) {
            return $outputTo->error_message;
        }
        $latitudeTo = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo = $outputTo->results[0]->geometry->location->lng;
        foreach ($addressFrom as $address) {
            //print_r($address);

            if ($address['latitude'] != 0) {

                // Geocoding API request with start address

                // Get latitude and longitude from the geodata
                $latitudeFrom = $address['latitude'];
                $longitudeFrom = $address['longitude'];

                // Calculate distance between latitude and longitude
                $theta = $longitudeFrom - $longitudeTo;
                $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;

                // Convert unit and return distance
                $unit = strtoupper($unit);

                $distance = round($miles * 1.609344, 2);

                $distance = (float) $distance;

                if ($distance < 30) {

                    $array_partner_filtered_by_address[] = $address['id'];
                }
            }
        }

        return $array_partner_filtered_by_address;
    }

    public function actionAdress()
    {
        $addressFrom = '12 Rue Ahmed Bououfa, Ain Benian, Algeria';
        $addressTo = '14 Rue Ahmed Bououfa, Ain Benian, Algeria';

        // Get distance in km
        $distance = $this->getDistance($addressFrom, $addressTo, "K");
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function checkIfRedirect($request, $result, $id)
    {

        //Our condition for a correct pagination
        if (!isset($_SESSION['base'])) {
            $_SESSION['base'] = 0;
        }
        if (!isset($_SESSION['page'])) {

            $_SESSION['page'] = -2;
        }

        //partie de verification pour qu'elle partie de redirectrion
        if (isset($_SESSION["pass"])) {
            if ($_SESSION["pass"] === 1) {
                $_SESSION['pass'] = 0;
                $_SESSION['page'] = -2;
            }
        }

        if (!empty($request->get('page'))) {
            $_SESSION['base'] = $_SESSION['base'] + 1;
            $id = $request->get('page');
            if ($id > 0) {
                $_SESSION['base'] = $_SESSION['base'] + 1;
                //try to do some of conditions with seassion
                if ($_SESSION['page'] == $id) {
                    if (empty($_SESSION['filter'])) {
                        //   $_SESSION['page'] = -2;
                        $_SESSION["pass"] = 1;
                        return 'pagination_category';
                    }
                    $_SESSION['page'] = -2;
                    $_SESSION["pass"] = 1;
                    return 'pagination_filter';
                    //  return 'pagination_filter';
                }
            }
            //    $_SESSION['page'] = $id;
            return 'pagination_page';
            // }
        }
    }
    public function actionFilterBien($category,$id)
    {


        $this->setBsVersion('4.x');
        $request = Yii::$app->request;

        $result = new FilterBien($category,$id);
        $result = $result->filtrerBien();
        $id = -2;
        $case = $this->checkIfRedirect($request, $result, $id);
        $_SESSION["deliveryPrice"] = $result[7];


        $this->layout = 'home_send';
        return $this->render('_send', [
            'model1' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => 0, 'active' => $result[5], 'category' => $result[6],
            'deliveryPrice' => $result[7],
        ]);
    }
    public function actionFilter($price, $type_of_room, $space_for_rent, $accepts, $facilities, $transport, $parking, $active)
    {

        $this->setBsVersion('4.x');
        $request = Yii::$app->request;

        $result = new Filter($price, $type_of_room, $space_for_rent, $accepts, $facilities, $transport, $parking, $active);
        $result = $result->filtrer();
        $id = -2;
        $case = $this->checkIfRedirect($request, $result, $id);
        $_SESSION["deliveryPrice"] = $result[7];

        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    $this->layout = 'home_send';
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1, 'deliveryPrice' => $result[7]]);
                    break;
                case 'pagination_filter':
                    $this->layout = 'home_send';
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter'], 'deliveryPrice' => $result[7]]);
                    break;
                case 'pagination_page':
                    $this->layout = 'home_send';
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
                        'deliveryPrice' => $result[7],
                    ]);
                    break;
            }
        }
        $this->layout = 'home_send';
        return $this->renderAjax('_send', [
            'model1' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
            'deliveryPrice' => $result[7],
        ]);
    }
    public function actionFilterRoom($price, $type_of_room, $space_for_rent, $accepts, $facilities, $transport, $parking, $active)
    {
        //recupérer les champs coché
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $request = Yii::$app->request;
        $result = new FilterRoom($price, $type_of_room, $space_for_rent, $accepts, $facilities, $transport, $parking, $active);
        $result = $result->filtrer();
        $id = -2;
        $case = $this->checkIfRedirect($request, $result, $id);
        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1]);
                    break;
                case 'pagination_filter':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter']]);
                    break;
                case 'pagination_page':
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
                    ]);
                    break;
            }
        }
        return $this->renderAjax('_send', [
            'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
        ]);
    }
    public function actionFilterEquipement($price, $active)
    {
        //recupérer les champs coché
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $request = Yii::$app->request;
        $result = new FiltreEquipement($price, $active);
        $result = $result->filtrer();

        $id = -2;
        $case = $this->checkIfRedirect($request, $result, $id);
        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1]);
                    break;
                case 'pagination_filter':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter']]);
                    break;
                case 'pagination_page':
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
                    ]);
                    break;
            }
        }
        return $this->renderAjax('_send', [
            'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
        ]);
    }
    public function actionFilterCater($price, $active)
    {
        //recupérer les champs coché
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $request = Yii::$app->request;
        $result = new FilterCater($price, $active);
        $result = $result->filtrer();
        $id = -2;
        $case = $this->checkIfRedirect($request, $result, $id);
        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1]);
                    break;
                case 'pagination_filter':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter']]);
                    break;
                case 'pagination_page':
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
                    ]);
                    break;
            }
        }
        return $this->renderAjax('_send', [
            'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
        ]);
    }

    public function actionFilterPhoto($price, $active)
    {
        //ici je vais mettre mon code pour la rébrique sécurity
        //recupérer les champs coché
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $request = Yii::$app->request;
        $result = new FilterPhoto($price, $active);
        $result = $result->filtrer();
        $id = -2;
        $case = $this->checkIfRedirect($request, $result, $id);
        //Partie pour les paginations
        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1]);
                    break;
                case 'pagination_filter':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter']]);
                    break;
                case 'pagination_page':
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
                    ]);
                    break;
            }
        }
        return $this->renderAjax('_send', [
            'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
        ]);
    }
    public function actionFilterAnimation($price, $active)
    {
        //ici je vais mettre mon code pour la rébrique sécurity
        //recupérer les champs coché
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $request = Yii::$app->request;
        $result = new FiltreAnimation($price, $active);
        $result = $result->filtrer();
        $id = -2;
        //pagination part
        $case = $this->checkIfRedirect($request, $result, $id);
        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1]);
                    break;
                case 'pagination_filter':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter']]);
                    break;
                case 'pagination_page':
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
                    ]);
                    break;
            }
        }
        return $this->renderAjax('_send', [
            'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
        ]);
    }
    public function actionFilterSecurity($price, $active)
    {
        //recupérer les champs coché
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $request = Yii::$app->request;
        $result = new FilterSecurity($price, $active);
        $result = $result->filtrer();
        $id = -2;
        //pagination part
        $case = $this->checkIfRedirect($request, $result, $id);
        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1, 'deliveryPrice' => $_SESSION["deliveryPrice"]]);
                    break;
                case 'pagination_filter':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter'], 'deliveryPrice' => $_SESSION["deliveryPrice"]]);
                    break;
                case 'pagination_page':
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6], 'deliveryPrice' => $_SESSION["deliveryPrice"],
                    ]);
                    break;
            }
        }
        return $this->renderAjax('_send', [
            'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
        ]);
    }
    public function actionFilterHost($price, $active)
    {
        //recupérer les champs coché
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $request = Yii::$app->request;
        $result = new FilterHost($price, $active);
        $result = $result->filtrer();
        $id = -2;
        //pagination part
        $case = $this->checkIfRedirect($request, $result, $id);
        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1]);
                    break;
                case 'pagination_filter':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter']]);
                    break;
                case 'pagination_page':
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
                    ]);
                    break;
            }
        }
        return $this->renderAjax('_send', [
            'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
        ]);
    }
    public function actionFilterOther($price, $active)
    {
        //recupérer les champs coché
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $request = Yii::$app->request;
        $result = new FilterOther($price, $active);
        $result = $result->filtrer();
        $id = -2;
        $case = $this->checkIfRedirect($request, $result, $id);
        if (!empty($case)) {
            switch ($case) {
                case 'pagination_category':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['category'] + 1]);
                    break;
                case 'pagination_filter':
                    return $this->redirect(['/site/redirect', 'filter' => $_SESSION['filter']]);
                    break;
                case 'pagination_page':
                    return $this->renderAjax('page', [
                        'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
                        'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6],
                    ]);
                    break;
            }
        }
        return $this->renderAjax('_send', [
            'model' => $result[0], 'category_searched' => $result[1], 'dataProvider' => $result[2],
            'pages' => $result[3], 'searchModel' => $result[4], 'a' => 'a', 'qte_search' => $_SESSION['nbr_persson'], 'active' => $result[5], 'category' => $result[6], 'deliveryPrice' => $_SESSION["deliveryPrice"],
        ]);
    }

    public function actionSort($filter, $sort)
    {
        $this->layout = 'home_send';
        $this->setBsVersion('4.x');
        $active = $_SESSION['active'];
        $request = Yii::$app->request;
        if ($sort == "ascending") {
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => $filter])
                ->orderBy(['price' => SORT_ASC])
                ->all();
        } else {
            $query = ProductItem::find()
                ->andFilterWhere(['partner_category' => $filter])
                ->orderBy(['price' => SORT_DESC])
                ->all();
        }

        $pages = new Pagination(['totalCount' => count($query)]);

        $searchModel = new ProductItemSearch();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,

            'pagination' => [
                'pageSize' => 3,

            ],
        ]);

        $category = $filter;
        $id = -2;
        if (!empty($request->get('page'))) {
            $id = $request->get('page');
        }

        if ($id > -1) {
            return $this->renderAjax('page', [
                'dataProvider' => $dataProvider,
                'pages' => $pages, 'searchModel' => $searchModel, 'a' => 'a', 'active' => $active, 'category' => $filter,
            ]);
        } else {
            return $this->renderAjax('_send', [
                'dataProvider' => $dataProvider,
                'pages' => $pages, 'searchModel' => $searchModel, 'a' => 'a', 'active' => $active, 'category' => $filter,
            ]);
        }
    }
    public function actionRedirect($filter)
    {

        $this->setBsVersion('4');
        $this->layout = 'home_send';
        $_SESSION['base'] = 0;
        $_SESSION['condition'] = 0;

        $model = new \app\models\forms\SearchForm();
        $searchModel = new ProductItemSearch();
        $_SESSION['category'] = $filter - 1;
        $_SESSION['category1'] = $filter;
        $query = [];

        $_SESSION['filter'] = $filter;

        return $this->render('send', ['filter' => $filter]);
        //}
    }

    public function actionSend()
    {
        //session_unset();
        // die();
        $this->setBsVersion('4');
        $this->layout = 'home_send';
        $model = new \app\models\forms\SearchForm();
        if ($model->load(Yii::$app->request->post())) {
            //creating session variable
            $session = Yii::$app->session;
            $session->open();
            $_SESSION['category'] = $model->category;
            $_SESSION['category1'] = $model->category + 1;
            if ($_SESSION['category1'] == 1) {
                $_SESSION['subcategory'] = $model->subcategory - 1;
            } else {
                $_SESSION['subcategory'] = $model->subcategory;
            }
            $_SESSION['date_depart'] = $model->date_depart;
            $_SESSION['date_arriver'] = $model->date_arriver;
            //calculate the difference of hour
            $date = explode(" - ", $_SESSION['date_depart']);
            $date_depart = $date[0];
            $timestamp = strtotime($date_depart);
            $_SESSION['dayDepart'] = date('l', $timestamp);
            $date_arriver = $date[1];
            $timestamp = strtotime($date_arriver);
            $_SESSION['dayArriver'] = date('l', $timestamp);
            $date_arriver = $date[1];
            $_SESSION['depart'] = $date[0];
            $_SESSION['arriver'] = $date[1];
            $heure_depart = substr($date_depart, 11, 20);
            $heure_arriver = substr($date_arriver, 11, 20);
            $timeStartChosedByClient = new \DateTime($heure_depart);
            $timeStartChosedByClient = $timeStartChosedByClient->format('H:i');
            $timeClosedChosedByClient = new \DateTime($heure_arriver);
            $timeClosedChosedByClient = $timeClosedChosedByClient->format(' H:i');
            $_SESSION['duration'] = strtotime($timeClosedChosedByClient) - strtotime($timeStartChosedByClient);
            $_SESSION['duration'] = $_SESSION['duration'] / 3600;
            //
            $_SESSION['place'] = $model->place;
            $_SESSION['nbr_persson'] = $model->nbr_persson;
        }

        return $this->render('send', [
            'model' => $model->category,
            //'model' => $model,'products1'=>$products,'category_searched'=>$value_category_serached,'dataProvider'=>$dataProvider,
            //'pages' => $pages,'searchModel'=>$searchModel

        ]);
        //}
    }
    public function actionFilter2()
    {

        //pour faire le filtrage
        //slection les dates entre le range dans le partenaire dans un interval de date
        //selctioner les adress et filtrer avec adress
        $model = new \app\models\forms\SearchForm();
        if ($model->load(Yii::$app->request->post())) {
            $this->layout = 'home_send';
            $this->setBsVersion('4');
            $session = Yii::$app->session;
            $session->open();
            if (empty($model)) {
                $model->category = $_SESSION['category'];
                $model->date_depart = $_SESSION['date_depart'];
                $model->date_arriver = $_SESSION['date_arriver'];
                $model->place = $_SESSION['place'];
                $model->nbr_persson = $_SESSION['nbr_persson'];
            }

            $model->category = $_SESSION['category'];
            $model->date_depart = $_SESSION['date_depart'];
            $model->date_arriver = $_SESSION['date_arriver'];
            $model->place = $_SESSION['place'];
            $model->nbr_persson = $_SESSION['nbr_persson'];

            //getting the partner that has the nearest address with near to in a range of less than 30 km and return that distance
            $array_partner_filtered_by_address = array();
            $partner_getting_address = Partner::find()->all();
            $addressFrom = "";
            foreach ($partner_getting_address as $address) {

                if ($address->address != "xxxx") {
                    $addressFrom = $address->address . "," . $address->city . "," . $address->country;
                }

                $addressTo = $_SESSION['place'];

            }

            //verifying in the product  people who have the category id
            $date = array();
            $date = explode(" - ", $model->date_depart);
            $date_depart = $date[0];
            $date_arriver = $date[1];
            $event_partner_date = TblEvents::find()
                ->where(['between', 'start', $date_depart, $date_arriver])
                ->where(['title' => 'Available'])
                ->all();
            $array_partner = [];
            foreach ($event_partner_date as $partner) {
                $array_partner[] = $partner->partner_id;
            }
            $result = array_intersect($array_partner, $array_partner_filtered_by_address);

            $value_category_serached = $model->category + 1;
            $value_category_serached = $value_category_serached . "";
            if (empty($products)) {
                $products = "vide";
            }

            // I need to create a product Parent with the filter appropriate of the date
            $product_parent = ProductParent::find()->where(['partner_id' => $array_partner])->all();

            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }

            //here add the condition of product parent
            $query = ProductItem::find()->where(['product_id' => $product_parent_id]);
            // $query = ProductItem::find()->where(['partner_category'=>$model->category])->where(['product_id'=>$product_parent_id]);
            $searchModel = new ProductItemSearch();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);
            // returns an array of users objects
            // $dataProvider = $provider->getModels();

            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $this->layout = 'home_send';
            return $this->renderAjax('_send', [
                'model' => $model, 'products1' => $products, 'category_searched' => $value_category_serached, 'dataProvider' => $dataProvider,
                'pages' => $pages, 'searchModel' => $searchModel,

            ]);
        } else {
            $this->layout = 'home_send';
            $this->setBsVersion('4');
            $session = Yii::$app->session;
            $session->open();
            if (empty($model)) {

                $model->category = $_SESSION['category'];
                $model->date_depart = $_SESSION['date_depart'];
                $model->date_arriver = $_SESSION['date_arriver'];
                $model->place = $_SESSION['place'];
                $model->nbr_persson = $_SESSION['nbr_persson'];
            }

            $model->category = $_SESSION['category'];
            $model->date_depart = $_SESSION['date_depart'];
            $model->date_arriver = $_SESSION['date_arriver'];
            $model->place = $_SESSION['place'];
            $model->nbr_persson = $_SESSION['nbr_persson'];

            //getting the partner that has the nearest address with near to in a range of less than 30 km and return that distance
            $array_partner_filtered_by_address = array();
            $partner_getting_address = Partner::find()->all();
            $addressFrom = "";
            foreach ($partner_getting_address as $address) {

                if ($address->address != "xxxx") {
                    $addressFrom = $address->address . "," . $address->city . "," . $address->country;
                }

                $addressTo = $_SESSION['place'];

            }

            //verifying in the product  people who have the category id
            $date = array();
            $date = explode(" - ", $model->date_depart);
            $date_depart = $date[0];
            $date_arriver = $date[1];
            $event_partner_date = TblEvents::find()
                ->where(['between', 'start', $date_depart, $date_arriver])
                ->where(['title' => 'Available'])
                ->all();
            $array_partner = [];
            foreach ($event_partner_date as $partner) {
                $array_partner[] = $partner->partner_id;
            }
            $result = array_intersect($array_partner, $array_partner_filtered_by_address);
            //$pertner=Partner::find()->where(['partner_category'=>$model->category+1,'number_people'=>$model->nbr_persson])->all();
            $products = Product::find()->andwhere(['partner_category' => $model->category + 1, 'number_people' => $model->nbr_persson, 'partner_id' => $result])->all();
            $value_category_serached = $model->category + 1;
            $value_category_serached = $value_category_serached . "";
            if (empty($products)) {
                $products = "vide";
            }

            // I need to create a product Parent with the filter appropriate of the date
            $product_parent = ProductParent::find()->where(['partner_id' => $array_partner])->all();

            foreach ($product_parent as $p) {
                $product_parent_id[] = $p->id;
            }

            //here add the condition of product parent
            $query = ProductItem::find()->where(['product_id' => $product_parent_id]);
            // $query = ProductItem::find()->where(['partner_category'=>$model->category])->where(['product_id'=>$product_parent_id]);
            $searchModel = new ProductItemSearch();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);
            // returns an array of users objects
            // $dataProvider = $provider->getModels();

            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $this->layout = 'home_send';
            return $this->renderAjax('_send', [
                'model' => $model, 'products1' => $products, 'category_searched' => $value_category_serached, 'dataProvider' => $dataProvider,
                'pages' => $pages, 'searchModel' => $searchModel,

            ]);
        }
    }
    public function actionIndex()
    {
        $this->layout = 'home';
        // session_unset();
        $model = new \app\models\forms\SearchForm();
        $this->setBsVersion(4);
        //  $this->setBsVersion('3.x');

        return $this->render('index', [
            'model' => $model,
        ]);
    }
    public function actionAbout()
    {
        return $this->render('about', []);
    }
    /* public function actionReservation($amount, $id, $product_id)
    {
    //get the id
    $reservation_id = Reservation::find()->orderBy(['id' => SORT_DESC])->one();
    $id_reservation = $reservation_id->id;
    $model = new Reservation();
    $model_p = new Payment;
    $model_Partner = ProductParent::find()->where(['id' => $product_id])->all();
    $partner_id = $model_Partner[0]->partner_id;
    $model->id = $id_reservation + 1;
    $date_reservation = date("Y/m/d");
    $model->reservation_date = $date_reservation;
    $model->status = 0;

    $model->user_id = User::getCurrentUser()->id;
    $model->partner_id = $partner_id;
    $model->product_id = $product_id;
    if ($model->save()) {
    echo "success";
    } else {
    echo "problem";
    print_r($model->getErrors());
    die();
    }

    $this->layout = 'home_send';
    // $this->setBsVersion('4.x');
    Yii::$app->session->setFlash('success', "Transaction succesful");

    return $this->redirect(['/site/detail']);
    }*/
    public function actionReservation($prix, $id, $partner_id, $product_name)
    {

        $this->setBsVersion('3');
        $this->layout = 'main';
        if (User::isUser()) {
            $model = new \app\models\Reservation();

            return $this->render('reservation', [
                'model' => $model,
                'prix' => $prix,
                'id' => $id,
                'partner_id' => $partner_id,
                'product_name' => $product_name,
            ]);
        } else {
            throw new NotFoundHttpException('Vous pouvez pas réserver ce produit vous etes pas un client ');
        }
        return $this->redirect(['/user/security/login']);

    }
    public function actionSaveReservation($prix, $id, $partner_id, $product_name)
    {

        $model = new \app\models\Reservation();

        if ($model->load(Yii::$app->request->post())) {

            $now = new \DateTime();
            $model->start_reservation =$_SESSION['depart']  ;
            $model->end_reservation = $_SESSION['arriver'];
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->partner_id = $partner_id;
            if ($model->file != 'vide' and !empty($model->file)) {
                if ($model->upload()) {

                }
            }
            $model->product_item_id = $id;
            $model->montant = $prix;
            if ($model->file) {
                $model->piece_jointe = (string) $model->file;
            } else {
                $model->piece_jointe = "vide";
            }
            $model->user_id = (string) User::getCurrentUser()->id;

            if ($model->save()) {
                $currTime = time();
                $db = Yii::$app->getDb();

                $messageNotification = AccountNotification::KEY_NEW_PRODUCT . ' ' . User::find()->where(['id' => User::getCurrentUser()->id])->one()->username . ' a payer pour produit ' . $product_name . ' qui coute ' . $prix . ' Dzd';
                $keyNotification = AccountNotification::KEY_NEW_PRODUCT . ' ' . $prix . 'Da';
                $db->createCommand()->insert('{{%notifications}}', [
                    'class' => '',
                    'key' => $messageNotification,
                    'message' => $keyNotification,
                    'route' => '',
                    'user_id' => $model->user_id,
                    'reservation_id' => $model->id,
                    'created_at' => $currTime,
                ])->execute();
                //AccountNotification::create($keyNotification, ['user' => User::getCurrentUser()->id,'reservation_id'=>$model->id])->send();

            } else {
                print_r($model->errors);
                die();
            }
            return $this->render('payement', [

            ]);

        }

        return $this->render('reservation', [
            'model' => $model,
        ]);

    }
    public function actionDetail($amount, $id, $product_id, $deliveryPrice)
    {

        $this->setBsVersion('4');
        $this->layout = 'detail';

        $model = new \app\models\forms\SearchForm();
        $model_Partner = ProductParent::find()->where(['id' => $product_id])->all();
        $partner_id = $model_Partner[0]->partner_id;

        $partner = Partner::find()->where(['id' => $partner_id])->all();
        $model = ProductItem::find()->where(['id' => $id])->all();
        $image = json_decode($model[0]->picture, true);

        $count = count($image);
        $extra = json_decode($model_Partner[0]->extra, true);

        //récuperer la quantité
        $qte = 0;
        if ($model_Partner[0]->partner_category == 3) {
            $qte = $model_Partner[0]->min;
        } else {
            $qte = $model[0]->people_number;
        }
        //Get Cordinates

        $partner = Partner::find()->where(['id' => $partner_id])->one();

        //die();
        $latitude = $partner->latitude;
        $longitude = $partner->longitude;
        $modelmap = new modelMap();

        //Address
        $apiKey = 'AIzaSyCTGpqrJDrULNO0PNch-b8vlmcwwGt7D2c';
        $counter = 0;
        $addressTo = $_SESSION['place'];
        $formattedAddrTo = $addressTo;
        // Geocoding API request with end address
        $formattedAddrTo = str_replace(' ', '+', $addressTo);
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $apiKey);
        $outputTo = json_decode($geocodeTo);
        if (!empty($outputTo->error_message)) {
            return $outputTo->error_message;
        }
        $latitudeTo = $outputTo->results[0]->geometry->location->lng;
        $longitudeTo = $outputTo->results[0]->geometry->location->lat;
       

        return $this->render('detail', ['model' => $image, 'cancelation' => $partner->picture, 'latFrom' => $latitudeTo, 'lngFrom' => $longitudeTo, 'qte' => $qte, 'category' => $model_Partner[0]->partner_category, 'id' => $id, 'count' => $count, 'product' => $model[0], 'Languages' => $model[0]->languages, 'product_parent' => $model_Partner[0], 'partner' => $partner, 'count_extra' => 0, 'extra' => $extra, 'search' => $model, 'modelmap' => $modelmap, 'latitude' => $latitude, 'longitude' => $longitude, 'deliveryPrice' => $deliveryPrice]);
    }
    public function actionMap($id, $category, $product_id)
    {
        $this->setBsVersion('4');
        $this->layout = 'detail';
        if ($category == 1) {
        } else {

            $model_Partner = ProductParent::find()->where(['id' => $product_id])->all();

            $partner_id = $model_Partner[0]->partner_id;
            $partner = Partner::find()->where(['id' => $partner_id])->one();
            $latitude = $partner->latitude;
            $longitude = $partner->longitude;
        }
        $model = new modelMap();
        return $this->render('map', ['model' => $model, 'latitude' => $latitude, 'longitude' => $longitude]);
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if ($model->username == 'admin') {

                return $this->redirect(['/user/admin']);
            }
            if (User::isPartner()) {
                return $this->redirect(['/welcome/index']);
            } else {
                return $this->redirect(['/site/index']);
            }

            //return $this->goBack();
        }
        $this->layout = 'main';
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $this->layout = 'main';

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            //i should send the notifcation for the admin
            $msg = json_encode($model);
            $user = User::find()->where(['id' => User::getCurrentUser()->id])->one();

            $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
            //send attachement to email
            AccountNotification::create(AccountNotification::KEY_USER_MESSAGE, $msg, $user->username, $user->id)->send_contact();
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionTerms()
    {

        return $this->render('terms');
    }

    public function actionDisclaimer()
    {
        return $this->render('disclaimer');
    }

    public function actionFeatures()
    {
        $this->layout = 'home';
        return $this->render('features');
    }

    public function actionBecomeClient()
    {
        $this->layout = 'home';
        $this->setBsVersion(4);
        $user = new RegistrationForm();
        $registred_user = new User();
        $post = Yii::$app->request->post();
        if ($user->load($post)) {
            $user->api_key = \Yii::$app->security->generateRandomString(16);
            if ($user->validate()) {
                $user = $user->register();
                if ($user) {
                    $auth = new \app\models\AuthAssignment;
                    $auth->user_id = $user->id;
                    $auth->item_name = User::ROLE_USER;
                    $auth->created_at = time();
                    $auth->save();
                }

                Yii::$app->session->setFlash('success', "Dear Client thank you for your registration we invite you to check you email or your spam box we've sent you a confirmation email to continue your registration.");
                return $this->redirect(['/user/security/login']);
            } else {

            }

        }

        return $this->render('client', [
            'user' => $user,
        ]);
    }
    public function actionBecomePartner()
    {

        $this->layout = 'home';
        $model = new \app\models\forms\SearchForm();
        $this->setBsVersion(4);
        $user = new RegistrationForm();
        $post = Yii::$app->request->post();
        if ($user->load($post)) {
            $user->api_key = \Yii::$app->security->generateRandomString(16);
            if ($user->validate()) {
                $user = $user->register();
                if ($user) {
                    // $user->refresh();
                    if ($user) {
                        $auth = \app\models\AuthAssignment::find()->where(['user_id' => $user->id])->one();
                        $auth->user_id = (string) $user->id;
                        $auth->item_name = (string) User::ROLE_PARTNER;
                        $auth->created_at = (string) time();
                        if ($auth->update()) {

                        } else {
                            print_r($auth->errors);
                            die();
                        }
                    }
                }
                $user = User::find()->where(['id' => 1])->one();
                Yii::$app->session->setFlash('success', "Dear Partner thank you for your registration we invite you to check you email or your spam box we've sent you a confirmation email to continue your registration.");
                return $this->redirect(['/user/security/login']);
            } else {

            } // !($user)

        } // $user->validate()

        return $this->render('partner', [
            'user' => $user,
        ]);
    }

    protected function surveyCompleted($id)
    {
        $stat = SurveyStat::findOne([
            'survey_stat_survey_id' => $id,
            'survey_stat_user_id' => \Yii::$app->user->getId(),
        ]);
        return ($stat !== null && $stat->survey_stat_is_done);
    }

    /**
     *
     * @param type $version 4 or 3
     */
    protected function setBsVersion($version)
    {
        if ($version == 4) {
            $this->layout = 'home';
            Yii::$app->params['bsVersion'] = '4.x';
        } else {
            $this->layout = 'main';
            Yii::$app->params['bsVersion'] = '3.x';
        }
    }

    public function actionPartner($id)
    {
        $this->setBsVersion(4);
        if (($model = Partner::findOne($id)) !== null) {
            return $this->render('partner_view', ['model' => $model]);
        }
    }
    public function actionProduct($id)
    {
        $this->setBsVersion(4);

        if (($model = ProductItem::findOne($id)) !== null) {
            $model2 = new Reservation();
            $model_p = new Payment();
            //getting the category of product
            $category = $model->partner_category;
            //dans la category Room Rental
            if ($category == 1) {
                return $this->render('product_view_Room_rental', ['model' => $model, 'model2' => $model2, 'model_p' => $model_p]);
            }

            //dans le cas de equipement
            if ($category == 2) {
                return $this->render('product_view_equipement', ['model' => $model, 'model2' => $model2, 'model_p' => $model_p]);
            }

            //dans le cas de  Catters
            if ($category == 3) {
                return $this->render('product_view_catters', ['model' => $model, 'model2' => $model2, 'model_p' => $model_p]);
            }

            //dans les autres catégory
            if ($category == 4 || $category == 5 || $category == 6 || $category == 7 || $category == 8) {
                return $this->render('product_view_price_day_night_and_languages', ['model' => $model, 'model2' => $model2, 'model_p' => $model_p]);
            }

            return $this->render('product_view', ['model' => $model, 'model_p' => $model_p, 'model2' => $model2]);
        }
    }
    public function actionMessage($id)
    {
        if (User::getCurrentUser()->id != 1) {
            $this->layout = 'main2';
        }

        $model_notification = Notificationsuser::find()->andwhere(['id' => $id])->One();
        $model1 = json_decode($model_notification->key2, true);
        $answer = $model_notification->answer;
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('Message sent to the client');
            //i should send the notifcation for the admin
            $id_update = $id;
            $answer = $model->answer;
            //send attachement to email
            AccountNotification::create(AccountNotification::KEY_USER_MESSAGE, $id_update, "admin", $answer)->update_contact();
            return $this->refresh();
        }

        $model->name = $model1['name'];
        $model->email = $model1['email'];
        $model->subject = $model1['subject'];
        $model->body = $model1['body'];
        $model->answer = $answer;

        return $this->render('message', ['model1' => $model1, 'model' => $model]);
    }
}
