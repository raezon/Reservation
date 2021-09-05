<?php
//CATERERS
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Progress;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\money\MaskMoney;
use unclead\multipleinput\MultipleInput;

$geoip = new \lysenkobv\GeoIP\GeoIP();
$ip = $geoip->ip(Yii::$app->request->getUserIP()); // current user ip
$currencies = json_decode(file_get_contents('data.json'), true);
foreach ($currencies as $currency) {
  if (strtoupper($currency['country']) == strtoupper($ip->isoCode)) {
    $currencies_symbol = $currency['currency'];
  }
}
if (empty($currencies_symbol))
  $currencies_symbol = "$";
\Yii::$app->params['maskMoneyOptions']['prefix'] =  $currencies_symbol;
//$this->title = 'General Information';
/* @var $this yii\web\View */


?>
<style>
  label[for="productparent-name"]:after {
    font-size: 15px;
    content: " *";
    color: red;
  }

  label[for="productparent-description"]:after {
    font-size: 15px;
    content: " *";
    color: red;

  }

  h3:after {
    font-size: 15px;
    content: " * (at least add one product)";
    color: red;
  }

  input[type="checkbox"] {
    height: 15px;
  }

  .dynamicform_wrapper {
    height: 700px;
  }
</style>
<div class="row">
  <div class="col-sm-3">
    <h4><b>General Information</b></h4>
  </div>
  <div class="col-md-3">
    <h4>Availability and Displacement</h4>
  </div>
  <div class="col-md-2">
    <h4 style="color:green;font-size:12;">Service and Prices</h4>
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
]); ?>

