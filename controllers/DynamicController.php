<?php

namespace app\controllers;

use Yii;
use app\models\ProductParent;
use app\models\ProductItem;
use app\models\Partner;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\base\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Session;
use yii\db\Expression;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class DynamicController extends Controller
{


    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $count = 0;
        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
        $currencies_symbol = "$";
        $geoip = new \lysenkobv\GeoIP\GeoIP();
        $ip = $geoip->ip(Yii::$app->request->getUserIP()); // current user ip
        $currencies = json_decode(file_get_contents('data.json'), true);
        foreach ($currencies as $currency) {
            if (strtoupper($currency['country']) == strtoupper($ip->isoCode)) {
                $currencies_symbol = $currency['currency'];
            }
        }
        if (empty($currencies_symbol))
            $currencies_symbol = "$";


        $modelCustomer = new ProductParent;
        $modelsAddress = [new ProductItem];
        if ($modelCustomer->load(Yii::$app->request->post())) {


            $modelsAddress = Model::createMultiple(ProductItem::class);
            Model::loadMultiple($modelsAddress, Yii::$app->request->post());
            $category_id = $modelCustomer->partner_category;
            $category_id_s = $modelCustomer->partner_category;
            $modelCustomer->partner_id = $partner->id;

            // validate all models
            $valid = $modelCustomer->validate();
            $valid = Model::validateMultiple($modelsAddress) && $valid;
            //$valid = Model::validateMultiple($modelsAddress) ;

            // if ($valid) {

            $transaction = \Yii::$app->db->beginTransaction();
            try {

                $modelCustomer->extra = json_encode($modelCustomer->extra);
                //$modelCustomer->status="0";
                $modelCustomer->name = $modelCustomer->name;
                $modelCustomer->description = $modelCustomer->description;


                if (!empty($modelCustomer->kind_of_food))
                    $modelCustomer->kind_of_food;
                else
                    $modelCustomer->kind_of_food = "empty";
                if (!empty($modelCustomer->min))
                    $modelCustomer->min = $modelCustomer->min;
                else
                    $modelCustomer->min = "empty";

                $modelCustomer->currencies_symbol = $currencies_symbol;


                if ($flag = $modelCustomer->save(false)) {
                    $i = $modelCustomer->id;



                    $j = -1;

                    foreach ($modelsAddress as $model) {

                        $expression = new Expression('NOW()');
                        $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
                        $timestamp = strtotime($now);
                        //partie pour les case a caucher
                        if ($j == -1 && $modelCustomer->partner_category == 4)
                            $image_name = $model->name;

                        $j++;
                        $jsonData = array();
                        $jsonData['Vegan'] = $model->vegan;
                        $jsonData['Vegetarian'] = $model->Vegetarian;
                        $jsonData['Organic'] = $model->Organic;
                        $jsonData['Gluten_free'] = $model->Gluten_free;
                        $jsonData['Halal'] = $model->Halal;
                        $jsonData['Cacher'] = $model->Cacher;
                        $jsonData['Without_porc'] = $model->Without_porc;
                        $jsonData = json_encode($jsonData);
                        ///languages
                        $jsonLData = array();
                        $jsonLData['Spanish'] = $model->Arabic;
                        $jsonLData['Frensh'] = $model->Frensh;
                        $jsonLData['English'] = $model->English;
                        $jsonLData['Deutsh'] = $model->Deutsh;
                        $jsonLData['Chinesse'] = $model->Japenesse;
                        $jsonLData = json_encode($jsonLData);

                        $category_id = $model->partner_category;

                        if ($modelCustomer->partner_category == 3)
                            $model->checkbox = $jsonData;


                        if ($modelCustomer->partner_category == 3) {
                            $array = (explode(":", $model->name));
                            if (empty($array[1]))
                                $array[1] = "";
                            $model->name = (string)$array[0];
                            $model->product_type = $model->description;
                            $model->description = $array[1];
                            $model->temp = $model->temp;
                            $model->number_of_agent = 0;
                            $model->price_day = 0;
                            $model->price_night = 0;
                            $model->periode = 0;
                            $model->languages = "empty";
                        }
                        if ($modelCustomer->partner_category == 9) {
                            $model->languages = "empty";
                            $model->checkbox = "empty";
                            $model->temp = 'empty';
                            $model->description = "empty";
                            $model->people_number = 0;
                            $model->number_of_agent = 0;


                            $model->price_day = 0.0;
                            $model->price_night = 0.0;
                        }
                        if ($modelCustomer->partner_category == 7) {
                            $model->languages = $jsonLData;
                            $model->checkbox = "empty";
                            $model->temp = "empty";
                            $model->description = "empty";
                            $model->people_number = 0;
                            $model->number_of_agent = 0;
                            $model->price = $model->price_day;
                            $model->price_day = 0.0;
                            $model->price_night = 0.0;
                        }
                        if ($modelCustomer->partner_category == 8) {


                            $model->number_of_agent = 0;
                            $model->price = 0;
                            $model->quantity = 0;
                            $model->languages = "empty";
                            $model->checkbox = "empty";
                            $model->temp = "empty";
                            $model->description = "empty";
                            $model->people_number = 0;
                            $model->number_of_agent = 0;
                        }
                        if ($modelCustomer->partner_category == 6) {
                            $model->name = $model->name;
                            $model->temp = $model->temp;
                            $model->description = $model->name;

                            $model->people_number = 0;
                            $model->quantity = 0;
                            $model->languages = "empty";
                            $model->checkbox = "empty";
                            $model->price_day = 0.0;
                            $model->price_night = 0.0;
                            $model->number_of_agent = $model->number_of_agent;
                            $model->currencies_symbol =  $modelCustomer->currencies_symbol;
                        }
                        if ($modelCustomer->partner_category == 4) {


                            //photo

                            $model->temp = "empty";
                            $model->description = "empty";
                            $model->people_number = 0;
                            $model->number_of_agent = 0;
                            $model->quantity = 0;
                            $jsonLData = array();
                            $jsonLData['photo1'] = $model->photo1;
                            $jsonLData['video1'] = $model->video1;
                            $jsonLData['photo1andvideo'] = $model->photo1andvideo;
                            $jsonLData['photo2'] = $model->photo2;
                            $jsonLData['video2'] = $model->video2;
                            $jsonLData['photo2andvideo'] = $model->photo2andvideo;
                            $jsonLData = json_encode($jsonLData);
                            $model->checkbox = $jsonLData;

                            $model->languages = "empty";
                            $model->price_day = 0.0;
                            $model->price_night = 0.0;
                            $model->periode = 0.0;
                            $model->currencies_symbol =  $modelCustomer->currencies_symbol;
                        }
                        if ($modelCustomer->partner_category == 5) {
                            $model->temp = "empty";
                            $model->description = "empty";
                            $model->people_number = 0;
                            $model->number_of_agent = 0;
                            $model->quantity = 0;
                            $model->languages = "empty";
                            $model->checkbox = "empty";
                            $model->price_day = 0.0;
                            $model->price_night = 0.0;
                            $model->currencies_symbol =  $modelCustomer->currencies_symbol;
                        }
                        if ($modelCustomer->partner_category == 2) {
                            $model->name = (string)$model->name;
                            $model->temp = "empty";
                            $model->description = "empty";
                            $model->checkbox = "empty";
                            $model->number_of_agent = 0;
                            $model->languages = "empty";
                            $model->price_day = 0.0;
                            $model->price_night = 0.0;
                            $model->currencies_symbol =  $modelCustomer->currencies_symbol;
                        }

                        $model->currencies_symbol = $currencies_symbol;
                        $model->status = "0";
                        /**/
                        // case of normal categorty


                        if ($modelCustomer->partner_category == 4) {
                            echo sizeof($_FILES['ProductParent']["tmp_name"]["picutre"]);
                            $length = sizeof($_FILES['ProductParent']["tmp_name"]["picutre"]);
                            $array_image = array();
                            for ($k = 0; $k < $length; $k++) {
                                $e =  $_FILES['ProductParent']["name"]["picutre"][$k];
                                $type = $_FILES['ProductParent']["type"]["picutre"][$k];
                                $name = $_FILES['ProductParent']["tmp_name"]["picutre"][$k];
                                $extension = explode(".", $e);
                                $array_image[] = 'products' . $image_name . $timestamp . '.' . $extension[1];
                            }
                            $images = json_encode($array_image, true);


                            /*if (array_key_exists($j,$_FILES['ProductParent']["name"]["picutre"])) {
                                $e=  $_FILES['ProductParent']["name"]["picutre"][$j];
                                $type=$_FILES['ProductParent']["type"]["picutre"][$j];
                                $name=$_FILES['ProductParent']["tmp_name"]["picutre"][$j];
                               
                           }*/
                            $extension = explode(".", $e);
                            $model->picture = $images;
                            //$filepath="../clicangoevent/mainrepo/web/img/products/";
                            //$path = Yii::$app->basePath.'\..\img\products';
                            $reverse_image = json_decode($images, true);
                            foreach ($reverse_image as $picture) {
                                $target = 'img/products/' . basename($picture);
                                if (move_uploaded_file($name, $target)) {


                                    $fp = fopen($target, "r");
                                }
                            }
                        } else {
                            $count++;
                            $e = $_FILES['ProductItem']["name"][$j]["picture"];
                            $type = $_FILES['ProductItem']["type"][$j]["picture"];
                            $name = $_FILES['ProductItem']["tmp_name"][$j]["picture"];
                            $extension = explode(".", $e);

                            //tranformation of the model-> name into another string
                            $name_security = "";
                            $name_caters = "";
                            if ($model->name == "Bar/Restaurant")
                                $name_security = "BarRestaurant";
                            if ($model->name == "Party/Evening")
                                $name_security = "PartyEvening";
                            //

                            if ($modelCustomer->partner_category == 6)
                                $model->picture = 'products' . $name_security . $timestamp . $count . '.' . $extension[1];
                            else
                                $model->picture = 'products' . $model->name . $timestamp . $count . '.' . $extension[1];
                            if ($modelCustomer->partner_category == 3)
                                $model->picture = 'products' . $model->description . $timestamp . $count . '.' . $extension[1];
                            //$filepath="../clicangoevent/mainrepo/web/img/products/";
                            $path = Yii::$app->basePath . '\..\img\products';
                            $target = 'img/products/' . basename($model->picture);

                            if (move_uploaded_file($name, $target)) {
                                //Insert into your dbf
                                $fp = fopen($target, "r");
                            }
                        }


                        /*partie sauvgarde currencies*/



                        $model->created_at = $timestamp;
                        $model->updated_at = $timestamp;

                        $model->product_id = $i;
                        $model->partner_category = $modelCustomer->partner_category;
                        if ($modelCustomer->partner_category == 4) {
                            if ($model->name != "") {
                                if ($model->save(false)) {;
                                } else {
                                    print_r($model->getErrors());
                                    die();
                                }
                            }
                        } else {
                            echo $currencies_symbol;
                            echo $model->currencies_symbol;
                            if ($model->save(false)) {
                            } else {
                                print_r($model->getErrors());
                                die();
                            }
                        }


                        //$j++;
                        /*  if (! ($flag = $model->save(false))) {
                            
                                $transaction->rollBack();
                                break;
                            }*/
                    }

                    if ($flag) {

                        $transaction->commit();
                        Yii::$app->session->setFlash('success', "Add another product");
                        return $this->redirect(Url::to(['welcome/step', 'id' => 3, 'category_id' => $category_id_s]));
                    }
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            //   }

        }

        // return $this->redirect(Url::to(['welcome/step','id'=>3,'category_id'=>$category_id]));
        /* return $this->render('welcome', [
            'modelCustomer' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new Address] : $modelsAddress
        ]);*/
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelCustomer = $this->findModel($id);
        $modelsAddress = $modelCustomer->addresses;

        if ($modelCustomer->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsAddress, 'id', 'id');
            $modelsAddress = Model::createMultiple(Address::class, $modelsAddress);
            Model::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsAddress),
                    ActiveForm::validate($modelCustomer)
                );
            }

            // validate all models
            $valid = $modelCustomer->validate();
            $valid = Model::validateMultiple($modelsAddress) && $valid;
        }

        return $this->render('update', [
            'modelCustomer' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new Address] : $modelsAddress
        ]);
    }
    public function actionModal()
    {
        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
        $partner_id = $partner->id;
        return $this->render('_Modal_partial_RoomRental.php', ['partner_id' => $partner_id]);
    }
}
