<?php

namespace app\views\welcome\widgets;

use Yii;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use yii\helpers\Html;
use yii\bootstrap\Progress;
use app\models\base\TblEvents;
use yii\bootstrap\Modal;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Partner;
use kartik\money\MaskMoney;


class Step2 extends \yii\web\Controller
{
    public static  $step1Array;
    public static  $delai;
    public static  $form;
    public static  $listData;
    public $scriptJS;
    public    function __construct()
    {
        //Intialiazing delai
        self::$delai = array();
        self::$delai = [
            ['id' => '1', 'name' => '1 mont in advance'],

            ['id' => '2', 'name' => '3 weeks in advance'],

            ['id' => '3', 'name' => '15 days in advance'],

            ['id' => '4', 'name' => '7 days in advance'],

            ['id' => '5', 'name' => '5 days in advance'],

            ['id' => '6', 'name' => '3 days in advance'],

            ['id' => '7', 'name' => '2 days in advance'],

            ['id' => '8', 'name' => '1 days in advance'],

            ['id' => '9', 'name' => 'The same day']
        ];
        echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTGpqrJDrULNO0PNch-b8vlmcwwGt7D2c&libraries=places&callback=initAutocomplete" async defer></script>';
        self::getView()->registerJsFile('@web/js/google_extra.js');
        self::$listData = ArrayHelper::map(self::$delai, 'name', 'name');
    }
    public static  function currencies()
    {
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
        \Yii::$app->params['maskMoneyOptions']['prefix'] =  $currencies_symbol;
    }
    public static function date()
    {
        $date_of_starting = date("Y-m-d");
        $end_of_starting = date('Y-m-d', strtotime('+3 Years'));
        //adding to the date of now
        //partie insertion dans la table event
        $date_of_starting = date("Y-m-d");
        $end_of_starting = date('Y-m-d', strtotime('+3 Years'));
        //adding to the date of now
        function getDatesFromRange($start, $end, $format = 'Y-m-d')
        {
            $array = array();
            $interval = new \DateInterval('P1D');
            $realEnd = new \DateTime($end);
            $realEnd->add($interval);
            $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd);
            foreach ($period as $date) {
                $array[] = $date->format($format);
            }

            return $array;
        }
        $array = getDatesFromRange($date_of_starting, $end_of_starting);
        //insert $data in the model even
        $i = 0;
        $numItems = count($array);

        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
        $id_partenaire = $partner->id;
        $exist = TblEvents::find()->where(['partner_id' => $partner->id])->one();
        if (is_null($exist)) {
            foreach ($array as $key => $value) {

                $model5 = new TblEvents();
                $model5->id = $i;
                $model5->title = "Available";
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
    }

    public static  function beginingContainer()
    {
        echo '<div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h4></h4>
                    </div>';
    }
    public static function begginingActiveForm()
    {
        self::$form = ActiveForm::begin([
            'id' => 'partner-registration-form',
            //      'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'method' => 'post',
            'action' => ['welcome/send']
        ]);
        echo Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0));
    }
    public static function contentActiveForm($model2, $category_id)
    {
        echo '<div class="row">';
        echo ' <div class="col-md-6">';
        //Constructing the form
        $step2Array = array();
        $step2Array = ['idi', 'cat_id', 'search', 'companyAddress', 'companyAddress_N', 'city', 'state', 'postalCode', 'delai', 'schedule'];

        foreach ($step2Array as $filedElement) {
            switch ($filedElement) {
                case 'idi':
                    echo self::$form->field($model2, $filedElement)->hiddenInput(['value' => 2])->label(false);
                    break;
                case 'cat_id':
                    echo self::$form->field($model2, $filedElement)->hiddenInput(['value' => $category_id])->label(false);
                    break;
                case 'search':
                    echo '<div id="locationField">';
                    echo  self::$form->field($model2, 'search')->textInput(['id' => 'autocomplete'])->label('Adress');
                    echo '</div>';
                    break;


                case 'city':
                    echo "<tr>
                            <td class='wideField' colspan='3'>" . self::$form->field($model2, 'city')->textInput(['id' => 'locality'])->label('City') . "</td>
                        </tr>";
                    break;
                case 'state':
                    echo "<tr>
                            <td class='slimField'>";
                    echo self:: $form->field($model2, 'state')->widget(Select2::classname(), ([
                        'name' => 'place_algeria',

                        'data' =>[
                           "Adrar"=> "Adrar",
                            "Chlef"=>"Chlef",
                            "Laghouat"=>"Laghouat",
                            "Oum El Bouaghi"=> "Oum El Bouaghi",
                            "Batna"=>"Batna",
                            "Béjaia"=>"Béjaia",
                            "Biskra"=>"Biskra",
                            "Béchar"=>"Béchar",
                            "Blida"=>"Blida",
                            "Bouira"=>"Bouira",
                            "Tamanrasset"=>"Tamanrasset",
                            "Tébessa"=>"Tébessa",
                            "Télemcen"=>"Télemcen",
                            "Tiaret"=>"Tiaret",
                            "Tizi Ouzou"=>"Tizi Ouzou",
                            "Alger"=>"Alger",
                            "Djelfa"=> "Djelfa",
                            "Jijel"=>"Jijel",
                            "Sétif"=>"Sétif",
                            "Saida"=>"Saida",
                            "Skikda"=>"Skikda",
                            "Sidi Bel Abbès"=>"Sidi Bel Abbès",
                            "Annaba"=>"Annaba",
                            "Guelma"=>"Guelma",
                            "Constantine"=> "Constantine",
                            "Médéa"=>"Médéa",
                            "Mostaganem"=>"Mostaganem",
                            "M'Sila"=>"M'Sila",
                            "Mascara"=> "Mascara",
                            "Ouargla"=>"Ouargla",
                            "Oran"=>"Oran",
                            "El Bayadh"=> "El Bayadh",
                            "Illizi"=>"Illizi",
                            "Bordj Bou Arreridj"=>"Bordj Bou Arreridj",
                            "Boumerdes"=>"Boumerdes",
                            "El Tarf"=>"El Tarf",
                            "Tindouf"=>"Tindouf",
                            "Tissemsilt"=>"Tissemsilt",
                            "El Oued"=>"El Oued",
                            "Khenchla"=>"Khenchla",
                            "Souk Ahras"=>"Souk Ahras",
                            "Tipaza"=>"Tipaza",
                            "Mila"=>"Mila",
                            "Ain Defla"=> "Ain Defla",
                            "Naama"=> "Naama",
                            "Ain Témouchent"=>"Ain Témouchent",
                            "Ghardaia"=>"Ghardaia",
                            "Relizane"=>"Relizane",
                            "Timimoun"=>"Timimoun",
                            "Bordj Badji Mokhtar"=>"Bordj Badji Mokhtar",
                            "Ouled Djallal"=>"Ouled Djallal",
                            "Béni Abbès"=>"Béni Abbès",
                            "In Salah"=>"In Salah",
                            "In Guezzam"=>"In Guezzam",
                            "Touggourt"=>"Touggourt",
                            "Djanet"=>"Djanet",
                            "El M'Ghair"=>"El M'Ghair",
                            "Meniaa"=> "Meniaa"],

    'options' => ['placeholder' => 'Choisir la willaya...']
]));
                    echo  "</td>
                            <td class='wideField'>" . self::$form->field($model2, 'postalCode')->textInput(['id' => 'postal_code'])->label('Zip code') . "</td>
                          </tr>";

                    break;

                case 'Default':
                    break;
            }
        }

        echo '</div>';
        echo '</div>';

        //hidden Input
        echo  '<input type="hidden" value="1" id="category_id_id" name="">';
        echo   Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0));
        echo '</div>';
    }
    public static  function endingContainer()
    {
        echo ' <div class="form-group">';
        echo ' <div class="pull-right">';
        echo '<button class="btn btn-lg btn-success">Next</button>';
        echo '</div>';
        echo ' <div class="pull-left">';
        echo Html::a('back', Url::to(['welcome/step', 'id' => 1, 'category_id' => Yii::$app->request->get('category_id', 0)]), ['class' => 'btn btn-lg btn-primary', 'data-method' => 'POST']);
        echo ' </div>';
        echo '</div>';
    }
    public static function endingActiveForm()
    {
        ActiveForm::end();
    }

    public static function container($model2, $category_id)
    {
        self::beginingContainer();
        self::begginingActiveForm();
        self::contentActiveForm($model2, $category_id);
        self::endingContainer();

        self::endingActiveForm();
    }
}