<div class="row">

  <div class="col-md-12">

    <div class="page-header">
      <h4><?= $this->title ?></h4>

    </div>
    <?php $form = ActiveForm::begin([
      'options' => [
        'enctype' => 'multipart/form-data',

      ],
      'id' => 'dynamic-form',
      //'enableAjaxValidation' => true,
      'enableClientValidation' => true,
      'method' => 'post',
      'action' => ['dynamic1/create']
    ]); ?>
    <div class="row">
      <?= $form->field($model3, 'partner_category')->hiddenInput(['value' => 4])->label(false); ?>
      <?php
      echo "<div class='col-md-6'>";
      echo     $form->field($model3, 'name')->textInput(['style' => 'width:500px', 'placeholder' => 'Name under which you want to appear'])->label("Name");
      echo "</div>";
      //
      echo "<div class='col-md-6'>";
  
      echo $form->field($model3, 'description')->textArea([
        'class' => 'form-control ',
        'style' => 'height:35px;',
        'placeholder' => 'Describe your company/Service (specialty, expertise, number of years of experience ... etc) this will attract more customers'
      ])->label('Description');
      echo "</div>";
      //
      echo "<div class='col-md-6 col-sm-offset-0'>";
      echo $form->field($model3, 'picutre[]')->fileInput(['multiple' => true]);
      /*echo FileInput::widget([
	'model' => $model3,
	'attribute' => 'picutre',
	'name' => 'picutre',
	'options' => [
		'multiple' => true,
		'accept' => 'image/*'
	],
	'pluginOptions' => [
		'showCaption' => false,
		'showRemove' => false,
		'showUpload' => false,
		'browseClass' => 'btn btn-primary btn-block',
		'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
		'browseLabel' =>  'Attach Business Card',
		'allowedFileExtensions' => ['jpg','gif','png'],
		'overwriteInitial' => false
	],
]);*/
      echo "</div>";





      ?>

    </div>
    <div>
      <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $ProductsItem[0],
        'formId' => 'dynamic-form',
        'formFields' => [
          'name',
          'price',

        ],
      ]); ?>

      <div class="container-items">
        <!-- widgetContainer -->

        <?php foreach ($ProductsItem as $i => $ProductItem) : ?>

          <div class="item panel panel-default">
            <!-- widgetBody -->
            <div class="panel-heading">

              <h3 class="panel-title pull-left"><b>Products</b></h3>
              <div class="pull-right">
                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="panel-body">
              <?php
              // necessary for update action.
              if (!$ProductItem->isNewRecord) {
                echo Html::activeHiddenInput($ProductItem, "[{$i}]id");
              }
              ?>

              <div class="row">

                <div class="col-sm-12">
                  <h4> Services priced <span style="color:red">by hour</span></h4>
                  <div class="col-sm-3">
                    </br>
                    <div class="col-sm-1"><label for="photo">Photo</label></div>

                    <div class="col-sm-8">
                      <?=
                      $form->field($ProductItem, "[{$i}]photo1")->checkbox(['value' => "photo1", 'uncheckValue' => "vide", "style" => "width:300px;"])
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-4">

                    <?=
                    $form->field($ProductItem, "[{$i}]name")->textInput()->label('Description')
                    ?>
                  </div>
                  <div class="col-sm-5">
                    <?php
                    echo $form->field($ProductItem, "[{$i}]price")->widget(MaskMoney::classname(), [
                      'name' => 'amount_ph_1',
                      'value' => null,
                      'options' => [
                        'placeholder' => 'Enter a valid amount...',

                      ],
                      'pluginOptions' => [
                        'prefix' =>  $currencies_symbol,
                        'suffix' => '',
                        'allowNegative' => false
                      ]
                    ])->label('Price'); ?>
                  </div>


                  <!--Rental periode-->


                </div>


                <div class="col-sm-12">
                  <?php $i = $i + 1; ?>
                  <div class="col-sm-3">
                    </br>
                    <div class="col-sm-1"><label for="photo">Video</label></div>

                    <div class="col-sm-2">
                      <?=
                      $form->field($ProductItem, "[{$i}]video1")->checkbox(['value' => "video1", 'uncheckValue' => "vide", "style" => "width:300px;"])
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-4">

                    <?=
                    $form->field($ProductItem, "[{$i}]name")->textInput()->label('Description')
                    ?>
                  </div>
                  <div class="col-sm-5">
                    <?php
                    echo $form->field($ProductItem, "[{$i}]price")->widget(MaskMoney::classname(), [
                      'name' => 'amount_ph_1',
                      'value' => null,
                      'options' => [
                        'placeholder' => 'Enter a valid amount...',

                      ],
                      'pluginOptions' => [
                        'prefix' =>  $currencies_symbol,
                        'suffix' => '',
                        'allowNegative' => false
                      ]
                    ])->label('Price'); ?>
                  </div>
                </div>
                <div class="col-sm-12">
                  <?php $i = $i + 1; ?>
                  <div class="col-sm-3">
                    </br>
                    <div class="col-sm-1"><label for="photo">Photo and video</label></div>

                    <div class="col-sm-2">
                      <?=
                      $form->field($ProductItem, "[{$i}]photo1andvideo")->checkbox(['value' => "photo1andvideo", 'uncheckValue' => "vide", "style" => "width:300px;"])
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-4">

                    <?=
                    $form->field($ProductItem, "[{$i}]name")->textInput()->label('Description')
                    ?>
                  </div>
                  <div class="col-sm-5">
                    <?php
                    echo $form->field($ProductItem, "[{$i}]price")->widget(MaskMoney::classname(), [
                      'name' => 'amount_ph_1',
                      'value' => null,
                      'options' => [
                        'placeholder' => 'Enter a valid amount...',

                      ],
                      'pluginOptions' => [
                        'prefix' =>  $currencies_symbol,
                        'suffix' => '',
                        'allowNegative' => false
                      ]
                    ])->label('Price'); ?>
                  </div>
                </div>


                <!--Second Part-->
                <div class="col-sm-12">
                  <?php $i = $i + 1; ?>
                  <h4> Services priced <span style="color:red">by half day</span></h4>
                  <div class="col-sm-3">
                    </br>
                    <div class="col-sm-1"><label for="photo">photo</label></div>

                    <div class="col-sm-2">
                      <?=
                      $form->field($ProductItem, "[{$i}]photo2")->checkbox(['value' => "photo2", 'uncheckValue' => "vide", "style" => "width:300px;"])
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-4">

                    <?=
                    $form->field($ProductItem, "[{$i}]name")->textInput()->label('Description')
                    ?>
                  </div>
                  <div class="col-sm-5">
                    <?php
                    echo $form->field($ProductItem, "[{$i}]price")->widget(MaskMoney::classname(), [
                      'name' => 'amount_ph_1',
                      'value' => null,
                      'options' => [
                        'placeholder' => 'Enter a valid amount...',

                      ],
                      'pluginOptions' => [
                        'prefix' =>  $currencies_symbol,
                        'suffix' => '',
                        'allowNegative' => false
                      ]
                    ])->label('Price'); ?>
                  </div>


                  <!--Rental periode-->


                </div>
                <!--price -->


                <!--people number-->

                <!-- .row -->

                <div class="col-sm-12">
                  <?php $i = $i + 1; ?>
                  <div class="col-sm-3">
                    </br>
                    <div class="col-sm-1"><label for="photo">Video</label></div>

                    <div class="col-sm-2">
                      <?=
                      $form->field($ProductItem, "[{$i}]video2")->checkbox(['value' => "video2", 'uncheckValue' => "vide", "style" => "width:300px;"])
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-4">

                    <?=
                    $form->field($ProductItem, "[{$i}]name")->textInput()->label('Description')
                    ?>
                  </div>
                  <div class="col-sm-5">
                    <?php
                    echo $form->field($ProductItem, "[{$i}]price")->widget(MaskMoney::classname(), [
                      'name' => 'amount_ph_1',
                      'value' => null,
                      'options' => [
                        'placeholder' => 'Enter a valid amount...',

                      ],
                      'pluginOptions' => [
                        'prefix' =>  $currencies_symbol,
                        'suffix' => '',
                        'allowNegative' => false
                      ]
                    ])->label('Price'); ?>
                  </div>
                </div>
                <div class="col-sm-12">
                  <?php $i = $i + 1; ?>
                  <div class="col-sm-3">
                    </br>
                    <div class="col-sm-1"><label for="photo">Photo and video</label></div>

                    <div class="col-sm-2">
                      <?=
                      $form->field($ProductItem, "[{$i}]photo2andvideo")->checkbox(['value' => "photo2andvideo", 'uncheckValue' => "vide", "style" => "width:300px;"])
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-4">

                    <?=
                    $form->field($ProductItem, "[{$i}]name")->textInput()->label('Description')
                    ?>
                  </div>
                  <div class="col-sm-5">
                    <?php
                    echo $form->field($ProductItem, "[{$i}]price")->widget(MaskMoney::classname(), [
                      'name' => 'amount_ph_1',
                      'value' => null,
                      'options' => [
                        'placeholder' => 'Enter a valid amount...',

                      ],
                      'pluginOptions' => [
                        'prefix' =>  $currencies_symbol,
                        'suffix' => '',
                        'allowNegative' => false
                      ]
                    ])->label('Price'); ?>
                  </div>
                </div>

              </div>

            </div><!-- .row -->

          </div>
      </div>
      <?php $i = $i + 1; ?>
    <?php endforeach; ?>
    </div>


    <?php DynamicFormWidget::end(); ?>
    <?php
    echo "<div class='col-md-12' >";
    echo $form->field($model3, 'extra')->widget(MultipleInput::className(), [
      'max' => 4,
      'columns' => [
        [
          'name'  => 'Services',
          'title' => 'Name of Services',
          'options' => [
            'class' => 'input-priority'
          ]
        ],
        [
          'name'  => 'Description',
          'title' => 'Description',

          'options' => [
            'class' => 'input-priority'
          ]
        ],
        [
          'name'  => 'Unit',
          'title' => 'Unit of Pricing',
          'type'  => 'dropDownList',
          'defaultValue' => 1,
          'items' =>  [
            31 => 'Priced by hour',
            32 => 'Priced by half day',
          ],
        ],
        [
          'name'  => 'Price',
          'title' => 'Price',
          'type' => MaskMoney::class
        ]
      ]
    ])->label('Add Other Services');
    echo "</div >";
    ?>


  </div>
