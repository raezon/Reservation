<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductHistoriqueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Product Option');
$this->params['breadcrumbs'][] = $this->title;
$collection_category_meal="";

?>
<?php
require 'users/users.php';

$users = getUsers();


?>


<div class="container">
    <p>
        <a class="btn btn-success" href="?r=product-languages/create">Create new Price day/night</a>
    </p>

    <table class="table">
        <thead>
        <tr>
            <th>Name of meal</th>
            <th>Type of meal</th>
            <th>option of meal</th>
            <th>Categories of food</th>
            <th>Minimal consomation</th>
            <th>price server</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
               <?php
                if(is_array($user)){
                  /////////////////////////////////
                    if (array_key_exists("name_of_meal",$user))
                       echo '<td>'.$user['name_of_meal'].'</td>';
                    else echo "<td></td>";
                  ///////////////////////////////
                    if (array_key_exists("type_of_meal",$user))
                       echo '<td>'.$user['type_of_meal'].'</td>';
                    else echo "<td></td>";
                  ///////////////////////////////
                    if (array_key_exists("option_of_meal",$user))
                       echo '<td>'.$user['option_of_meal'].'</td>';
                    else echo "<td></td>";
                 /////////////////////////////////
                    if (array_key_exists("minimal_consamtion",$user))
                       echo '<td>'.$user['minimal_consamtion'].'</td>';
                    else echo "<td></td>";
                 /////////////////////////////////
                    if (array_key_exists("price_serveur",$user))
                      if(empty($user['price_serveur']))
                         echo '<td>empty</td>';
                      else
                       echo '<td>'.$user['price_serveur'].'</td>';
                    else echo "<td></td>";
                //////construct an array for meal categories
                    if (array_key_exists("vegan",$user))
                      $collection_category_meal.="vegan"." ";
                    if (array_key_exists("glutenfree",$user))
                       $collection_category_meal.="glutenfree"." ";
                    if (array_key_exists("Halal",$user))
                       $collection_category_meal.="Halal"." ";
                    if (array_key_exists("Kosher",$user))
                       $collection_category_meal.="Kosher"." ";
                    if (array_key_exists("Organic",$user))
                       $collection_category_meal.="Organic"." ";
                    if (array_key_exists("Withoutpork",$user))
                       $collection_category_meal.="Withoutpork"." ";
                }
                 
                 ?>
                   
                 </td>
               
              

                <td>
                    <a href="?r=product-type/view&id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                    <a href="?r=product-type/update&id=<?php echo $user['id'] ?>"
                       class="btn btn-sm btn-outline-secondary">Update</a>
                    <form method="POST" action="delete.php">
                        <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>



