<?php 
use \yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\DetailView;

/**
 * model: Partner object
 */

$this->title = $model->name;

?>
  <div class="container">  
      
      <section class="pt-5 pb-5" style="min-height:100vh;">
          <div class="container-fluid pt-5 pb-5 position-relative">
              <div class="row">
                  <div class="col-sm-4">
                    <h2><?= $model->name ?></h2>
                    <p><strong>Category:</strong> <?= $model->category->name ?></p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-4">
                      <div class="image-responsive">
                          <?= Html::img("@web/uploads/".strtolower($model->category->name)."/$model->picture", 
                                  ['class'=>"img-fluid", 'width'=>'auto']) ?>
                      </div>
                  </div>
                  <div class="col-sm-8">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'description:ntext',
        [
            'attribute' => 'address',
            'value' => function($partner) {
                return $partner->address.', '.$partner->postal_code.', '.', '.$partner->city.', '.$partner->country.'.';
            }
        ],
        'tel',
        'keywords',
        'email:email',
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