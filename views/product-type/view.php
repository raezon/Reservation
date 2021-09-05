<?php
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
    include "partials/not_found.php";
    exit;
}
$userId = $_GET['id'];

$user = getUserById($userId);
if (!$user) {
    include "partials/not_found.php";
    exit;
}

?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View Product Prices day/night: <b><?php// echo $user['name'] ?></b></h3>
        </div>
        <div class="card-body">
            <a class="btn btn-secondary" href="update.php?id=<?php echo $user['id'] ?>">Update</a>
            <form style="display: inline-block" method="POST" action="delete.php">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
        </td>
                <td></td>
                <td></td>
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
            <tr>
                <?php 
                $collection_category_meal="";
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
            </tr>

            </tbody>
        </table>
    </div>
</div>

