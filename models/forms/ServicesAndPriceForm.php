<?php

namespace app\models\forms;

/**
 * This is the base model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property integer $partener_id
 * @property string $created_date
 */
class ServicesAndPriceForm extends \yii\base\Model
{
    public $produit_nom;
    public $produit_option;
    public $produit_description;
    public $produit_type;
    public $nombre_de_persson;
    public $nombre_de_equipement;
    public $quantity;
    public $description;
    public $description1;
    public $price;
    public $diet;
    public $working_day;
    public $working_night;
    public $imageFile;
    public $prix_livraison;
    public $prix_day;
    public $prix_night;
    public $prix_heure;
    public $duration;
    public $adress;
    public $prix_serveur;
    public $area;
    public $extra;
    public $caution;
    public $number_of_agent;
    public $piscina;
    public $additional_hour;
    public $min_consomation;
    public $services;
    public $Arabic;
    public $Frensh;
    public $English;
    public $Deutsh;
    public $Japenesse;
    public $event_cake;
    public $drink;
    public $External_food;
    public $External_Catering;
    public $Internal_Catering;
    public $Without_guarantee;
    public $Minimum_consumption_Price;
    public $Wifi;
    public $Board;
    public $System_Sound;
    public $Micro;
    public $To_bring_back_cake_of_the_event;
    public $To_bring_back_drinks;
    public $Parking_lot;
    public $Parking_lot_field;
    public $Video_projector;
    public $Subway;
    public $Subway_field;
    public $Train;
    public $Train_field;
    public $Bus;
    public $Bus_field;
    public $vegan;
    public $glutenfree;
    public $Halal;
    public $Kosher;
    public $Organic;
    public $Withoutpork;
    public $IBAN;
    public $BIC_SWIFT;
    public $Bank_name;
    public $Bank_country;
    public $File;
    public $services_F;
    public $extra_p;
    public $extra_t;
    public $adress_roomRental;
    public $desriptionRoom;
    public $CompanyName;
    public $idi;
    public $ouvertureFermuture;
    public $minRentalPeriode;
    public $maxRentalPeriode;
    public $minNumberGuest;
    public $maxNumberGuest;
    public $maxSeats;
    public $closedDay;
    public $weekendSurcharge;
    public $deposit;
    public $advancePayment;
    public $fullDay;

