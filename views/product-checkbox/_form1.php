<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>
                <?php if ($user['id']): ?>
                    Update Option <b><?php //echo $user['name'] ?></b>
                <?php else: ?>
                    Create new Option
                <?php endif ?>
            </h3>
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data"
                  action="">
                  <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

                <div class="form-group">
                    <label>Product name</label>
                    <input name="name" value="<?php echo $user['name'] ?>"
                           class="form-control <?php echo $errors['name'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['name'] ?>
                    </div>
                </div>
               
                <?php
                 if (array_key_exists("vegan",$user))
                  {
                    ?>
                   
                <div class="form-group">

                    <label class="col-lg-2">Food :</label>
<!--Vegan-->                   
                    <label>Vegan</label><input type="checkbox"  checked="checked" name="vegan"  value="vegan" />
                    
<!--Vegetarian--> 
                    <label>Vegetarian</label><input type="checkbox"  checked="checked" name="Vegetarian"  value="Vegetarian" />
                    
<!--Gluten_free--> 
                    <label>Organic</label><input type="checkbox" checked="checked" name="Gluten_free"  value="Gluten_free" />
                    
<!--Halal--> 
                    <label>Halal</label><input type="checkbox"  checked="checked" name="Halal"  value="Halal" />
                    
<!--Cacher--> 
                    <label>cacher</label><input type="checkbox"  checked="checked" name="Cacher"  value="Cacher" />
<!--Without_porc--> 
                    <label>Without_porc</label><input type="checkbox"  checked="checked" name="Without_porc"  value="Without_porcr" />
                    
                    

                    <div class="invalid-feedback">
                        <?php //echo  $errors['email'] ?>
                    </div>
                </div>
                    
                    <?php
                  }else{?>
                    <label class="col-lg-2">food:</label>
<!--Vegan-->                   
                    <label>Vegan</label><input type="checkbox"  checked="checked" name="vegan"  value="vegan" />
                    
<!--Vegetarian--> 
                    <label>Vegetarian</label><input type="checkbox"  checked="checked" name="Vegetarian"  value="Vegetarian" />
                    
<!--Gluten_free--> 
                    <label>Organic</label><input type="checkbox" checked="checked" name="Gluten_free"  value="Gluten_free" />
                    
<!--Halal--> 
                    <label>Halal</label><input type="checkbox"  checked="checked" name="Halal"  value="Halal" />
                    
<!--Cacher--> 
                    <label>cacher</label><input type="checkbox"  checked="checked" name="Cacher"  value="Cacher" />
<!--Without_porc--> 
                    <label>Without_porc</label><input type="checkbox"  checked="checked" name="Without_porc"  value="Without_porcr" />
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
