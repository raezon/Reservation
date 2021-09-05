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
class Map extends \yii\bootstrap\Widget
{
    public $map;
    public $latitude;
    public $longitude;
    public $latitudeFrom;
    public $longitudeFrom;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
        //get session address and convert it to lang and lat


        //creation of the table corresponding for the extra
        $style = ' #map
                   {
                        height: 400px;
                        /* The height is 400 pixels */
                        width: 100%;
                        /* The width is the width of the web page */
                    }';
        $script = '
            //the maps api is setup above
            window.onload = function() {

                var lat = ' .  json_encode($this->longitude) . '
                var lng = ' .  json_encode($this->latitude) . '
                var lng2 = ' .  json_encode($this->latitudeFrom) . '
                var lat2 = ' .  json_encode($this->longitudeFrom) . '

                var latlng=[];
                var map;
                var marker=[]
                var element
                for(var i=0;i<2;i++){
                    if((lat==lat2) &&(lng2==lng)){
                        var element1= new google.maps.LatLng(lat, lng);
                        latlng.push(element1)
                    }else{
                        
                        if(i==0){
                            var element1= new google.maps.LatLng(lat, lng);
                            latlng.push(element1)
                        }
                        if(i==1){
                            var element2= new google.maps.LatLng(lat2, lng2);
                            latlng.push(element2)
                        }
                    }

                    
                }
                
                var map = new google.maps.Map(document.getElementById("map"), {

                    center: latlng[1],

                    zoom: 11, //The zoom value for map

                    mapTypeId: google.maps.MapTypeId.ROADMAP

                });
                for(var i=0;i<2;i++){
                    var element = new google.maps.Marker({
                        position: latlng[i],
                        map: map,
                        title: "Place the marker for your location!", //The title on hover to display
    
                        draggable: true //this makes it drag and drop
    
                    });
                    marker.push(element)
                }
                var display = new google.maps.DirectionsRenderer();
                var services = new google.maps.DirectionsService();
                display.setMap(map);
                var request ={
                    origin : latlng[0],
                    destination:latlng[1],
                    travelMode: "DRIVING"
                };
                services.route(request,function(result,status){
                    if(status =="OK"){
                        display.setDirections(result);
                    }
                });
              /*  var pathBetween = new google.maps.Polyline({
                    path: [latlng[0],latlng[1]],
                    strokeColor: "#FF00003,
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                  });*/
              
                 


                google.maps.event.addListener(marker, "dragend", function(a) {

                    console.log(a);
                    
                    document.getElementById("loc").value = a.latLng.lat().toFixed(4) + ", " + a.latLng.lng().toFixed(4); //Place the value in input box



                });
                var travel_mode = "en";
                var directionsDisplay = new google.maps.DirectionsRenderer({"draggable": false});
                var directionsService = new google.maps.DirectionsService();
                directionsService.route({
                    origin: latlng[1],
                    destination: latlng[0],
                    travelMode: travel_mode,
                    avoidTolls: true
                }, function (response, status) {
                    if (status === "OK") {
                        directionsDisplay.setMap(map);
                        directionsDisplay.setDirections(response);
                    } else {
                        directionsDisplay.setMap(null);
                        directionsDisplay.setDirections(null);
                        alert("Could not display directions due to: " + status);
                    }
                });

        };
        ';
        return  '
            <style>' .
            $style
            . '
            </style>
            <script>' .
            $script
            . '
            </script>
            <div id="map"></div>
            <!-- Async script executes immediately and must be after any DOM elements used in callback. -->   
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTGpqrJDrULNO0PNch-b8vlmcwwGt7D2c&callback=initMap" async defer></script>
        ';
    }
}
