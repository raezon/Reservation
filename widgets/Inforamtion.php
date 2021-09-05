<?php

namespace app\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

use app\widgets\Caters as WidgetsCater;
use app\widgets\Languages as WidgetsLanguages;

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
class Inforamtion extends \yii\bootstrap\Widget
{
    public $category;
    public $qte;
    public $duration;
    public $number_of_people;
    public $number_of_agent;
    public $cautionAndArea;
    public $temp;
    public $name;
    public $description;
    public $camera;
    public $kind_of_food;
    public $product;
    public $product_parent;
    public $Languages;
    public $categories;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();

        //creation of the table corresponding for the extra

        $information = "";
        $information_title = "";
        $extra_span = "";
        $RoomRental = json_decode($this->cautionAndArea, true);


        switch ($this->category) {
            case 1:
                $description = json_decode($this->description, true);
                $this->description = $description[0];
                $temp = json_decode($this->temp, true);
                $this->temp = $temp[0];
                $temp = str_replace(' ', '', $temp);
                $information .= "<div class='grid-item'><img src='img/logos_detail/Room_rental/typesOfRooms/" . $temp[0] . ".png' width='50px' height='50px'/></div>";
                $information .= "<div class='grid-item'><img src='img/logos_detail/Room_rental/spaceForRent/" . $description[0] . ".png' width='50px' height='50px'/></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:-3px;font-size:12px' ><b>" . $this->temp . "</b></span></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:-3px;font-size:12px' ><b>" . $this->description . "</b></span></div>";
                break;

            case 2:
                $information_title = "Global information for this service";
                $information .= "<div class='grid-item'><img src='img/logos_detail/equipement_quantity.png' width='50px' height='50px'/><span><b>" . $this->qte . "</b></span></div>";
                $information .= "<div class='grid-item'><img style='margin-left:6px;' src='img/logos_detail/time.png' width='50px' height='50px'/><span><b>" . $this->duration . "H</b></span></div>";
                $information .= "<div class='grid-item'><img style='margin-left:20px;' src='img/logos_detail/persons-number-symbol.png' width='50px' height='50px'/><span> <b>" . $this->number_of_people . "</b></span></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:3px;font-size:12px' ><b>Quantity</b></span></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:3px;font-size:12px' ><b>Duration</b></span></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:-3px;font-size:12px'><b>People Number</b></span></div>";
                break;
            case 3:
                $information_title = "Global information for this dish";
                $information .= "<div class='grid-item'><img src='img/logos_detail/" . $this->temp . ".png' width='50px' height='50px'/></div>";
                $information .= "<div class='grid-item'><img src='img/logos_detail/type_of_food.png' width='50px' height='50px'/></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:20px;font-size:12px'><b>" . $this->temp . "</b></span></div> ";
                $extra_span .= "<div class='grid-item'><span style='margin-left:-5px;font-size:12px'><b>" . $this->kind_of_food . " food</b></span></div> ";

                break;
            case 4:


                break;
            case 5:
                $information_title = "Global information for this service";
                $information .= "<div class='grid-item'><img src='img/logos_detail/animation.png' width='50px' height='50px'/><span><b>2</b></span></div>";
                $information .= "<div class='grid-item'><img style='margin-left:6px;' src='img/logos_detail/time.png' width='50px' height='50px'/><span><b>" . $this->duration . "H</b></span></div>";
                break;
            case 6:
                $information_title = "Global information for this service";
                $name = json_decode($this->name, true);
                $this->name = $name[0];
                $temp = json_decode($this->temp, true);
                $this->temp = $temp[0];
                $temp = str_replace(' ', '', $temp);
                $information .= "<div class='grid-item'><img src='img/logos_detail/Security/" . $this->name . ".png' width='50px' height='50px'/></div>";
                $information .= "<div class='grid-item'><img src='img/logos_detail/Security/position_heald/" . $this->temp . ".png' width='50px' height='50px'/></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:2px;font-size:12px'><b>" . $this->name . "</b></span></div> ";
                $extra_span .= "<div class='grid-item'><span style='margin-left:-10px;font-size:12px'><b>" . $this->temp . "</b></span></div> ";
                $information .= "<div class='grid-item'><img style='margin-left:6px;' src='img/logos_detail/time.png' width='50px' height='50px'/><span><b>" . $this->duration . "H</b></span></div>";
                $information .= "<div class='grid-item'><img style='margin-left:20px;' src='img/logos_detail/persons-number-symbol.png' width='50px' height='50px'/><span> <b>" . $this->number_of_agent . "</b></span></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:3px;font-size:12px' ><b>Duration</b></span></div>";
                $extra_span .= "<div class='grid-item'><span style='margin-left:-3px;font-size:12px'><b>Agent Number</b></span></div>";
                break;
            case 7:
                $information_title = "Global information for this service";
            

                break;
            case 9:
                $information_title = "Global information for this service";
                $information .= "<div class='grid-item'><img src='img/logos_detail/other.png' width='50px' height='50px'/><span><b>2</b>" . $this->qte . "</span></div>";
                $information .= "<div class='grid-item'><img style='margin-left:6px;' src='img/logos_detail/time.png' width='50px' height='50px'/><span><b>" . $this->duration . "H</b></span></div>";
                $information .= "<div class='grid-item'><img style='margin-left:20px;' src='img/logos_detail/persons-number-symbol.png' width='50px' height='50px'/><span> <b>" . $this->number_of_people . "</b></span></div>";
                break;
        }


        if ($this->category == 3 )
            return  '
        <div class="card" style="background-color:#fffffff;;border-radius:0px;margin-left:170px;margin-top:40px;width:75%;">
            <div class="card-header text-center headerColor bg-gray" >
                   <b>' . $information_title . '</b>
            </div>
            <div class="card-body">
                <div class="grid-container">
                ' . $information . '
            
                </div>
                <div class="grid-container">

                        ' . $extra_span . '
                </div>
                    ' . WidgetsCater::widget(['cater' => $this->product, 'categories' => $this->product_parent]) . '
             
            </div>
        </div>';
        if ($this->category == 7)
        return  '
    <div class="card" style="background-color:#fffffff;;border-radius:0px;margin-left:170px;margin-top:40px;width:75%;">
        <div class="card-header text-center headerColor bg-gray" >
               <b>' . $information_title . '</b>
        </div>
        <div class="card-body">
            <div class="grid-container">
            ' . $information . '
        
            </div>
            <div class="grid-container">

                    ' . $extra_span . '
            </div>
                ' . WidgetsLanguages::widget(['Languages' => $this->Languages, 'categories' => $this->categories]) . '
        </div>
    </div>';
    }
};
