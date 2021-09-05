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
class Room extends \yii\bootstrap\Widget
{
    public $roomRental;
    public $categories;
    public function init()
    {
        parent::init();
    }

    public function constructExtraTransport($transport_extra, $Transportation_name)
    {
        $index1 = -1;
        $table_rows = '';
        // print_r($mealPlan);
        foreach ($transport_extra as $transport_extra) {
            $index1++;

            $table_rows .= '        
                                <tr style="background-color:#eeeeee;">
                                   <td style="background-color:#eeeeee;"> 
                                        <div class="custom-control custom-checkbox">
                                    
                                       
                                        
                                                ' . $transport_extra[$Transportation_name] . '
                                        </div>
                                    </td>   
                                </tr>';
        }
        return $table_rows;
    }
    public function constructExtraTransportSpan($transport_extra_span, $name)
    {

        $table_rows_type = "";
        $index1 = 100;
        $index = 0;

        //echo json_encode($meals, JSON_PRETTY_PRINT);
        foreach ($transport_extra_span as $transport_extra_span) {
            $index1++;

            $table_rows_type .= '
                         
                                <tr style="background-color:#eeeeee;">
                                   <td style="background-color:#eeeeee;"> 
                                        <div class="custom-control custom-checkbox">
                                    
                                              
                                                ' . $transport_extra_span[$name] . '
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

        $qte = "";
        $caution = "";
        $area = "";
        $RoomRental = json_decode($this->roomRental, true);
        $accept = "";
        $facilities = "";
        $transport = "";

        $extraAccept="";
        $extraFacilities="";
        $extraAcceptText="";
        $extraFacilitiesText="";
        $extra_span_accept = "";
        $extra_span_facilities = "";
        $extra_span_transport = "";
        //Extras

        $indexExtraTransport = 0;

        if ($this->categories == 1) {
            if ($RoomRental[0]["event_cake"]) {
                $accept .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/accept/cake.png' width='50px' height='50px'/></div>";
                $extra_span_accept .= "<div class='grid-item1'><span style='margin-left:-3px;font-size:11px'><b>Personal Event cake</b></span></div>";
            }
            if ($RoomRental[0]["drink"]) {
                $accept .= "<div class='grid-item1'><img class='center'  src='img/logos_detail/Room_rental/accept/drink.png' width='70px' height='55px'/></div>";
                $extra_span_accept .= "<div class='grid-item1'><span style='margin-left:15px;font-size:11px'><b>External Drink</b></span></div>";
            }
            if ($RoomRental[0]["External_food"]) {
                $accept .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/accept/deliver-food.png' width='50px' height='50px'/></div>";
                $extra_span_accept .= "<div class='grid-item1'><span style='margin-left:8px;font-size:11px'><b>External Food</b></span></div>";
            }
            if ($RoomRental[0]["External_Catering"]) {
                $accept .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/accept/delivery-scooter.png' width='50px' height='50px'/></div>";
                $extra_span_accept .= "<div class='grid-item1'><span style='margin-left:5px;font-size:11px'><b>External Catering</b></span></div>";
            }


            //Facilities
            if ($RoomRental[0]["Wifi"]) {
                $facilities .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/facilties/wifi.png' width='50px' height='50px'/></div>";
                $extra_span_facilities .= "<div class='grid-item1'><span style='margin-left:30px;font-size:11px'><b>Wifi</b></span></div>";
            }
            if ($RoomRental[0]["Board"]) {
                $facilities .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/facilties/board.png' width='70px' height='55px'/></div>";
                $extra_span_facilities .= "<div class='grid-item1'><span style='margin-left:35px;font-size:11px'><b>Board</b></span></div>";
            }
            if ($RoomRental[0]["System_Sound"]) {
                $facilities .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/facilties/voice.png' width='50px' height='50px'/></div>";
                $extra_span_facilities .= "<div class='grid-item1'><span style='margin-left:10px;font-size:11px'><b>System Sound</b></span></div>";
            }
            if ($RoomRental[0]["Video_projector"]) {
                $facilities .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/facilties/video.png' width='50px' height='50px'/></div>";
                $extra_span_facilities .= "<div class='grid-item1'><span style='margin-left:10px;font-size:11px'><b>Video Projector</b></span></div>";
            }
            if ($RoomRental[0]["Micro"]) {
                $facilities .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/facilties/micro.png' width='50px' height='50px'/></div>";
                $extra_span_facilities .= "<div class='grid-item1'><span style='margin-left:35px;font-size:11px'><b>Micro</b></span></div>";
            }
            if ($RoomRental[0]["Internal_Catering"]) {
                $facilities .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/facilties/internal_catering.png' width='50px' height='50px'/></div>";
                $extra_span_facilities .= "<div class='grid-item1'><span style='margin-left:8px;font-size:11px'><b>Internal Catering</b></span></div>";
            }
            //Transport
            if ($RoomRental[0]["Bus"]["name"]) {
                $transport .= "<div class='grid-item' id='RouteTransportLogo' ><img src='img/logos_detail/Room_rental/transport/bus.png' width='50px' height='50px'/></div>";
                $transport .= "<div class='grid-item3' id='RouteTransport' ><span style='margin-left:13px;font-size:15px'><b>Bus</b> : " . $RoomRental[0]["Bus"]["field"] . "</div>";
            }
            if ($RoomRental[0]["Train"]["name"]) {
                $transport .= "<div class='grid-item' id='RouteTransportLogo'><img  src='img/logos_detail/Room_rental/transport/train.png' width='70px' height='55px'/></div>";
                $transport .= "<div class='grid-item3' id='RouteTransport'><span style='margin-left:13px;font-size:15px'><b>Train</b></span> : " . $RoomRental[0]["Train"]["field"] . "</div>";
            }
            if ($RoomRental[0]["Parking_lot"]["name"]) {
                $transport .= "<div class='grid-item' id='RouteTransportLogo'><img  src='img/logos_detail/Room_rental/transport/parking.png' width='70px' height='55px'/></div>";
                $transport .= "<div class='grid-item3' id='RouteTransport'><span style='margin-left:13px;font-size:15px'><b>Parking</b></span> : " . $RoomRental[0]["Parking_lot"]["field"] . "</div>";
            }
            if ($RoomRental[0]["Subway"]["name"]) {
                $transport .= "<div class='grid-item' id='RouteTransportLogo'><img  src='img/logos_detail/Room_rental/transport/subway.png' width='70px' height='55px'/></div>";
                $transport .= "<div class='grid-item3' id='RouteTransport'><span style='margin-left:13px;font-size:15px'><b>Subway</b> : " . $RoomRental[0]["Subway"]["field"] . "</div>";
            }
            //Transport Extra
            for ($i = 0; $i < 8; $i++) {

                if ($RoomRental[0][$i]['services_transport']['Transportation_name'] != '') {
                    $transport .= "<div class='grid-item' id='RouteTransportLogo'><img  src='img/logos_detail/Room_rental/transport/other.png' width='70px' height='55px'/></div>";
                    $transport .= "<div class='grid-item3' id='RouteTransport'><span style='margin-left:13px;font-size:15px'><b>" . $RoomRental[0][$i]['services_transport']['Transportation_name'] . "</b></span> : " .  $RoomRental[0][$i]['services_transport']['route number'] . "</div>";
                }
            }

            $extraAccept="";
            $extraFacilities="";
            //Accept Extra
            for ($i = 0; $i < 8; $i++) {
                
                if ($RoomRental[0][$i]['services_possiblity']['Possibility_check_name'] != '') {
                    $extraAccept .= "<div class='grid-item' ><img class='center' src='img/logos_detail/Room_rental/accept/otheraccept.png' width='50px' height='50px'/></div>";
                    $extraAcceptText .= "<div class='grid-item' style='text-align:center'><span style='font-size:11px'><b>".$RoomRental[0][$i]['services_possiblity']['Possibility_check_name']."</b></span></div>";
                   
                }
            }
            //Facilities Extra
            for ($i = 0; $i < 8; $i++) {

                if ($RoomRental[0][$i]['services_facilities']['name'] != '') {
                    $extraFacilities .= "<div class='grid-item1'><img class='center' src='img/logos_detail/Room_rental/facilties/otherfacilities.png' width='50px' height='50px'/></div>";
                    $extraFacilitiesText .= "<div class='grid-item1' style='text-align:center'><span style='font-size:11px'><b>".$RoomRental[0][$i]['services_facilities']['name']."</b></span></div>";
                   
                }
            }

            
            


           
             
            if ($accept)
                echo   '
<!--Accept-->
        <div class="card" style="background-color:#ffffff;;border-radius:0px;margin-left:170px;margin-top:40px;width:75%;">
            <div class="card-header text-center headerColor bg-gray" >
                    <b >The place accepts</b>
            </div>
            <div class="card-body">
                <div class="grid-container" style="margin-top:10px;">
                        ' . $accept . '
                </div>
                <div class="grid-container">
                        
                        
                ' . $extra_span_accept . '
                </div>
                <div class="grid-container" style="margin-top:10px;">
                ' . $extraAccept . '
                </div>
                <div class="grid-container">
                        
                        
                ' . $extraAcceptText . '
                </div>
            </div>
        </div>';
        
            if ($facilities)
                echo '<!--Facilities--->
        <div class="card" style="background-color:#ffffff;;border-radius:0px;margin-left:170px;margin-top:40px;width:75%;">
            <div class="card-header text-center headerColor bg-gray">
                   <b> Available on site</b>
            </div>
            <div class="card-body">
                <div class="grid-container" style="margin-top:10px;">
                                    
                    ' . $facilities . '
                </div>
                <div class="grid-container">
                    
                        
                ' . $extra_span_facilities . '
                </div>
                <div class="grid-container" style="margin-top:10px;">
                                    
                ' . $extraFacilities . '
                </div>
                <div class="grid-container">
                    
                        
                ' . $extraFacilitiesText . '
                </div>
            </div>
        </div>  ';
            if ($transport)
                echo '
<!--Transport-->
        <div class="card" style="background-color:#ffffff;;border-radius:0px;margin-left:170px;margin-top:40px;width:75%;">
        <div class="card-header text-center headerColor bg-gray">
               <b> Transports  & accessibility</b>
        </div>
        <div class="card-body">
            <div class="grid-container" >
                                    
            ' . $transport . '

                
                
            ' . $extra_span_transport . '
            </div>
        </div>
        </div>
                ';
        }
    }
};