</div>

<div class="form-group">
  <div class="form-group">
    <div class="pull-right">
      <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-info', 'id' => "id"]) ?>
    </div>
  </div>


  <div class="form-group">
    <div class="pull-left">
      <?= Html::a('back', Url::to(['welcome/step', 'id' => 2, 'category_id' => Yii::$app->request->get('category_id', 0)]), ['class' => 'btn btn-lg btn-primary', 'data-method' => 'POST']) ?>
    </div>
  </div>

  <?php
  $js = '
         var j=0;
                $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
                    j=j+1;
                    
           jQuery(".dynamicform_wrapper .field-ProductItemCamera-0-name").each(function(index) {
           
         $("input ").attr("id", "ProductItemCamera-"+j+"-name"); //direct descendant 
         $
        
    });
        jQuery(".dynamicform_wrapper .field-ProductItemCamera-0-periode").each(function(index) {
           
         $("input ").attr("id", "ProductItemCamera-"+j+"-periode"); //direct descendant 
         $
        
    });
        jQuery(".dynamicform_wrapper .field-ProductItemCamera-0-price-disp").each(function(index) {
           
         $("input ").attr("id", "ProductItemCamera-"+j+"-price-disp"); //direct descendant 
         $
        
    });
    
       jQuery(".dynamicform_wrapper .field-ProductItemCamera-0-picture").each(function(index) {
           
         $("input ").attr("id", "ProductItemCamera-"+j+"-picture"); //direct descendant 
         $
        
    });
        });

        $(".dynamicform_wrapper").on("afterInsert", function(e, item) {

        $(item).find(input[name*="[price]"]").inputmask({
            "alias":"decimal",
            "groupSeparator":".",
            "digits":0,
            "autoGroup":true,
            "removeMaskOnSubmit":true,
            "rightAlign":false
        });
    });

        $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
            if (! confirm("Are you sure you want to delete this item?")) {
                return false;
            }
            return true;
        });

        $(".dynamicform_wrapper").on("afterDelete", function(e) {
            console.log("Deleted item!");
        });

        $(".dynamicform_wrapper").on("limitReached", function(e, item) {
            alert("Limit reached");
        });

        ';
  $this->registerJs($js, \yii\web\View::POS_LOAD);
  ?>

  <?php
  $ts = '
       $( document ).ready(function() {
        
     $("#id").click(function(){
        $("#dynamic-form").attr("action", "index.php?r=welcome%2Fnext&id=3&category_id=4");
      });
  });
     ';
  $this->registerJs($ts); ?>

  <?php ActiveForm::end() ?>