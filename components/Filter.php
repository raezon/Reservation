<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\partner\RegistrationForm;
use app\models\User;
use app\models\Partner;
use app\models\Product;
use app\models\ProductParent;
use app\models\ProductItem;
use app\models\ProductItemSearch;
use app\models\base\TblEvents;
use app\modules\survey\models\SurveyStat;
use app\models\PartnerCategorySurveys;
use app\models\Surveys;
use app\models\base\QuestionsList;
use app\models\base\Questions;
use app\models\base\QuestionsPartner;
use app\models\AccountNotification;
use app\models\Notificationsuser;
use yii\data\ActiveDataProvider;
use app\models\Reservation;
use app\models\Payment;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\data\ArrayDataProvider;
use yii\web\Session;
use app\models\Other;
use yii\data\Sort;
use app\components\Distance;
use yii\db\Expression;

class Filter extends Component
{
    public $price;
    public $type_of_room;
    public $space_for_rent;
    public $accepts;
    public $facilities;
    public $transport;
    public $parking;
    public $active;
    public $value_category_serached;
    public $model;
    public $result;
    public $request;
    public $array_partner_filtered_by_address2;
    public $array_partner_filtered_by_address1;
    public $filteraf;
    public $array_partner;
    public $scope;
    public $deliveryPrice;
    public function __construct($price, $type_of_room, $space_for_rent, $accepts, $facilities, $transport, $parking, $active, $config = [])
    {
        //part setting session 
        $this->request = Yii::$app->request;
        $_SESSION['active'] = $active;
        $this->model =  new \app\models\forms\SearchForm();
        $session = Yii::$app->session;
        $session->open();

        $this->model->category = $_SESSION['category'] + 1;
        $this->model->date_depart = $_SESSION['date_depart'];
        $this->model->date_arriver = $_SESSION['date_arriver'];
        $this->model->place = $_SESSION['place'];
        $this->model->nbr_persson = $_SESSION['nbr_persson'];
        $this->value_category_serached = $this->model->category;
        $this->value_category_serached = $this->value_category_serached . "";
        if (!empty($this->request->get('filter'))) {
            $this->filteraf = $this->request->get('filter');
        } else {
            $this->filteraf  = 0;
        }
        $this->array_partner_filtered_by_address1 = array();
        parent::__construct($config);
    }

