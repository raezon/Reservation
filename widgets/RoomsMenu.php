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
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class RoomsMenu extends \yii\bootstrap\Widget
{
    public $name;
    public $type;
    public $categories;

    public function init()
    {
        parent::init();
    }
    public function constructSecurityPlans($name, $temp)
    {
        $typeOfRoom = array();
        $spaceForRent = array();
        $indexTypeOfRomm = 0;
        $indexSpaceOfRent = 0;
        for ($i = 0; $i < count($name); $i++) {
            $typeOfRoom[$indexTypeOfRomm]['typeOfRoom'] = $name[$i];
            $indexTypeOfRomm++;
        }

        for ($i = 0; $i < count($temp); $i++) {
            $spaceForRent[$indexSpaceOfRent]['spaceForRent'] = $temp[$i];
            $indexSpaceOfRent++;
        }



        $table_rows_KindOfFood = $this->constructtypeOfEvent($typeOfRoom);
        $table_rows_Meal = $this->constructpositionHeld($spaceForRent);
        return  '
                <div class="card" style="background-color:#ffffff;border-radius:0px;margin-left:170px;margin-top:40px;width:75%;">
                    <div class="card-header  text-center headerColor bg-gray">
                            <b>Choise the type of event</b>
                    </div>
                    <div class="card-body">
                            <div class="floatLeft">
                                <table class="table table-striped table-sm">
                                <thead class="bg-gray">
                                <tr>
                                    <th  style="color:#f7c33f;font-size:13px;">Type of event </th>
                                    
                                </tr>
                                </thead>
                                <tbody class="col-6"  style="background-color:#eeeeee;"  >
                                        ' . $table_rows_KindOfFood . '
                                
                                </tbody>
                            
                                </table>
                            </div>

                            <div class="floatRight">
                                <table class="table table-striped table-sm">
                                <thead class="bg-gray">
                                <tr>
                                   
                                    <th  style="color:#f7c33f;font-size:13px;">Position held</th>
                                </tr>
                                </thead>
                                <tbody class="col-sm-6"  style="background-color:#eeeeee;"  >
                                    
                                        ' . $table_rows_Meal . '
                                </tbody>
                            
                                </table>
                            </div>
                    </div>
                </div>
        ';
    }
    public function constructtypeOfEvent($typeOfRooms)
    {
        $index1 = -1;
        $table_rows = '';
        // print_r($mealPlan);
        foreach ($typeOfRooms as $typeOfRoom) {
            $index1++;

            $table_rows .= '        
                                <tr>
                                   <td> 
                                        <div class="custom-control custom-checkbox">
                                    
                                            <input value="' . $index1 . '"  type="checkbox" class="custom-control-input" >
                                            <input   type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" ></label>
                                                ' . $typeOfRoom['typeOfRoom'] . '
                                        </div>
                                    </td>   
                                </tr>';
        }
        return $table_rows;
    }
    public function constructpositionHeld($spaceForRents)
    {

        $table_rows_type = "";
        $index1 = 100;
        $index = 0;

        //echo json_encode($meals, JSON_PRETTY_PRINT);
        foreach ($spaceForRents as $spaceForRent) {
            $index1++;

            $table_rows_type .= '
                         
                                <tr>
                                   <td> 
                                        <div class="custom-control custom-checkbox">
                                    
                                            <input value="' . $index1 . '"  type="checkbox" class="custom-control-input" >
                                            <input   type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" ></label>
                                                ' . $spaceForRent['spaceForRent'] . '
                                        </div>
                                    </td>
                                    
                                </tr>';
        }
        return $table_rows_type;
    }
    public function run()
    {
        parent::run();
        //creation of the table corresponding for the extra
        if ($this->categories == 1) {
            $this->name = json_decode($this->name, true);
            $this->type = json_decode($this->type, true);
            $result = $this->constructSecurityPlans($this->name, $this->type);
            return  $result;
        }
    }
}
