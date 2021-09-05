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
use app\models\Product;
function getUsers()
{
    //$model=ProductOption::find()->all();
    $model = ProductType::find()
         ->where(['!=', 'nom', ' '])
        ->all();
    //that array will contain all the value of my specified field  on json format
    $model_array=array();
    $model_value;
    $i=0;
    foreach ($model as $value) {
            $model_value[$i]=json_decode($value->nom,true);

            $model_value[$i]['id']=$value->id;
            $i++;
       
       
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
    $data2=array();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            //here we don an update on our model to change the name of our records
            $model=ProductOption::find()->andwhere(['id'=>$data['id']])->one();
             if(empty($data['arabic']))
                $data['arabic']='vide';
            if(empty($data['french']))
                $data['french']='vide';
            if(empty($data['english']))
                $data['english']='vide';
            if(empty($data['deutsh']))
                $data['deuts']='vide';
            if(empty($data['japenesse']))
                $data['japenesse']='vide';
            $data2['id']=$data['id'];
            $data2['price_day']=$data['price_day'];
            $data2['price_night']=$data['price_night'];
            $data2['arabic']=$data['arabic'];
            $data2['french']=$data['french'];
            $data2['english']=$data['english'];
            $data2['deutsh']=$data['deutsh'];
            $data2['japenesse']=$data['japenesse']; 
           
            $model->nom=json_encode($data2);
            if($model->update()){
                //echo "sucess";
            }else{
               // echo "erreur sauvgarder dans le model productOption";
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
