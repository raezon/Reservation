<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>
                <?php if ($user['id']): ?>
                    Update Type  <b><?php //echo $user['name'] ?></b>
                <?php else: ?>
                    Create new Type
                <?php endif ?>
            </h3>
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data"
                  action="">
                  <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

                <div class="form-group">
                    <label>Price_day</label>
                    <input name="price_day" value="<?php echo $user['price_day'] ?>"
                           class="form-control <?php echo $errors['price_day'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['price_day'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Price_night</label>
                    <input name="price_night" value="<?php echo $user['price_night'] ?>"
                           class="form-control  <?php echo $errors['price_night'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php //echo  $errors['email'] ?>
                    </div>
                </div>
                <?php
                 if (array_key_exists("arabic",$user))
                  {
                    ?>
                   
                <div class="form-group">

                    <label class="col-lg-2">Spoken Languages:</label>
<!--Arabic-->                   
                    <label>Arabic</label><input type="checkbox"  checked="checked" name="arabic"  value="arabic" />
                    
<!--Frensh--> 
                    <label>Frensh</label><input type="checkbox"  checked="checked" name="french"  value="french" />
                    
<!--English--> 
                    <label>English</label><input type="checkbox" checked="checked" name="english"  value="english" />
                    
<!--Deutsh--> 
                    <label>Deutsh</label><input type="checkbox"  checked="checked" name="deutsh"  value="deutsh" />
                    
<!--Japenesse--> 
                    <label>Japenesse</label><input type="checkbox"  checked="checked" name="japenesse"  value="japenesse" />
                    

                    <div class="invalid-feedback">
                        <?php //echo  $errors['email'] ?>
                    </div>
                </div>
                    
                    <?php
                  }else{?>
                      <label class="col-lg-2">Spoken Languages:</label>
<!--Arabic-->                   
                    <label>Arabic</label><input type="checkbox"  checked="checked" name="arabic"  value="arabic" />
<!--Frensh--> 
                    <label>Frensh</label><input type="checkbox"  checked="checked" name="french"  value="french" />
                    
<!--English--> 
                    <label>English</label><input type="checkbox" checked="checked" name="english"  value="english" />
                    
<!--Deutsh--> 
                    <label>Deutsh</label><input type="checkbox"  checked="checked" name="deutsh"  value="deutsh" />
                    
<!--Japenesse--> 
                    <label>Japenesse</label><input type="checkbox"  checked="checked" name="japenesse"  value="japenesse" />
                    
                    <div class="invalid-feedback">
                        <?php //echo  $errors['email'] ?>
                    </div>
                    <?php 
                  }
    
                 ?>
                                <div class="form-group">
                    <label>Name</label>
                    <input name="id" value="<?php echo $user['id'] ?>"
                           class="form-control <?php echo $errors['id'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php //echo  $errors['name'] ?>
                    </div>
                </div>

                <button class="btn btn-success ">Submit</button>
            </form>
        </div>
    </div>
</div>
