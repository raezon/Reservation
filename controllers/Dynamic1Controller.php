<?php

namespace app\controllers;

use Yii;
use app\models\ProductParent;
use app\models\ProductItemCamera;
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
class Dynamic1Controller extends Controller
{


    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

        $previous_array_image = array();
        $expression = new Expression('NOW()');
        $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW()
        $timestamp = strtotime($now);
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
        $modelsAddress = [new ProductItemCamera];
        if ($modelCustomer->load(Yii::$app->request->post())) {
            $modelsAddress = Model::createMultiple(ProductItemCamera::class);
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
                //$modelCustomer->quantity=0;
                // $modelCustomer->price=0;

                // $modelCustomer->description="";
                $modelCustomer->currencies_symbol = $currencies_symbol;


                if ($flag = $modelCustomer->save(false)) {
                    $i = $modelCustomer->id;



                    $j = -1;

                    foreach ($modelsAddress as $model) {
                        //partie pour les case a caucher

                        $j++;


                        $jsonData = array();
                        $jsonData['vegan'] = $model->vegan;
                        $jsonData['Vegetarian'] = $model->Vegetarian;
                        $jsonData['Organic'] = $model->Organic;
                        $jsonData['Gluten_free'] = $model->Gluten_free;
                        $jsonData['Halal'] = $model->Halal;
                        $jsonData['Cacher'] = $model->Cacher;
                        $jsonData['Without_porc'] = $model->Without_porc;
                        $jsonData = json_encode($jsonData);
                        ///languages
                        $jsonLData = array();
                        $jsonLData['Arabic'] = $model->Arabic;
                        $jsonLData['Frensh'] = $model->Frensh;
                        $jsonLData['English'] = $model->English;
                        $jsonLData['Deutsh'] = $model->Deutsh;
                        $jsonLData['Japenesse'] = $model->Japenesse;
                        $jsonLData = json_encode($jsonLData);

                        $category_id = $model->partner_category;

                        if ($modelCustomer->partner_category == 3)
                            $model->checkbox = $jsonData;


                        if ($modelCustomer->partner_category == 3) {

                            $model->name = $model->description;
                            $model->description = $model->name;
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

                            $model->price = 0.0;
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
                            $model->name = $model->name . $j;
                            $model->description = $model->description . $j;
                            $model->temp = $model->temp . $j;
                            $model->description = "empty";
                            $model->people_number = 0;
                            $model->quantity = 0;
                            $model->languages = "empty";
                            $model->checkbox = "empty";
                            $model->price_day = 0.0;
                            $model->price_night = 0.0;
                            $model->number_of_agent = $model->number_of_agent;
                        }
                        if ($modelCustomer->partner_category == 4) {
                            $model->price = $model->price;

                            if (empty($model->name))
                                break;
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
                            $jsonLData = json_encode($jsonLData, true);
                            $model->checkbox = $jsonLData;
                            $model->languages = "empty";
                            $model->price_day = 0.0;
                            $model->price_night = 0.0;
                            $model->periode = 0.0;
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
                        }

                        $model->status = "0";
                        /**/
                        // case of normal categorty


                        if ($modelCustomer->partner_category == 4) {
                            echo sizeof($_FILES['ProductParent']["tmp_name"]["picutre"]);
                            $length = sizeof($_FILES['ProductParent']["tmp_name"]["picutre"]);
                            $array_image = array();
                            if ($j < 1) {
                                for ($k = 0; $k < $length; $k++) {
                                    $e =  $_FILES['ProductParent']["name"]["picutre"][$k];
                                    $type = $_FILES['ProductParent']["type"]["picutre"][$k];
                                    $name = $_FILES['ProductParent']["tmp_name"]["picutre"][$k];
                                    $extension = explode(".", $e);
                                    $array_image[] = 'products' . $model->name . $timestamp . '.' . $extension[1];
                                }
                                $previous_array_image = $array_image;
                                $images = json_encode($array_image, true);
                            } else {
                                $images = json_encode($previous_array_image, true);
                            }


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
                            $e = $_FILES['ProductItemCamera']["name"][$j]["picture"];
                            $type = $_FILES['ProductItemCamera']["type"][$j]["picture"];
                            $name = $_FILES['ProductItemCamera']["tmp_name"][$j]["picture"];
                            $extension = explode(".", $e);
                            $model->picture = 'products' . $model->name . $timestamp . '.' . $extension[1];
                            //$filepath="../clicangoevent/mainrepo/web/img/products/";
                            //$path = Yii::$app->basePath.'\..\img\products';
                            $target = 'img/products/' . basename($model->picture);

                            if (move_uploaded_file($name, $target)) {

                                //Insert into your db

                                $fp = fopen($target, "r");
                            }
                        }


                        /*partie sauvgarde currencies*/

                        $model->currencies_symbol = $currencies_symbol;

                        $model->created_at = $timestamp;
                        $model->updated_at = $timestamp;

                        $model->product_id = $i;
                        $model->partner_category = $modelCustomer->partner_category;
                        if ($modelCustomer->partner_category == 4) {
                            if ($model->name != "") {
                                if ($model->save()) {
                                } else {
                                    print_r($model->getErrors());
                                    die();
                                }
                            }
                        } else {
                            if ($model->save()) {
                                // $session = Yii::$app->session;
                                // $session->set('ProductItemCamera', $model);


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
            $modelsAddress = Model::createMultiple(Address::classname(), $modelsAddress);
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

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        if (!empty($deletedIDs)) {
                            Address::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->customer_id = $modelCustomer->id;
                            if (!($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelCustomer->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
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
