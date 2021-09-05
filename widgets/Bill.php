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
class Bill extends \yii\bootstrap\Widget
{
    public $product_item;
    public $category;
    public $description;
    public $people_number;
    public $date_depart;
    public $date_arriver;
    public $deliveryServiceAndPrice;
    public $product;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
        if($this->category==1){
            $this->description=json_decode($this->description,true);
            if (in_array('Full privatization', $this->description))
                 $this->description=1;
            else
                 $this->description=0;
        }

        $date = explode(" - ", $this->date_depart);
        $date_depart = explode(" ", $date[0]);
        $date_arriver = explode(" ", $date[1]);
        $this->date_depart = $date_depart[0];
        $this->date_arriver = $date_arriver[0];

        //creation of the table corresponding for the extra
        $style = '.quantity {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
          }
          .quantity__minus,
          .quantity__plus {
            display: block;
            width: 22px;
            height: 23px;
            margin: 0;
            background: #dee0ee;
            text-decoration: none;
            text-align: center;
            line-height: 23px;
          }
          .quantity__minus:hover,
          .quantity__plus:hover {
            background: #575b71;
            color: #fff;
          } 
          .quantity__minus {
            border-radius: 3px 0 0 3px;
          }
          .quantity__plus {
            border-radius: 0 3px 3px 0;
          }
          .quantity__input {
            width: 32px;
            height: 19px;
            margin: 0;
            padding: 0;
            text-align: center;
            border-top: 2px solid #dee0ee;
            border-bottom: 2px solid #dee0ee;
            border-left: 1px solid #dee0ee;
            border-right: 2px solid #dee0ee;
            background: #fff;
            color: #8184a1;
          }
          .quantity__minus:link,
          .quantity__plus:link {
            color: #8184a1;
          } 
          .quantity__minus:visited,
          .quantity__plus:visited {
            color: #fff;
          }
          .tbody td {
         background: #ffffff;
        }   
        .tbody tr {
            background: #ffffff;
        }
          
          
          ';
          $min=1;
            //here we calculate our min
 
          if($this->category!=1 && $this->category!=3){
            $header='<div class="col-sm-12" ng-init="price=TotalPrice(' . $this->product_item . ',qty,' . $this->category . ',' . $this->deliveryServiceAndPrice . ')">';
            $input='<input ng-model="qty"  ng-change="IncrementPrice(qty ,' . $this->category . ',' . $this->description . ',' . $this->people_number . ')"  name="quantity" type="number" min="1"  class="quantity__input col-sm-10" value={{qty}} >';
            $delivery='<div class="col-sm-12 "   ng-repeat="e in productSelected">
            <div class="quantity panel-footer text-center">
                <span ng-cloak style="float:left;color:gray" class="col-sm-10">{{e.Description}}:</span>
                <span ng-cloak style="color:gray;font-size:13px;margin-left:-50px;" >{{e.Price}}€</span>
            </div>
        </div>';
          }           

        if($this->category==3){
            $header='<div class="col-sm-12" ng-init="price=TotalPrice(' . $this->product_item . ','.$_SESSION['nbr_persson'].',' . $this->category . ',' . $this->deliveryServiceAndPrice . ')">';
            $minPrice=$this->product->min_price;
            $peopleMin=($minPrice*$this->people_number)/$this->product->price;
            $min=$peopleMin;
            if(fmod($min,$this->people_number)>0){
                $min= $min+1;
            }
               
            
            $delivery='<div class="col-sm-12 "   ng-repeat="e in productSelected">
            <div class="quantity panel-footer text-center">
            
                <span ng-cloak style="float:left;color:gray" class="col-sm-10">{{e.Description}}:</span>
                <span ng-cloak style="color:gray;font-size:13px;margin-left:-50px;" >{{e.Price}}€</span>
            </div>
        </div>';
            //need to calculate the min
            $input='<input ng-model="qty"  ng-change="IncrementPrice(qty ,' . $this->category . ',' .  $this->description . ',' . $this->people_number . ')"  name="quantity" type="number"  min="'.$min.'" class="quantity__input col-sm-10" value={{'.$min.'}} >';
        }
        if($this->category==1){
            $header='<div class="col-sm-12" ng-init="price=TotalPrice(' . $this->product_item . ','.$_SESSION['nbr_persson'].',' . $this->category . ',' . $this->deliveryServiceAndPrice . ')">';
            $delivery='';
            $input='<span style="font-size:11px;"><b>People number </b></span>&nbsp;<input ng-model="qty"  ng-change="IncrementPrice(qty ,' . $this->category . ',' . $this->description . ',' . $this->people_number . ')"  name="quantity" type="number" min="1" max="'.$this->people_number.'" class="quantity__input col-sm-7" value={{'.$_SESSION['nbr_persson'].'}} >';
        }
    
     
        return  '
        <style>' .
            $style
            . '
        </style>
        '.$header.'
        <div class="card" style="background-color:#ffffff;borer-style:solid;border-radius:0px;height:600px;width:350px;margin-top:-120px;margin-left:-70px;">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                    
                        <div class="col-sm-12 text-center">
                           
                                <h3 style="color:#4a4677;font-size:32px;"><b>Billing</b></h3>
                            </br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="padding-bottom:10px; ;">
                            <div class="dropdown">
                                <!-- input name="category" class="form-control" placeholder="Category" data-toggle="dropdown" class="dropdown-toggle" -->
                                <table  class="col-sm-10 table1 " style="margin-left:22px;padding-bottom:20px;height:35px;" border="1">
                                <thead style="border-bottom-style: none;padding-bottom:40px;">  
                                    <tr>
                                    <th style="font-size:12px; margin-left:25px;padding-bottom:20px;"><span style="margin-left:10px;">Starting</span></th>
                                    <th style="font-size:12px;padding-bottom:20px;"><span>Ending</span></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody" style="padding-bottom:40px">  
                                    <tr>
                                    <td class="td" style="font-size:11px;margin-left:15px"><span style="margin-left:10px;">' . $this->date_depart . '<span></td>

                                    <td class="td"  style="font-size:11px;">' . $this->date_arriver . '</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                                </tr>
                                </table>
                            </div>
                        </div>
                        
                 
                        <div class="col-sm-12" style="padding-bottom:10px;">
                            <div class="quantity">
                         <!--   <button  ng-click="qty = qty - 1;DecrementPrice(qty ,' . $this->category . ',' . $this->description . ',' . $this->people_number . ')" class="btn  btn-outline-primary py-0 col-sm-2" style="font-size: 0.8em;">-</button>-->'.
                            $input
                            .'
                      <!--      <button ng-click="qty = qty + 1;IncrementPrice(qty ,' . $this->category . ',' .  $this->description . ',' . $this->people_number . ')" class="btn  btn-outline-primary py-0 col-sm-2" style="font-size: 0.8em;">+</button>-->
                            </div>
                        </div>
                        <!--Reservation button -->
                        <div class="col-sm-12">
                            <!--<input type="submit" class="btn btn-primary shadow ml-sm-auto col-sm-12" value="SEARCH...">-->
                        
                            <button  class="btn btn-sm bg-purple col-sm-10 center"><span>Reservation<span></button>
                        </div>
                        <!--Displaying the total price -->
                       
                        <div class="col-sm-12">
                            <!--Extra Price Displaying-->
                            </br>'.
                            $delivery
.'
                            <hr class="col-sm-8 center">
                            <!--Total Price -->
                            <div class="col-sm-12 " >
                            <div class="quantity panel-footer text-center">
                                <span style="float:left;" class="col-sm-8"><b>Total : </b></span>
                                <span  ng-cloak style="font-size:13px;margin-left:15px;" ><b>{{price}}€</b></span>
                            </div>
                        </div>
                    </div>
                </div><!-- .form-group -->
            </div>
            <!--i will put my conditions to add the right filter -->
        </div>
    </div><!-- .container -->';
    }
}
