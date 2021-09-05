<?php

use yii\bootstrap\Progress;
use yii\bootstrap\Modal;

?>

<div class="row">
    <div class="col-md-3">
        <h4>General Information</h4>
    </div>
    <div class="col-md-3">
        <h4>Availability and Displacement</h4>
    </div>
    <div class="col-md-2">
        <h4 style="color:green;font-size:12;"><b>Service and Prices</b></h4>
    </div>
    <div class="col-md-1">
        <h4>Conditions</h4>
    </div>
    <div class="col-md-2">
        <h4>Payments</h4>
    </div>
    <div class="col-md-1">
        <h4>Messages</h4>
    </div>
</div>
<?php
echo Progress::widget([
    'percent' => 60,
    'barOptions' => ['class' => 'progress-bar-success'],
    'options' => ['class' => 'active progress-striped']
]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h4><?= $this->title ?></h4>
        </div>
        </br>
        <div>
            <div class="col-md-12">
                <div class="pull-left col-md-12">

                </div>
            </div>
     
  