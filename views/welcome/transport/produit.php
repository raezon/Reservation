<?php
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\Plat;
use yii\bootstrap\Progress;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use app\models\Other;
use unclead\multipleinput\MultipleInput;
use kartik\money\MaskMoney;
use app\models\User;
use app\models\Partner;
?>
<?php
//add code to get the current partener_id
$id_user=User::getCurrentUser()->id;
//traying to getting partener id
$partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
$partner_id=$partner->id;
$other_types=Other::find()->where(['partener_id'=>$partner_id,'category_id'=>8,'type'=>1])->all();
$i=0;

        $mealData= [

          ['id' => '1', 'name' => "Bus"],

          ['id' => '2', 'name' => "Mini Bus"],

          ['id' => '3', 'name' => "Coach"],

          ['id'=>  '4' ,'name' => 'Other']

        ];
                  $i=$i+2;
          if(!empty($other_types)){
            foreach ($other_types as $other_type) {
            $i++;
            $mealData[$i]['name']=$other_type->name;
          }
          $i=$i+1;
          $mealData[$i]['name']="Other";
          }
        $mealData=ArrayHelper::map($mealData,'name','name');
        