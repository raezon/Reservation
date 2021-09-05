<?php 
use \yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\PartnerCategory;

/**
 * model: Partner object
 */

$this->title = $model->name;

?>
          <?php 

$model1=PartnerCategory::find()->where(['id'=>$model->partner_category])->one();

              ?>
  <div class="container">  
      
      <section class="pt-5 pb-5" style="min-height:100vh;">
          <div class="container-fluid pt-5 pb-5 position-relative">
              <div class="row">
                  <div class="col-sm-12">
                    <h2><?= $model->name ?></h2>
                    <p><strong>Category:<?=$model1->name?></strong> </p>
                  </div>
              </div>
    
              <div class="row">
                  <div class="col-sm-4">
                      <div class="image-responsive">
                         
                      </div>
                  </div>
                  <div class="col-sm-8">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'price',
        'quantity'
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>                      
                  </div>
              </div><!-- .row -->

          </div>
      </section>
  </div>