<?php
//CATERERS
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
use yii\bootstrap\Modal;
use yii\bootstrap\Progress;
use unclead\multipleinput\MultipleInput;
use kartik\money\MaskMoney;
use app\models\ProductItem;
use borales\extensions\phoneInput\PhoneInput;
use wbraganca\dynamicform\DynamicFormWidget;
//$this->title = 'General Information';
/* @var $this yii\web\View */

?>
<div class="row">
    <div class="col-sm-3">
        <h4 style="color:green;font-size:12;"><b>General Information</b></h4>
    </div>
    <div class="col-md-3">
        <h4>Availability and Displacement</h4>
    </div>
    <div class="col-md-2">
        <h4>Service and Prices</h4>
    </div>
    <div class="col-md-1">
        <h4>Conditions</h4>
    </div>
    <div class="col-md-1">
        <h4>Payments</h4>
    </div>
    <div class="col-md-2">
        <h4>Messages</h4>
    </div>
</div>
 <?php 
echo Progress::widget([
    'percent' => 60,
    'barOptions' => ['class' => 'progress-bar-success'],
    'options' => ['class' => 'active progress-striped']
]);?>
<div class="row">

    <div class="col-md-12">

    <div class="page-header">
        <h4><?= $this->title ?></h4>

    </div>

  
    <?php $form = ActiveForm::begin([
        'id' => 'partner-registration-form',
//      'enableAjaxValidation' => true,
        'enableClientValidation' => true,
       
    ]);
    // i need to create some model manually as associative array
    ?>

        <div class="row">
        <?= Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0)) ?>
        <?php
        //Discription
        echo "<div class='col-md-6'>";
        echo $form->field($model3 , 'description')->textInput(['style'=>'width:450px','placeholder'=>'Name under which you want to appear']);
        echo "</div>";
        echo "<div class='col-md-6'>";
        echo $form->field($model3 , 'description1')->textInput(['style'=>'width:450px']);
        echo "</div>";
        //1 drop down for the lunch
        $Produit= [

          ['id' => '1', 'name' => 'Breakfast '],

          ['id' => '2', 'name' => 'Lunch/Dinner'],

          ['id' => '3', 'name' => 'Just Lunch'],

          ['id' => '4', 'name' => 'Just Dinner'],

          ['id' => '5', 'name' => 'Cocktails (sweet and savoury) '],

          ['id' => '6', 'name' => 'Salty buffet'],

          ['id' => '7', 'name' => 'Sweet Buffet '],

          ['id' => '8', 'name' => 'Sweet & salty buffet '],

          ['id' => '9', 'name' => 'other '],

        ];
         $Produit_type= [

          ['id' => '1', 'name' => 'French'],

          ['id' => '2', 'name' => 'Italian'],

          ['id' => '3', 'name' => 'Oriental'],

          ['id' => '4', 'name' => 'Méditerranean'],

          ['id' => '5', 'name' => 'American'],

          ['id' => '6', 'name' => 'South american'],

          ['id' => '7', 'name' => 'Asian'],

          ['id' => '8', 'name' => 'Indian'],

          ['id' => '9', 'name' => 'African'],

          ['id' => '10', 'name' => 'East'],

          ['id' => '11', 'name' => 'Wordfood'],

          ['id' => '12', 'name' => 'Other']
        ];

        $listData=ArrayHelper::map($Produit,'id','name');
        //print_r($listData);
        echo "</div>";
        echo "</div>";
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'produit_nom')->dropDownList(
        $listData,
        [   'style' => 'width:450px !important',
            'prompt'=>'Choose your Meal',
            'onchange' => '
                $.post("index.php?r=welcome/lists&id='.'"+$(this).val(), function(data){
                    $("select#servicesandpriceform-produit_option").html(data);
                });'
        ]
        )->label('Name of Meal');
        echo "</div>";
        //Produit_option
        $listData=ArrayHelper::map($Produit_option,'id','name');
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'produit_option')->dropDownList(
        $listData,
        [   'style' => 'width:450px !important',
            'prompt'=>'Choisir votre Meal']
        )->label('Option of Meal');
        echo "</div>";
        //type du produit
        $listData=ArrayHelper::map($Produit_type,'id','name');
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'produit_type')->dropDownList(
        $listData,
        [   'style' => 'width:450px !important',
            'prompt'=>'Choisir type du Meal']
        )->label('Type of Meal');
        echo "</div>";
        

        //nombre
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'nombre_de_persson')->textInput(['style'=>'width:450px','placeholder'=>'For how many people']);
        echo "</div>";
        //price
        echo "<div class='col-md-5'>";
                    echo $form->field($model3, 'prix_day')->widget(MaskMoney::classname(), [
                   'name' => 'amount_ph_1',
            'value' => null,
            'options' => [
                'placeholder' => 'Enter a valid amount...',
                'style'=>'width:300 px'
            ],
            'pluginOptions' => [
                'prefix' => '$',
                'suffix' => '',
                'allowNegative' => false
            ]
        ])->label("Price");
        //night
         echo "</div>";
         echo"<div class='col-md-1'>";
        echo "";
        echo "</div>";
        //quantity
        echo"<div class='col-md-6'>";
        echo $form->field($model3, 'quantite', [
                                'options' => [
                                    'tag' => 'div',
                                    'class' => '',
                                ]
                            ])->textInput([
                                 'type' => 'number',
                                 'style'=>'width:450px'
                            ])->label('Quantity');
        echo "</div>";
        echo"<div class='col-md-1'>";
        echo "";
        echo "</div>";
         echo"<div class='col-md-12'>";
         echo "</br>";
          echo"<div class='col-md-5 col-md-offset-0'>";
          
               echo $form->field($model3, 'min_consomation', [
                                'options' => [
                                    'tag' => 'div',
                                    'class' => '',
                                ]
                            ])->textInput([
                                 'type' => 'number',
                                 'style'=>['width:500px','margin-left:-50px;']
                            ]);
        echo "</div>";
        
        echo"<div class='col-md-6 col-md-offset-1'>";
        echo $form->field($model3, 'imageFile')->fileInput(['style'=>'width:500px']);
        echo "</div>";
         echo "</div>";
           
        

        //food?>
      </div>
        <div>
        <h5><b>Regime  Alimentaire speciale</b></h5>
        <?php

        echo "<div class='col-md-2'>";
        echo $form->field($model3, 'diet' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("vegan");
        echo "</div>";
        echo "<div class='col-md-2'>";
        echo $form->field($model3, 'diet' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("Gluten free");
        echo "</div>";
        echo "<div class='col-md-2'>";
        echo $form->field($model3, 'diet' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("Halal");;
        echo "</div>";
        echo "<div class='col-md-2'>";
        echo $form->field($model3, 'diet' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("Kosher");;
        echo "</div>";
        echo "<div class='col-md-2'>";
        echo $form->field($model3, 'diet' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("Organic");;
        echo "</div>";
        echo "<div class='col-md-2'>";
        echo $form->field($model3, 'diet' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("Without pork ");;
        echo "</div>";
        ?>
        </div>
        <div>
            <h5><b>Included Price</b></h5>
        <?php

        echo "<div class='col-md-4'>";
        echo $form->field($model3, 'diet' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("Price of set up");
        echo "</div>";
        echo "<div class='col-md-4'>";
        echo $form->field($model3, 'diet' ,['options' =>  ['class' => 'checkbox checkbox-success']])->checkbox([] ,false)->label("Price of service");
        echo "</div>";
        
        ?>
        </div>


        <div class="row">
<?php
        //partie option
        echo"<div class='col-md-6'>";
             echo $form->field($model3, 'prix_livraison')->textInput(['style'=>'width:450px']);
        echo "</div>";
         echo"<div class='col-md-6'>";
             echo $form->field($model3, 'adress')->textInput(['style'=>'width:450px']);
        echo "</div>";
        echo"<div class='col-md-6'>";
             echo $form->field($model3, 'prix_serveur')->textInput(['style'=>'width:450px']);
        echo "</div>";
                  echo"<div class='col-md-12' >";
        echo $form->field($model3, 'schedule')->widget(MultipleInput::className(), [
    'max' => 4,
    'columns' => [
        [
            'name'  => 'Description',
            'title' => 'Description',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ],
         [
            'name'  => 'Quantity',
            'title' => 'Quantity',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ],
         [
            'name'  => 'Price',
            'title' => 'Price',
            'enableError' => true,
            'options' => [
                'class' => 'input-priority'
            ]
        ]
    ]
 ])->label('Add Other Services');
        echo"</div >";




?>
</div>
<div class="form-group">
        <div class="pull-right">
            <?=Html::a('Next',Url::to(['welcome/step','id'=>4,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-success','data-method'=>'POST'])?>
        </div>
    </div>
     <div class="form-group">
        <div class="pull-left">
            <?=Html::a('back',Url::to(['welcome/step','id'=>2,'category_id'=>Yii::$app->request->get('category_id', 0)]),['class'=>'btn btn-lg btn-primary','data-method'=>'POST'])?>
        </div>
    </div>

    <?php ActiveForm::end() ?>
            <?php
         // use a partial vue
      Modal::begin([
              'header' => '<h4>Other</h4>',
              'id'     => 'modal',
              'size'   => 'modal-lg'
          ]);?>

      <div class="form-group">
        <label class="sr-only" for="email">New Other:</label>
        <input type="email" class="form-control"  placeholder="Enter your new value" id="other"  name="email">
       </div>
      <input type="hidden" name="" id="category_id" value="<?php echo Yii::$app->request->get('category_id', 0);?>">
       <input type="hidden" name="" class="input-lg input-group-lg" id="step_id" value="<?php echo Yii::$app->request->get('id', 0);?>">
     </br>
       <button type="submit" class="btn btn-success" id="save_other">Save</button>
      </div>
<!--button de validation-->
      <?php

          Modal::end();
      ?>
