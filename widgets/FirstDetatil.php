<?php

//NameSpace
namespace app\widgets;
//helpers and Yii
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Modal;
#Widgets
use app\widgets\Gallery as WidgetsGallery;
use app\widgets\Map as WidgetsMap;



class FirstDetatil
{

    public static function widgetGallery($count, $model)
    {
        echo WidgetsGallery::widget([
                'count' => $count,
                'images' => $model,
            ]) ;
    }
    public static function widgetMapAndNameOfProduct($partner, $product, $product_parent, $modelmap, $latitude, $longitude, $latFrom, $lngFrom)
    {

        echo "<div class='row' ><h3 style='margin-left:15px'><b>" . $product_parent->name . "</b></h3>";
        if ($product_parent->partner_category == 6 || $product_parent->partner_category == 3) {
            $product_name = json_decode($product->name);
            echo "<h6 style='margin-top: 10px;margin-left:15px'><b> " . $product_name[0] . "</b></h6></div>";
        } else
            echo "<h6 style='margin-top: 10px;margin-left:15px'><b>" . $product->name . "</b></h6></div>";

        //partie Map
        Modal::begin([
            'title' => '<span >Map</span>',
            'toggleButton' => ['label' => '<span><img width="25px" height="25px" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDc3Ljg3NCA0NzcuODc0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0NzcuODc0IDQ3Ny44NzQ7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNNDYwLjgxMiwwYy0yLjY1MS0wLjAwMS01LjI2NiwwLjYxNS03LjYzNywxLjhMMzIzLjg0NCw2Ni40ODNMMTc3LjYsMS40NzZjLTAuMjM5LTAuMTAyLTAuNTEyLTAuMTItMC43NjgtMC4yMjINCgkJCWMtMC42NTgtMC4yNDYtMS4zMzEtMC40NTEtMi4wMTQtMC42MTRjLTAuNjc5LTAuMTgzLTEuMzY5LTAuMzI2LTIuMDY1LTAuNDI3Yy0xLjM4Ni0wLjExNC0yLjc3OS0wLjExNC00LjE2NCwwDQoJCQljLTAuNjk2LDAuMTAxLTEuMzg2LDAuMjQ0LTIuMDY1LDAuNDI3Yy0wLjY4MywwLjE2My0xLjM1NiwwLjM2OC0yLjAxNCwwLjYxNGMtMC4yNTYsMC4xMDItMC41MjksMC4xMTktMC43NjgsMC4yMjJsLTE1My42LDY4LjI2Nw0KCQkJQzMuOTc2LDcyLjQ4MSwwLjAwMyw3OC41OTUsMC4wMDQsODUuMzQxdjM3NS40NjdjMC4wMDMsNS43NzQsMi45MjQsMTEuMTU1LDcuNzY1LDE0LjMwMmM0Ljg0MiwzLjE1MiwxMC45NDksMy42NCwxNi4yMywxLjI5Nw0KCQkJbDE0Ni42NzEtNjUuMTk1bDE0Ni42NzEsNjUuMTk1YzAuMjU2LDAuMTAyLDAuNTI5LDAsMC43ODUsMC4xNTRjNC4xMzIsMS44NDgsOC44NzUsMS43NDIsMTIuOTE5LTAuMjkNCgkJCWMwLjI3My0wLjExOSwwLjU4LDAsMC44NTMtMC4xODhsMTM2LjUzMy02OC4yNjdjNS43ODYtMi44OTEsOS40NDEtOC44MDYsOS40MzgtMTUuMjc1VjE3LjA3NQ0KCQkJQzQ3Ny44NzUsNy42NDksNDcwLjIzNywwLjAwNCw0NjAuODEyLDB6IE0xNTMuNjA0LDM4MS40NDhMMzQuMTM3LDQzNC41NDJWOTYuNDM1TDE1My42MDQsNDMuMzRWMzgxLjQ0OHogTTMwNy4yMDQsNDM0LjU0Mg0KCQkJbC0xMTkuNDY3LTUzLjA5NFY0My4zNGwxMTkuNDY3LDUzLjA5NFY0MzQuNTQyeiBNNDQzLjczNywzODEuOTk0bC0xMDIuNCw1MS4yVjk1Ljg4OGwxMDIuNC01MS4yVjM4MS45OTR6Ii8+DQoJPC9nPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" /><u>voir sur la carte</u><span>'],
            'id' => 'mymodal',
            'options' => [
                'style' => 'span {
                            text-align: center;
                        }'
            ] //in case if you dont want animation, by default class is 'modal fade'
        ]);
        echo WidgetsMap::widget([
            'map' => $modelmap,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'latitudeFrom' => $latFrom,
            'longitudeFrom' => $lngFrom

        ]);
        Modal::end();
        if ($product_parent->partner_category != 1) {

            echo '<span>' . $partner->address   . '</span>';
        } else {
            $address = json_decode($product->languages, true);
            echo  '<span>' . $address['address']   . '</span>';
        }
    }
};