    //This is the methode that will be fire
    public function filtrer()
    {

        $addressTo = $_SESSION['place'];
        
        $array_partner_filtered_by_address = array();
        $partner_getting_address = (new \yii\db\Query())
            ->select(['id', 'address', 'city','state', 'country', 'latitude', 'longitude', 'DeliveryAndDeplacement'])
            ->from('partner')
            ->where(['state'=>$addressTo])
            ->limit(100)
            ->all();


        $addressFrom = $partner_getting_address;

        $array_partner_filtered_by_address = array();

        $distance = new Distance();

        if (($this->value_category_serached == 1 && empty($this->filteraf)) || ($this->filteraf == 1)) {


            $array_partner_filtered_by_address = $distance->getDistance1($addressFrom, $addressTo, "K");
            $this->array_partner_filtered_by_address2 = $array_partner_filtered_by_address;
            foreach ($array_partner_filtered_by_address  as $array_partner_filtered_by_address) {
                $this->array_partner_filtered_by_address1[] = $array_partner_filtered_by_address['partner_id'];
                // $array_partner_filtered_by_address = $array_partner_filtered_by_address['partner_id'];
            }
        }
        //other 
        else {

            $this->array_partner_filtered_by_address1 = array();
            $array_partner_filtered_by_address = $distance->getDistance2($addressFrom, $addressTo, "K");
            $this->array_partner_filtered_by_address2 = $array_partner_filtered_by_address;
            foreach ($array_partner_filtered_by_address  as $array_partner_filtered_by_address) {
                $this->array_partner_filtered_by_address1[] = $array_partner_filtered_by_address['partner_id'];

            }
        }
        //partie de correction pour la date
        $this->array_partner = array();
        $this->array_partner = $this->correction_date($this->model);
        //partie pour construction du tableau de partner_id
        $query = $this->getPartnerId();
        // if ($this->value_category_serached != 1)
        $query = $this->compareDistanceBetweenOriginalPartnerAndTheAdressFilledByClient($query, $this->array_partner_filtered_by_address2);

        $query = $this->SortProducts($query);
        $result = $this->sendingDataToSiteController($query);

        return ($result);
    }
    //This methode is used for getting the date and cleansing it 
    public function correction_date($model)
    {
        $date = array();
        $date = explode(" - ", $model->date_depart);
        $date_depart = $date[0];
        $date_arriver = $date[1];
        $_SESSION['depart']= $date[0];
        $_SESSION['arriver'] = $date[1];
        $_SESSION['heure_depart']= substr($date_depart, 11,20); ;
        $_SESSION['heure_fermuture'] = substr($date_arriver , 11,20); 
              //changer time for depart
        $date_depart[11] = 0;
        $date_depart[12] = 0;
        $date_depart[16] = ":";
        $date_depart[17] = 0;
        $date_depart[18] = 0;
        ///changin the time of the arriver date
        $date_arriver[11] = 0;
        $date_arriver[12] = 0;
        $date_arriver[16] = ":";
        $date_arriver[17] = 0;
        $date_arriver[18] = 0;
  
        $event_partner_date = TblEvents::find()
            ->andWhere(['between', 'start', $date_depart, $date_arriver])
            ->andWhere(['=', 'title', 'Available'])
            ->all();

        $this->array_partner = [];
        foreach ($event_partner_date as $partner) {
            $this->array_partner[] = $partner->partner_id;
        }
        $this->array_partner = array_unique($this->array_partner);;

        return $this->array_partner;
    }
    //This methode is used for getting all the partner Id
    public function getPartnerId()
    {
        if (isset($_SESSION['filter']))
            $category = $_SESSION['filter'];
        else
            $category = $_SESSION['category'] + 1;
        $nbrPersson = $_SESSION['nbr_persson'];
        if (!empty($this->array_partner_filtered_by_address1)) {

            if (!empty($this->filteraf)) {

                $this->result = $this->array_partner_filtered_by_address1;
                $this->result = array_intersect($this->array_partner, $this->array_partner_filtered_by_address1);
            }
            if (empty($this->filteraf)) {

                $this->result = $this->array_partner_filtered_by_address1;

                $this->result = array_intersect($this->array_partner, $this->array_partner_filtered_by_address1);
            }
            // $this->result = $this->array_partner_filtered_by_address1;
            $this->result = array_intersect($this->array_partner, $this->array_partner_filtered_by_address1);
        }
        if (!empty($this->filteraf)) {

            $this->result = array_intersect($this->array_partner, $this->array_partner_filtered_by_address1);
        }



        $product_parent = ProductParent::find()
            ->andwhere(['partner_id' => $this->result])
            ->andwhere(['partner_category' => $this->value_category_serached])
            ->all();

        if (empty($this->filteraf)) {


            $product_parent = ProductParent::find()->andWhere(['partner_id' => $this->result])
                ->andWhere(['partner_category' => $this->value_category_serached])->all();
        }

        if (!empty($this->filteraf)) {
            if ($this->filteraf > 0)
                $product_parent = ProductParent::find()
                    ->andWhere(['partner_id' => $this->result])
                    ->andWhere(['partner_category' => $this->filteraf])->all();
        }
        if ($this->filteraf == 0)
            $product_parent = ProductParent::find()
                ->andWhere(['partner_id' => $this->result])
                ->andWhere(['partner_category' => $this->value_category_serached])->all();

        $product_parent_id = [];
        foreach ($product_parent as $p) {
            $product_parent_id[] = $p->id;
        }


        if (isset($_SESSION['filter'])) {

            $filter = $_SESSION['filter'];

            if (!empty($this->request->get('filter')))
                $filter = $this->request->get('filter');
            else {
                $filter = $this->value_category_serached;
            }

         
            if ($filter != 1 && $filter != 3)
                $query = ProductItem::find()
                    ->andWhere(['partner_category' => $filter])
                    ->andWhere(['product_id' => $product_parent_id])->all();
            if ($filter == 1){
              
                $query = ProductItem::find()
                    ->andWhere(['partner_category' => $filter])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->andWhere(['>=', 'people_number', $nbrPersson])
                    ->andWhere(['<=', 'people_number', new \yii\db\Expression("JSON_EXTRACT(checkbox, '$[2]')")])
                    ->andWhere(['>=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[0]')"), $_SESSION['duration']]) 
                    ->andWhere(['<=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[1]')"), $_SESSION['duration']])
                    ->andWhere(['!=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[4]')"), $_SESSION['dayDepart']])
                    ->andWhere(['!=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[4]')"), $_SESSION['dayArriver']])
                    //add the time
                    ->all();
            }
            if ($filter == 3){
            
                $query = ProductItem::find()
                    ->andWhere(['partner_category' => $filter])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->andFilterWhere(['<=', 'min_price', new \yii\db\Expression("price*'$nbrPersson'/people_number")])
                    ->all();  
            }
                         
        } else {
            if ($category != 1 && $category != 3)
                $query = ProductItem::find()->andWhere(['partner_category' => $this->value_category_serached])
                    ->andWhere(['product_id' => $product_parent_id])
                    ->all();
            if ($category == 1){
               
                $query = ProductItem::find()
                ->andWhere(['partner_category' => 1])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere(['>=', 'people_number', $nbrPersson])
                ->andWhere(['>=', 'people_number', new \yii\db\Expression("JSON_EXTRACT(checkbox, '$[2]')")])
                ->andWhere(['>=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[0]')"), $_SESSION['duration']]) 
                ->andWhere(['<=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[1]')"), $_SESSION['duration']])
                ->andWhere(['!=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[4]')"), $_SESSION['dayDepart']])
                ->andWhere(['!=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[4]')"), $_SESSION['dayArriver']])
                ->all();
                
            }
                   
            if ($category == 3)
                    $query = ProductItem::find()
                        ->andWhere(['partner_category' => 3])
                        ->andWhere(['product_id' => $product_parent_id])
                        ->andFilterWhere(['<=', 'min_price', new \yii\db\Expression("price*'$nbrPersson'/people_number")])
                        ->all();
                        
        }
        if (!empty($this->filteraf)) {

            $product_parent = ProductParent::find()
                ->andWhere(['partner_id' => $this->result])
                ->andWhere(['partner_id' => $this->result])
                ->all();


            $product_parent_id1 = array();
            foreach ($product_parent as $p) {
                $product_parent_id1[] = $p->id;
            }

            $query = ProductItem::find()
                ->andWhere(['partner_category' => $this->filteraf])
                ->andWhere(['product_id' => $product_parent_id1])->all();
            if ($category != 1  && $category != 3)
                $query = ProductItem::find()
                    ->andWhere(['partner_category' => $this->filteraf])
                    ->andWhere(['product_id' => $product_parent_id1])->all();
            if ($category == 1){
              
                $query = ProductItem::find()
                ->andWhere(['partner_category' => $filter])
                ->andWhere(['product_id' => $product_parent_id])
                ->andWhere(['>=', 'people_number', $nbrPersson])
                ->andWhere(['<=', 'people_number', new \yii\db\Expression("JSON_EXTRACT(checkbox, '$[2]')")])
                ->andWhere(['>=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[0]')"), $_SESSION['duration']]) 
                ->andWhere(['<=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[1]')"), $_SESSION['duration']])
                ->andWhere(['!=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[4]')"), $_SESSION['dayDepart']])
                ->andWhere(['!=', new \yii\db\Expression("JSON_EXTRACT(checkbox,'$[4]')"), $_SESSION['dayArriver']])
                ->all();
            }
                   
            if ($category == 3)
                $query = ProductItem::find()
                    ->andWhere(['partner_category' => 3])
                    ->andWhere(['product_id' => $product_parent_id1])
                    ->andFilterWhere(['<=', 'min_price', new \yii\db\Expression("price*'$nbrPersson'/people_number")])
                    ->all();
        }
      
        if (empty($this->result) or empty($query) or empty($product_parent_id))
            $query = array();
        

        return $query;
    }
    //This Methode is used for  comparing the orginal address of partner with the client and adding the price of delivery
    public function compareDistanceBetweenOriginalPartnerAndTheAdressFilledByClient($query, $array_partner_filtered_by_address2)
    {
        $query1 = array();
        $counter = 0;
        $just_one = 0;

        if(!empty($query)){
            foreach ($query as $q) {
                foreach ($array_partner_filtered_by_address2 as $element) {
                    //traitement special pour room rental
                    if (($this->value_category_serached == 1 && empty($this->filteraf)) || ($this->filteraf == 1))
                        // if (array_key_exists('product_item_id', $element))
    
                        if ($element['product_item_id'] == $q->id) {
    
                            $just_one = 1;
    
                            $q->distance = $element['distance'];
                            $this->scope = $element['distance'];
                            $query1[] = $q;
                        }
                    if (($this->value_category_serached != 1 && empty($this->filteraf) && $just_one == 0) || ($this->filteraf != 1 && $just_one == 0)) {
    
                        if (array_key_exists('product_item_id', $element))
                            if ($element['product_item_id'] == $q->id) {
                                if (array_key_exists('price', $element)) {
                                    $q->price = $q->price;
                                    $this->deliveryPrice = $element['price'];
                                }
    
    
    
                                $q->distance = $element['distance'];
                                $this->scope = $element['distance'];
                            }
                        if (array_key_exists('product_id', $element))
                            if (in_array($q->product_id, $element['product_id'])) {
                                $q->price = $q->price;
                                $this->deliveryPrice = $element['price'];
                                $q->distance = $element['distance'];
                            }
                    }
                }
    
    
    
    
                $counter++;
            }
        }
    

        if (!empty($query1)) {
            return $query1;
        }
        return $query;
    }
    //This Methode is used for sorting the Products by their distance
    public function SortProducts($query)
    {

        //sortings
        //here  i need to get session categories and session people number from session



        $length = sizeof($query);
        for ($i = 0; $i < $length; $i++) {


            for ($j = 0; $j  < $length; $j++) {
                if ($query[$i]->distance < $query[$j]->distance) {

                    $temp = $query[$i];
                    $query[$i] = $query[$j];
                    $query[$j] = $temp;
                }
            }
        }
        return $query;
    }
    public function sendingDataToSiteController($query)
    {

        if (!empty($query)) {

            $pages = new Pagination(['totalCount' => count($query)]);

            $searchModel = new ProductItemSearch();
            $dataProvider = new ArrayDataProvider([
                'allModels'  => $query,
                'pagination' => [
                    'pageSize' => 3,

                ],
            ]);
            //
            $category = (int)$this->model->category;
            //creating the return array
            $value = array();
            //assigning the return array
            array_push($value, $this->model);
            array_push($value, $this->value_category_serached);
            array_push($value, $dataProvider);
            array_push($value, $pages);
            array_push($value, $searchModel);
            array_push($value, $this->active);
            array_push($value, $category);
            array_push($value, $this->deliveryPrice);

            return ($value);
        }
        if (empty($query)) {
            // die();
            $query = array();
            $pages = new Pagination(['totalCount' => count($query)]);
            $searchModel = new ProductItemSearch();
            $dataProvider = new ArrayDataProvider([
                'allModels'  => $query,
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);
            $category = (int)$this->model->category;
            $value = array();
            array_push($value, $this->model);
            array_push($value, $this->value_category_serached);
            array_push($value, $dataProvider);
            array_push($value, $pages);
            array_push($value, $searchModel);
            if (empty($this->active))
                array_push($value, 0);
            else
                array_push($value, $this->active);
            array_push($value, $category);
            array_push($value, $this->deliveryPrice);


            // die();
            return ($value);
        }
        $pages = new Pagination(['totalCount' => count($query)]);

        $searchModel = new ProductItemSearch();
        $dataProvider = new ArrayDataProvider([
            'allModels'  => $query,

            'pagination' => [
                'pageSize' => 3,

            ],
        ]);

        $category = (int)$this->model->category;
        //creating the return array
        $value = array();
        //assigning the return array
        array_push($value, $this->model);
        array_push($value, $this->value_category_serached);
        array_push($value, $dataProvider);
        array_push($value, $pages);
        array_push($value, $searchModel);
        array_push($value, $this->active);
        array_push($value, $category);
        array_push($value, $this->deliveryPrice);




        return ($value);
    }
}
