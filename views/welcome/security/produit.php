<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$Produit = [

  ['id' => '1', 'name' => "Seminar"],

  ['id' => '2', 'name' => htmlentities("Party\Evening")],

  ['id' => '3', 'name' => htmlentities("Bar\Restaurant")]

];
$mealData = ArrayHelper::map($Produit, 'name', 'name');
$Temperature = [

  ['id' => '1', 'name' => "Security agent"],

  ['id' => '2', 'name' => "Dog trainer"],

  ['id' => '3', 'name' => "Watchman"],

  ['id' => '4', 'name' => "Home Agent"],

  ['id' => '5', 'name' => 'Event agent']

];
$temperatureData = ArrayHelper::map($Temperature, 'name', 'name');
