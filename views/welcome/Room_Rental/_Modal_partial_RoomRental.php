<?php use yii\bootstrap\Modal;
//modal starting
      Modal::begin([
              'header' => '<h4>Other</h4>',
              'id'     => 'modal',
              'size'   => 'modal-lg'
          ]);?>
      
      <div class="form-group">
        <label class="sr-only" for="email">New Option:</label>
        <input type="email" class="form-control"  placeholder="Enter your new value"  name="email">
       </div>
      <input type="hidden" name="" id="category_id" value="<?php echo Yii::$app->request->get('category_id', 0);?>">
       <input type="hidden" name="" class="input-lg input-group-lg" id="step_id" value="<?php echo Yii::$app->request->get('id', 0);?>">
     </br>
       <button type="submit" class="btn btn-success" id="save_other">Save</button>
      </div>
<!--button de validation-->
<?php Modal::end();  ?>