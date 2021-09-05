<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductHistoriqueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Product Extra');
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
require 'users/users.php';

$users = getUsers();



?>


<div class="container">
   

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;$j=2;$k=0;?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php
                    if (array_key_exists("Description",$user[$i]))
                         
                    if($user[$i]['Description']=="")
                         echo "empty";
                    else
                        echo $user[$i]['Description'] ;
                    
                 ?></td>
                <td><?php
                    if (array_key_exists("Price",$user[$i]))
                     echo $user[$i]['Price'] 
                 ?></td>
                <td><?php 
                    if (array_key_exists("Quantity",$user[$i]))
                    echo $user[$i]['Quantity'] ;
              
             
            ?></td>

               
                <td>
                    <a href="?r=product-extra/view&id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                    <a href="?r=product-extra/update&id=<?php echo $user['id'] ?>"
                       class="btn btn-sm btn-outline-secondary">Update</a>
                    <a  href="?r=product-extra/delet&id=<?php echo $user['id'] ?>">
                        <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </a>
                </td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>