    public function rules()
    {
        return [
            // username rules
            [['CompanyName','price', 'produit_nom', 'produit_option', 'produit_type', 'produit_description', 'nombre_de_persson', 'quantity', 'description', 'description1', 'diet', 'imageFile', 'prix_livraison', 'adress', 'prix_serveur', 'area', 'caution', 'extra', 'duration', 'prix_heure', 'nombre_de_equipement', 'adress_roomRental', 'desriptionRoom','minRentalPeriode','maxRentalPeriode.period1','minNumberGuest','maxSeats','closedDay','weekendSurcharge','deposit','advancePayment','fullDay','maxNumberGuest','services'], 'required'],
            [['Board', 'System_Sound', 'Micro', 'To_bring_back_cake_of_the_event', 'To_bring_back_drinks', 'Parking_lot', 'Parking_lot_field', 'Subway', 'Subway_field', 'Train', 'Train_field', 'Bus', 'Bus_field', 'Video_projector', 'Wifi', 'currencies_symbol', 'vegan', 'glutenfree', 'Halal', 'Kosher', 'Organic', 'Withoutpork', 'working_day', 'working_night', 'prix_day', 'prix_night', 'Arabic', 'Frensh', 'English', 'Deutsh', 'Japenesse', 'event_cake', 'drink', 'External_food', 'External_Catering', 'Internal_Catering', 'Without_guarantee', 'Minimum_consumption_Price', 'services_F', 'extra_p', 'extra_t', ], 'safe'],
            [['Minimum_consumption_Price', 'nombre_de_persson', 'area'], 'number'],
            [['idi'], 'safe'],
            [['currencies_symbol', 'extra'], 'string'],

            // [['imageFile'], 'file', 'extensions' => ['png', 'jpg', 'gif']]
            [['imageFile'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxFiles' => 10],
            [
                ['ouvertureFermuture'], 'required',
                'whenClient' => "function(attribute, value) {
                
                endDate =$('#servicesandpriceform-ouverturefermuture-0-period1-disp').val()
                var res = endDate.split(':');
                var hour=res[0]
                var response='true'
           //     alert(res)
               // endDate = new Date(endDate);
               // hourA=endDate.getHours()-1;
               // if(hourA==-1)
               //     hourA=endDate.getHours()+1;
             

              
             //  $('[name=".'servicesandpriceform-ouverturefermuture-0-period1-disp'."]').prop('required', true);
              
               // if (hourA > 0) { 
                //  return  true;
                    
               // }
             
                return true;
                              
                                   
                    }",
                'message' => 'At least one of Name field should be filled'
            ],
        ];
      
    }
    public function checkIsArray(){
        if(!($this->ouvertureFermuture)){
            $this->addError('x','X is not array!');
        }
   }
    /**
     * @inheritdoc
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('../img/' . $this->image->baseName . '.' .
                $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
    public function init()
    {
        parent::init();

        $this->ouvertureFermuture = [
            [
                'Day'       => 'From',
                'Period1'=>\kartik\widgets\TimePicker::className(),
            ],
            [
                'Day'       => 'To',
                'Peiod1' => \kartik\widgets\TimePicker::className(),
                'heureDouverture'=>'',
                'heureFermuturee'=>'',
                'dureeMax'=>'',
                'unitPrice3h'=>'',
                'unitPriceHalfDay'=>'',
                'unitPriceTotalDay'=>'',
            ],
            [
                'Day'       => 'Banquet \\ Dinner',
                 'Period1'=> MaskMoney::class,
                'heureDouverture'=>'',
                'heureFermuturee'=>'',
                'dureeMax'=>'',
                'unitPrice3h'=>'',
                'unitPriceHalfDay'=>'',
                'unitPriceTotalDay'=>'',
            ],
            [
                'Day'       => 'Cinema',
                'Ouvert_fermer' =>'',
                'heureDouverture'=>'',
                'heureFermuturee'=>'',
                'dureeMax'=>'',
                'unitPrice3h'=>'',
                'unitPriceHalfDay'=>'',
                'unitPriceTotalDay'=>'',
            ],
            [
                'Day'       => 'Cocktail',
                'Ouvert_fermer' =>'',
                'heureDouverture'=>'',
                'heureFermuturee'=>'',
                'dureeMax'=>'',
                'unitPrice3h'=>'',
                'unitPriceHalfDay'=>'',
                'unitPriceTotalDay'=>'',
            ],
            [
                'Day'       => 'Conference',
                'Ouvert_fermer' =>'',
                'heureDouverture'=>'',
                'heureFermuturee'=>'',
                'dureeMax'=>'',
                'unitPrice3h'=>'',
                'unitPriceHalfDay'=>'',
                'unitPriceTotalDay'=>'',
            ],
            [
                'Day'       => 'Meeting',
                'Ouvert_fermer' =>'',
                'heureDouverture'=>'',
                'heureFermuturee'=>'',
                'dureeMax'=>'',
                'unitPrice3h'=>'',
                'unitPriceHalfDay'=>'',
                'unitPriceTotalDay'=>'',
            ],
            [
                'Day'       => 'Theater',
                'Ouvert_fermer' =>'',
                'heureDouverture'=>'',
                'heureFermuturee'=>'',
                'dureeMax'=>'',
                'unitPrice3h'=>'',
                'unitPriceHalfDay'=>'',
                'unitPriceTotalDay'=>'',
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'produit_nom' => \Yii::t('app', 'Name of Product'),
            'produit_option' => \Yii::t('app', 'Option of Product'),
            'produit_type' => \Yii::t('app', 'Type of Product'),
            'nombre_de_persson' => \Yii::t('app', 'Maximum number of guests / accommodation capacity :'),
            'quantity' => \Yii::t('app', 'Quantity'),
            'description' => \Yii::t('app', 'Name'),
            'description1' => \Yii::t('app', 'Description'),
            'price' => \Yii::t('app', 'Price'),
            'diet' => \Yii::t('app', 'Price'),
            'imageFile' => \Yii::t('app', 'Image'),
            'prix_livraison' => \Yii::t('app', 'Price delivery'),
            'adress' => \Yii::t('app', 'Our adress'),
            'prix_serveur' => \Yii::t('app', 'Price Server'),
            'area' => \Yii::t('app', 'Space'),
            'extra' => \Yii::t('app', 'Extra'),
            'caution' => \Yii::t('app', 'caution'),
            'duration' => \Yii::t('app', 'Duration'),
            'prix_day' => \Yii::t('app', 'Prix of  Day'),
            'prix_night' => \Yii::t('app', 'Price ofNight'),
            'prix_heure' => \Yii::t('app', 'Price per hour'),
            'number_of_agent' => \Yii::t('app', 'Number of agents'),
            'piscina' => \Yii::t('app', '   '),
            'additional_hour' => \Yii::t('app', 'Additional hour price'),
            'duration' => \Yii::t('app', 'Duration'),
            'min_consomation' => \Yii::t('app', 'Minimal Consamation'),
            'services' => \Yii::t('app', 'Add Other Services'),
            'extra_t' => \Yii::t('app', 'Add Other Services'),
            'extra_p' => \Yii::t('app', 'Add Other Services'),
            'event_cake' => \Yii::t('app', ''),
            'drink' => \Yii::t('app', ''),
            'External_food' => \Yii::t('app', ''),
            'External_Catering' => \Yii::t('app', ''),
            'Internal_Catering' => \Yii::t('app', ''),
            'Without_guarantee' => \Yii::t('app', ''),
            'Minimum_consumption_Price' => \Yii::t('app', ''),
            'Wifi' => \Yii::t('app', ''),
            'Board' => \Yii::t('app', ''),
            'System_Sound' => \Yii::t('app', ''),
            'Micro' => \Yii::t('app', ''),
            'To_bring_back_cake_of_the_event' => \Yii::t('app', ''),
            'To_bring_back_drinks' => \Yii::t('app', ''),
            'Parking_lot' => \Yii::t('app', ''),
            'Parking_lot_field' => \Yii::t('app', ''),
            'Subway' => \Yii::t('app', ''),
            'Subway_field' => \Yii::t('app', ''),
            'Train' => \Yii::t('app', ''),
            'Train_field' => \Yii::t('app', ''),
            'Bus' => \Yii::t('app', ''),
            'Bus_field' => \Yii::t('app', ''),
            'Video_projector' => \Yii::t('app', ''),
            'vegan' => \Yii::t('app', ''),
            'glutenfree' => \Yii::t('app', ''),
            'Halal' => \Yii::t('app', ''),
            'Kosher' => \Yii::t('app', ''),
            'Organic' => \Yii::t('app', ''),
            'Withoutpork' => \Yii::t('app', ''),
            'nombre_de_equipement' => \Yii::t('app', ''),
            'adress_roomRental' => \Yii::t('app', 'Adress RoomRental'),
            'minRentalPeriode' => \Yii::t('app', 'Minimum rental period (in hour)'),
            'maxRentalPeriode' => \Yii::t('app', 'Maximum rental period (in hour)'),
            'minNumberGuest' => \Yii::t('app', 'Minimum number of guests to order'),
            'c' => \Yii::t('app', 'Maximum number of guests / accommodation capacity :'),
            'maxSeats' => \Yii::t('app', 'Maximum number of seats'),
            'closedDay'  => \Yii::t('app', 'Closed days'),
            'weekendSurcharge' => \Yii::t('app', 'weekend surcharge'),
            'deposit'  => \Yii::t('app', 'Deposit'),
            'advancePayment' => \Yii::t('app', 'Advance payment')
        
        ];
    }
}
