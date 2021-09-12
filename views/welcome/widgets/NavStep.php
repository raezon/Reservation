<?php

namespace app\views\welcome\widgets;

use yii\helpers\Html;
use yii\bootstrap\Progress;
use yii\web\AssetBundle;
use borales\extensions\phoneInput\PhoneInput;
use yii\widgets\ActiveForm;
use Yii;
use app\assets\AppAsset;
use yii\web\Controller;
use yii\web\Application;

class NavStep extends \yii\web\Controller
{
    public $scriptJS;
    public  function __construct($step)
    {
        //      $this->scriptJS = array(Yii::$app->request->baseUrl . "/libs/myjs/myjs.js");
        $jsDynamiqueColorForTitleDependingOnStep = "
        $( document ).ready(function() {
            $('#" . $step . "').css('color','green');
            $('#" . $step . "').css('font-size','12');
            $('#" . $step . "').css('font-weight','bold');
            });
      ";
        $css = "<style>
                    .required:before {
                        font-size: 15px;
                        content: ' * ';
                        color: red;
                    }
               </style>";
        $this->getView()->registerCss($css);
        $this->getView()->registerJs($jsDynamiqueColorForTitleDependingOnStep);
    }
    public  function displayNav()
    {
        echo '<div class="row" id="Parent">
                    <div class="col-sm-3">
                        <h4 id="step1" >Informations générales</h4>
                    </div>
                    <div class="col-md-3">
                        <h4 id="step2">Address</h4>
                    </div>
                    <div class="col-md-2">
                        <h4 id="step3">Service et prix</h4>
                    </div>
                    <div class="col-md-2">
                        <h4 id="step4">Conditions</h4>
                    </div>
                    <div class="col-md-2">
                        <h4 id="step6">Messages</h4>
                    </div>
                </div>';
    }
    public  function displayProgress($currentProgress)
    {

        echo Progress::widget([
            'percent' => $currentProgress,
            'barOptions' => ['class' => 'progress-bar-success'],
            'options' => ['class' => 'active progress-striped']
        ]);
    }
}
