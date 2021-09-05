<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Djeabla ammar<amardjebabala10@gmail.com>
 */
class Caters extends \yii\bootstrap\Widget
{
    public $cater;
    public $categories;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
        if ($this->categories == 3) {


            $cater = json_decode($this->cater, true);
            //creation of the table corresponding for the extra
            $accept = "";
            $accptTitle = "";
            if ($cater["vegan"]) {
                $accept .= "<div class='grid-item'><img style='margin-left:3%' class='center' src='img/logos_detail/caters/vegan.png' width='50px' height='50px'/></div>";
                $accptTitle .= " <div class='grid-item'><span style='margin-left:10px;font-size:12.2px'><b>Vegan</b></span></div> ";
            }

            if ($cater["Vegetarian"]) {
                $accept .= "<div class='grid-item'><img style='margin-left:17%;' class='center' src='img/logos_detail/caters/vegetarian.png' width='50px' height='50px'/></div>";
                $accptTitle .= " <div class='grid-item'><span style='margin-left:10px;font-size:12.2px'><b>Vegetarian</b></span></div> ";
            }

            if ($cater["Organic"]) {
                $accept .= "<div class='grid-item'><img style='margin-left:7%' class='center' src='img/logos_detail/caters/organic.png' width='50px' height='50px'/></div>";
                $accptTitle .= " <div class='grid-item'><span style='margin-left:10px;font-size:12.2px'><b>Organic</b></span></div> ";
            }


            if ($cater["Gluten_free"]) {
                $accept .= "<div class='grid-item'><img style='margin-left:3%;' class='center' src='img/logos_detail/caters/gluteenfee.png' width='50px' height='50px'/></div>";
                $accptTitle .= " <div class='grid-item'><span style='margin-left:10px;font-size:12.2px'><b>Gluten free</b></span></div> ";
            }
            //Facilities
            if ($cater["Halal"]) {
                $accept .= "<div class='grid-item'><img  style='margin-left:4%;' class='center' src='img/logos_detail/caters/halal.png' width='50px' height='50px'/></div>";
                $accptTitle .= " <div class='grid-item'><span style='margin-left:10px;font-size:12.2px'><b>Halal</b></span></div> ";
            }
            if ($cater["Cacher"]) {
                $accept .= "<div class='grid-item'><img style='margin-left:3%;' class='center' src='img/logos_detail/caters/kosher.png' width='50px' height='50px'/></div>";
                $accptTitle .= " <div class='grid-item'><span style='margin-left:10px;font-size:12.2px'><b>Cacher</b></span></div> ";
            }
            if ($cater["Without_porc"]) {
                $accept .= "<div class='grid-item'><img style='margin-left:3%;' class='center' src='img/logos_detail/caters/withourporc.png' width='50px' height='50px'/></div>";
                $accptTitle .= " <div class='grid-item'><span style='margin-left:10px;font-size:12.2px'><b>Without porc</b></span></div> ";
            }


            return  "
                    
                            <!--Type of foods-->
                                            
                                    <div class='grid-container '>
                                        " . $accept . "
                                        
                                    </div>
                                    <div class='grid-container'>
                                         " . $accptTitle . "
                
                                    </div>
                          
            ";
        }
    }
};
