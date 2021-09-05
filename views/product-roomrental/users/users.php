<?php
/**
 * User: TheCodeholic
 * Date: 3/19/2019
 * Time: 9:27 AM
 * enhanced by User:Amar
 * Date: 01/04/2020
 * Time : 17:14
 */
//so i will use the model of product to get the string of spoken languages that will be rendered to a json array with the commande json_decode
//first include your model that will be used
use app\models\ProductType;
use app\models\ProductOption;
use app\models\Product;
use app\models\Partner;
use app\models\User;
function getUsers()
{
    //$model=ProductOption::find()->all();
    
    $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
    $model =  Product::find()->where(['partner_id'=>$partner->id])->all();
    $id_array=array();
    $model_value=array();
    $product_name_array=array();
    
   
    foreach ($model as $value) {
        if($value->product_type_id!=null)
         {
            $id_array[]=$value->product_type_id;
            $product_name_array[]=$value->name;
            
         } 
    }
   
       if(empty($product_name_array)){
        $product_name_array[]="vide";
    }
     $model1 = ProductType::find()
         ->where(['id'=>$id_array])
        ->all();
    //that array will contain all the value of my specified field  on json format
    $j=0;
    foreach ($model1 as $value) {
          //  if()
             $model_value[$j]=json_decode($value->nom,true);
            $model_value[$j]['nom']=$product_name_array[$j];
            $model_value[$j]['id']=$value->id;
           
             
            
            $j++;    
            
    }
   
      return $model_value;
}

function getUserById($id)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

function createUser($data)
{
    $users = getUsers();

    $data['id'] = rand(1000000, 2000000);

    $users[] = $data;

    putJson($users);

    return $data;
}

function updateUser($data, $id)
{
   
    $updateUser = [];
    $users = getUsers();
    $array_type_room_rental=array();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            //here we don an update on our model to change the name of our records
            $model=ProductType::find()->andwhere(['id'=>$data['id']])->one();
                
             if ($model->load(Yii::$app->request->post())) {
              $array_type_room_rental["area"]=$model->area;
              $array_type_room_rental["caution"]=$model->caution;
              $array_type_room_rental["event_cake"]=$model->event_cake;
              $array_type_room_rental["drink"]=$model->drink;
              $array_type_room_rental["External_food"]=$model->External_food;
              $array_type_room_rental["External_Catering"]=$model->External_Catering;
              $array_type_room_rental["Internal_Catering"]=$model->Internal_Catering;
              $array_type_room_rental["Without_guarantee"]=$model->Without_guarantee;
              $array_type_room_rental["Minimum_consumption_Price"]=$model->Minimum_consumption_Price;

              $array_type_room_rental["Wifi"]=$model->wifi;
              $array_type_room_rental["Board"]=$model->Board;
              $array_type_room_rental["System_Sound"]=$model->System_Sound;
              $array_type_room_rental["Micro"]=$model->Micro;
              $array_type_room_rental["To_bring_back_cake_of_the_event"]=$model->To_bring_back_cake_of_the_event;
              $array_type_room_rental["To_bring_back_drinks"]=$produit_l_To_bring_back_drinks;
              $array_type_room_rental["Parking_lot"]["name"]=$model->Parking_lot;
              $array_type_room_rental["Parking_lot"]["field"]=$model->Parking_lot_field;
              $array_type_room_rental["Subway"]["name"]=$model->Subway;
              $array_type_room_rental["Subway"]["field"]=$model->Subway_field;
              $array_type_room_rental["Train"]["name"]=$model->Train;
              $array_type_room_rental["Train"]["field"]=$model->Train_field;
              $array_type_room_rental["Bus"]["name"]==$model->Bus;
              $array_type_room_rental["Bus"]["name"]=$model->Bus_field;
              $array_type_room_rental_compressed=json_encode($array_type_room_rental);
           
            $model->nom=json_encode($array_type_room_rental_compressed);
             if($model->update()){
                //echo "sucess";
            }else{
               // echo "erreur sauvgarder dans le model productOption";
            }

        }
           
            $users[$i] = $updateUser = array_merge($user, $data2);
        }
    }
    putJson($users);

    return $updateUser;
}

function deleteUser($id)
{
    $users = getUsers();

    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            array_splice($users, $i, 1);
        }
    }

    putJson($users);
}

function uploadImage($file, $user)
{
    if (isset($_FILES['picture']) && $_FILES['picture']['name']) {
        if (!is_dir(__DIR__ . "/images")) {
            mkdir(__DIR__ . "/images");
        }
        // Get the file extension from the filename
        $fileName = $file['name'];
        // Search for the dot in the filename
        $dotPosition = strpos($fileName, '.');
        // Take the substring from the dot position till the end of the string
        $extension = substr($fileName, $dotPosition + 1);

        move_uploaded_file($file['tmp_name'], __DIR__ . "/images/${user['id']}.$extension");

        $user['extension'] = $extension;
        updateUser($user, $user['id']);
    }
}

function putJson($users)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}

function validateUser($user, &$errors)
{
    $isValid = true;
    // Start of validation
  /*  if (!$user['name']) {
        $isValid = false;
        $errors['name'] = 'Name is mandatory';
    }
    if (!$user['username'] || strlen($user['username']) < 6 || strlen($user['username']) > 16) {
        $isValid = false;
        $errors['username'] = 'Username is required and it must be more than 6 and less then 16 character';
    }
    if ($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'This must be a valid email address';
    }

    if (!filter_var($user['phone'], FILTER_VALIDATE_INT)) {
        $isValid = false;
        $errors['phone'] = 'This must be a valid phone number';
    }*/
    // End Of validation

    return $isValid;
}
