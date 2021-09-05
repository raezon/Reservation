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
            <h3>View Product RoomRental: <b></b></h3>
        </div>
        <div class="card-body">
            <a class="btn btn-secondary" href="?r=product-roomrental/update&id=<?php echo $user['id'] ?>">Update</a>
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
             <th>ID</th>
            <th>area</th>
            <th>caution</th>
            <th>Information</th>
            <th>Facilities</th>
            <th>Possibilities : Check</th>
            <th>Transport</th>
            <th>Actions</th>
        </tr>
        </thead>
            <tbody>
            <tr>
                               <?php
                if(is_array($user)){
                  if (is_array($user)) {
                 $Caters="";
            $area=0;
            $caution=0;
            $Rental_information=" ";
            $Minimal="";
            //this variable is form some chebox in the room rental in the section Information
            $Facilities="";
      if (array_key_exists("area",$user))
                  {

                     $area.=$user['area'].'</br>';
                  }
      if (array_key_exists("option_of_meal",$user))
                  {
                     $caution.=$user['option_of_meal'].'</br>';
                  }
       if (array_key_exists("option_of_meal",$user))
                  {
                     $minimal.=$user['Minimum_consumption_Price'].'</br>';
                  }

      if (array_key_exists("event_cake",$user))
                  {
                    if($user['event_cake']!=0)
                     $Rental_information.=$user['event_cake'].'  </br>';
                  }
      if (array_key_exists("drink",$user))
                  {
                     $Rental_information.=$user["drink"]."<br>";
                  }
      if (array_key_exists("External_food",$user))
                  {
                     $Rental_information.=$user['External_food'].'</br>';
                  }
      if (array_key_exists("External_Catering",$user))
                  {
                     $Rental_information.=$user['External_Catering'].'</br>';
                  }
      if (array_key_exists("Internal_Catering",$user))
                  {
                     $Rental_information.=$user['Internal_Catering'].'</br>';
                  }
      if (array_key_exists("Without_guarantee",$user))
                  {
                     $Rental_information.=$user['Without_guarantee'].'</br>';
                  }
////////////////////////////////////////////////////////////////////////////////////
                        $Facilities="";

      if (array_key_exists(" Wifi",$user))
                  {

                     $Facilities.=$user['Wifi'].'</br>';
                  }
      if (array_key_exists("Board",$user))
                  {
                      $Facilities.=$user['Board'].'</br>';
                  }
      if (array_key_exists("event_cake",$user))
                  {
                    if($user['event_cake']!=0)
                      $Facilities.=$user['event_cake'].'</br>';
                  }
      if (array_key_exists("System_Sound",$user))
                  {
                      $Facilities.=$user['System_Sound'].'</br>';
                  }
      if (array_key_exists("Micro",$user))
                  {
                     $Facilities.=$user['Micro'].'</br>';
                  }
      if (array_key_exists("Video projector",$user))
                  {
                     $Facilities.=$user['Video projector'].'</br>';
                  }
      if (array_key_exists("Internal_Catering",$user))
                  {
                     $Facilities.=$user['Internal_Catering'].'  </br>';
                  }
      if (array_key_exists("Without_guarantee",$user))
                  {
                     $Facilities.=$user['Without_guarantee'].'  </br>';
                  }
      //////////////////////////////////////////////////////////////////////////////
            $Possibilities_check="";
              if (array_key_exists("To_bring_back_cake_of_the_event",$user))
                  {

                     $Possibilities_check.=$user['To_bring_back_cake_of_the_event'].'</br>';
                  }
               if (array_key_exists("To_bring_back_drinks",$user))
                  {

                    $Possibilities_check.=$user['To_bring_back_drinks'].'</br>';
                  }
    ////////////////////////////////////////////////////////////
                  $transport="";
                    if (array_key_exists("parking",$user))
                  {

                     $transport.=$user['parking']["name"].'route'.$user['parking']['field'].'</br>';
                  }
                    if (array_key_exists("Subway",$user))
                  {

                     $transport.=$user['Subway']["name"].'route'.$user['Subway']['field'].'</br>';
                  }
                     if (array_key_exists( "Train",$user))
                  {

                     $transport.=$user[ "Train"]["name"].'route'.$user[ "Train"]['field'].'</br>';
                  }
                     if (array_key_exists( "Bus",$user))
                  {

                     $transport.=$user[ "Bus"]["name"].'route'.$user[ "Bus"]['field'].'</br>';
                  }
                 



 }
 //part for displaying
 ?>
          <td><?php echo $user['id'] ?></td>
          <td><?php echo $area ?></td>
          <td><?php echo $caution ?></td>
          <td><?php echo $Rental_information ?></td>
          <td><?php echo $Facilities ?></td>
          <td><?php echo $Possibilities_check ?></td>
          <td><?php echo $transport ?></td>
<?php
                
                }
                 
                 ?>
                   
                 </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>

