<?php

namespace app\models;

use \app\models\base\ProductItem as BaseProductItem;
use codeonyii\yii2validators\AtLeastValidator;

/**
 * This is the model class for table "product_item".
 */
class ProductItemCamera extends BaseProductItem
{
    /**
     * @inheritdoc
     */

    public $vegan;
    public $Vegetarian;
    public $Organic;
    public $Gluten_free;
    public $Halal;
    public $Cacher;
    public $Without_porc;
    public $Spanish;
    public $Frensh;
    public $English;
    public $Deutsh;
    public $image;
    public $Chinesse;
    public $area;
    public $extra;
    public $caution;
    public $piscina;
    public $additional_hour;
    public $min_consomation;
    public $services;
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
    public $IBAN;
    public $BIC_SWIFT;
    public $Bank_name;
    public $Bank_country;
    public $File;
    public $services_F;
    public $extra_p;
    public $extra_t;
    public $photo1;
    public $video1;
    public $photo1andvideo;
    public $photo2;
    public $video2;
    public $photo2andvideo;

    public function rules()
    {
        return
            [
                [[
                    'name', 'price', 'vegan', 'Vegetarian', 'Organic', 'Gluten_free', 'Halal', 'Cacher', 'Without_porc', 'image', 'area', 'caution', 'partner_category',
                    'photo1', 'video1', 'photo1andvideo', 'photo2', 'video2', 'photo2andvideo'
                ], 'safe'],

                [['Board', 'System_Sound', 'Micro', 'To_bring_back_cake_of_the_event', 'To_bring_back_drinks', 'Parking_lot', 'Parking_lot_field', 'Subway', 'Subway_field', 'Train', 'Train_field', 'Bus', 'Bus_field', 'Video_projector', 'Wifi', 'currencies_symbol', 'vegan', 'glutenfree', 'Halal', 'Kosher', 'Organic', 'Withoutpork', 'working_day', 'working_night', 'prix_day', 'prix_night', 'Spanish', 'Frensh', 'English', 'Deutsh', 'Chinesse', 'event_cake', 'drink', 'External_food', 'External_Catering', 'Internal_Catering', 'Without_guarantee', 'Minimum_consumption_Price'], 'safe'],
                [['Spanish', 'Frensh', 'English', 'Deutsh', 'Chinesse', 'services', 'extra', 'services_F', 'extra_p', 'extra_t'], 'safe'],
                [['temp', 'description', 'people_number', 'number_of_agent', 'quantity', 'periode', 'currencies_symbol', 'languages', 'picture', 'checkbox', 'status', 'product_id'], 'required'],
                [['partner_category', 'people_number', 'number_of_agent', 'quantity', 'periode', 'status', 'product_id'], 'integer'],
                [['name', 'temp', 'currencies_symbol', 'languages', 'picture', 'image', 'checkbox'], 'string', 'max' => 255],
                [
                    ['name'], 'required',
                    'whenClient' => "function(attribute, value) {
			 			var ifAllempty=0;
			 			var ifnotempty=0;
			 			//check if all name are empty
			 			for (i = 0; i < 6; i++) {
		                            if($('#productitemcamera-'+i+'-name').val()){
		                            	ifAllempty=1;
		                            }	
		                          }

		                  if(ifAllempty==0)
		                  	return true;
	         			 			//check one by one
		                for (j = 0; j < 6; j++) { 
		                        for (i = 0; i < 6; i++) {
		                           if(!$('#productitemcamera-'+j+'-name').val()){
		                            	 if(($('#productitemcamera-'+i+'-price').val().length ===0))
			                            {
			                                if(i==j)
			                               	  ifnotempty=1 ;
			                               

			                            }
			                            else{
			                            	if(i==j)
			                               	 return true;
			                            	
			                            		
			                            }
		                            }
		                          }
		                            i=0;
		                      }
		                   if(ifnotempty===0)
		                  	return true;
		                   else
		                   	return false;
		                               
	                    }",
                    'message' => 'At least one of Name field should be filled'
                ],
                [
                    ['price'], 'required',
                    'whenClient' => "function(attribute, value) {
         			 	var ifAllemptyprice=0;
			 			var ifnotemptyprice=0;
			 				//check if all price are empty
			 			
			 					for (i = 0; i < 6; i++) {
		                            if(!($('#productitemcamera-'+i+'-price').val().length==0)){
		                            	ifAllemptyprice=1;
		                            }	
		                          }
		                  if(ifAllemptyprice==0)
		                  	return true;
    		         			 			//check one by one
		                for (j = 0; j < 6; j++) { 
		                        for (i = 0; i < 6; i++) {
		                           if($('#productitemcamera-'+j+'-name').val()){
		                            	 if(($('#productitemcamera-'+i+'-price').val().length ===0))
			                            {
			                                if(i==j)
			                               	 return true;
			                               

			                            }
			                            else{
			                            	 ifnotempty=1 ;
			                            		
			                            }
		                            }else{
		                            	 ifnotempty=1;

		                            }	
		                          }
		                            i=0;
		                      }
		                   if(ifnotempty===0)
		                  	return true;
		                   else
		                   	return false;
		                               
                    }",
                    'message' => 'at least one of Price  should be filled'
                ],
                [
                    ['photo1'], 'required',
                    'whenClient' => "function(attribute, value) {
	                 for (j = 0; j < 6; j++) { 
	                        for (i = 0; i < 6; i++) {
	                            if($('#productitemcamera-'+i+'-name').val()){
	                            	 if((!($('#productitemcamera-'+i+'-price').val()==0)))
		                            {
		                                return  false ;

		                            }
		                            else{
		                            	return true;
		                            }
	                            }
	                          }
	                            i=0;
	                      }
	                               
                    }",
                    'message' => 'At least one box should be selected'
                ],

            ];
    }





    public function attributeLabels()
    {
        return [
            'produit_nom' => \Yii::t('app', 'Name of Product'),
            'produit_option' => \Yii::t('app', 'Option of Product'),
            'produit_type' => \Yii::t('app', 'Type of Product'),
            'nombre_de_persson' => \Yii::t('app', 'Number of people'),
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
            'extra_t' => \Yii::t('app', ''),
            'extra_p' => \Yii::t('app', ''),
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
            'photo1' => \Yii::t('app', ''),
            'photo2' => \Yii::t('app', ''),
            'video1' => \Yii::t('app', ''),
            'video2' => \Yii::t('app', ''),
            'photo1andvideo' => \Yii::t('app', ''),
            'photo2andvideo' => \Yii::t('app', ''),

        ];
    }
}
