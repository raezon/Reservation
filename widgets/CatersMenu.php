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
class CatersMenu extends \yii\bootstrap\Widget
{
    public $name;
    public $type;
    public $categories;

    public function init()
    {
        parent::init();
    }
    public function constructMealPlans($elements)
    {
        $kindOfFood = array();
        $counterMealPlan = 0;


        $j = 0;
        for ($i = 0; $i < count($elements); $i++) {
            $kindOfFood[$counterMealPlan]['kindOfFood'] = $elements[$i];
            $counterMealPlan++;
        }




        $table_rows_KindOfFood = $this->constructKindOfFoodAndMeal($kindOfFood);
        return  '
                <div class="card" style="border-radius:0px;margin-left:170px;margin-top:40px;width:75%;">
                    <div class="card-header text-center headerColor bg-gray">
                            <b>Choise the type of food</b>
                    </div>
                    <div class="card-body">
                            <div class="">
                                <table class="table table-striped table-sm">
  
                                <tbody class="col-6"  style="background-color:#febb02;"  >
                                        ' . $table_rows_KindOfFood . '
                                
                                </tbody>
                            
                                </table>
                            </div>
                    </div>
                </div>
        ';
    }
    public function constructKindOfFoodAndMeal($kindOfFoods)
    {
        $index1 = -1;
        $table_rows = '';
        // print_r($mealPlan);
        foreach ($kindOfFoods as $kindOfFood) {
            $index1++;
            $index1++;
            $splitedMeal = (explode(":", $kindOfFood['kindOfFood']));
            if (empty($splitedMeal[1]))
                $splitedMeal[1] = "";
            else
                $splitedMeal[0] = $splitedMeal[0] . ' : ';
            $table_rows .= '
                         
                                <tr>
                                   <td> 
                                        <div class="custom-control custom-checkbox">
                                    
                                            <input value="' . $index1 . '"  type="checkbox" class="custom-control-input" >
                                            <input   type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" ></label>
                                                ' . $splitedMeal[0] . '' . $splitedMeal[1] . '
                                        </div>
                                    </td>
                                    
                                </tr>';
        }
        return $table_rows;
    }
    public function constructMeal($meals)
    {

        $table_rows_type = "";
        $index1 = 100;
        $index = 0;

        //echo json_encode($meals, JSON_PRETTY_PRINT);
        foreach ($meals as $meal) {
            $index1++;
            $splitedMeal = (explode(":", $meal['meal']));

            $table_rows_type .= '
                         
                                <tr>
                                   <td> 
                                        <div class="custom-control custom-checkbox">
                                    
                                            <input value="' . $index1 . '"  type="checkbox" class="custom-control-input" >
                                            <input   type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" ></label>
                                                ' . $splitedMeal[0] . ' : ' . $splitedMeal[1] . '
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
        if ($this->categories == 3) {
            $this->name = array_unique(json_decode($this->name, true));
            $this->type = json_decode($this->type, true);
            $result = $this->constructMealPlans($this->type[count($this->type) - 1]);
            return  $result;
        }
    }
}
