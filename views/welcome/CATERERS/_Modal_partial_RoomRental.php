<?php
 use yii\bootstrap\Modal;
 use app\models\User;
use app\models\Partner;
     

        
         // use a partial vue
      Modal::begin([
              'header' => '<h4>Other type</h4>',
              'id'     => 'modal2',
              'size'   => 'modal-lg'
          ]);
      ?>


      <div class="form-group">
        <label class="sr-only" for="email">New Type:</label>
        <input type="text" class="form-control"  placeholder="Enter your new value"  name="email" id="other_type">
       </div>
      <input type="hidden" name="" id="category_id" value="3">
       <input type="hidden" name="" class="input-lg input-group-lg" id="step_id" value="<?php echo Yii::$app->request->get('id', 0);?>">
       <input type="hidden" name="" class="input-lg input-group-lg" id="partner_id" value="<?php echo $partner_id;?>">
     </br>
       <button type="submit" class="btn btn-success" id="save_other_type">Save</button>
      </div>
<!--button de validation-->

      <?php

          Modal::end();

      ?>