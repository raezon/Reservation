<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\models\base\Model;
use app\models\ProductItem;
use app\models\ProductItemCamera;
use app\models\ProductParent;
use app\models\Partner;
use app\models\User;

//i need to define my model here

class saveNext extends Component
{
    function saveProduct($modelCustomer, $modelsAddress, $currencies_symbol, $timestamp)
    {
        $previous_array_image = array();
        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
        if ($modelCustomer->load(Yii::$app->request->post())) {
            if ($modelCustomer->partner_category == 4) {
                $modelsAddress = [new ProductItemCamera];
                $modelsAddress = Model::createMultiple(ProductItemCamera::class);
            } else {
                $modelsAddress = Model::createMultiple(ProductItem::class);
            }
            Model::loadMultiple($modelsAddress, Yii::$app->request->post());
            $category_id = $modelCustomer->partner_category;
            $cat = $category_id;
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
                    $j = 0;
                    foreach ($modelsAddress as $model) {
                        //partie pour les case a caucher
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
                        $jsonLData['Spanish'] = $model->Spanish;
                        $jsonLData['Frensh'] = $model->Frensh;
                        $jsonLData['English'] = $model->English;
                        $jsonLData['Deutsh'] = $model->Deutsh;
                        $jsonLData['Chinesse'] = $model->Chinesse;
                        $jsonLData = json_encode($jsonLData);

                        $category_id = $model->partner_category;

                        if ($modelCustomer->partner_category == 1) {
                            $model->caution = 0.0;
                         //   $model->price = 0.0;
                        }

                        if ($modelCustomer->partner_category == 2) {
                            $model->name = (string)$model->name;
                            $model->temp = "empty";
                            $model->periode = 0.0;;
                            $model->people_number = 0.0;
                            $model->description = "empty";
                            $model->checkbox = "empty";
                            $model->number_of_agent = 0;
                            $model->languages = "empty";
                            $model->price = $model->price;
                        }
                        if ($modelCustomer->partner_category == 3) {
                            $model->checkbox = $jsonData;
                            $splitedMealCategory = array();
                            $splitedMealType = array();
                            foreach ($model->name as $element) {
                                $splitedMeal = (explode(":", $element));
                                if (empty($splitedMeal[1]))
                                    $splitedMeal[1] = "";
                                $splitedMealCategory[] = $splitedMeal[0];
                                if ($splitedMeal[1] != "")
                                    $splitedMealType[] = $splitedMeal[1];
                            }
                            $splitedMealType[] = $model->name;
                            $model->name = json_encode($splitedMealCategory, true);
                            $model->product_type = $model->description;
                            
                            $model->temp = $model->temp;
                            $model->number_of_agent = 0;
                            $model->price = $model->price;
                            $model->periode = 0;
                            $model->languages = (string) json_encode($splitedMealType, true);
                        }

                        if ($modelCustomer->partner_category == 8) {
                            $model->languages = "empty";
                            $model->checkbox = "empty";
                            $model->temp = 'empty';
                            $model->quantity = 0.0;
                            $model->description = "empty";
                            $model->people_number = 0;
                            $model->number_of_agent = 0;
                            $model->price = $model->price;
                        }

                        $model->status = "0";
                        /**/
                        if ($modelCustomer->partner_category == 4) {
                           // $model->price = 0.0;
                            $model->periode = 0.0;
                            $length = sizeof($_FILES['ProductParent']["tmp_name"]["picutre"]);
                            $array_image = array();
                            if ($j < 1) {
                                for ($k = 0; $k < $length; $k++) {
                                    $e =  $_FILES['ProductParent']["name"]["picutre"][$k];
                                    $type = $_FILES['ProductParent']["type"]["picutre"][$k];
                                    $name = $_FILES['ProductParent']["tmp_name"]["picutre"][$k];
                                    $extension = explode(".", $e);
                                    $array_image[] = 'products' . $model->name . $j . $timestamp . '.' . $extension[1];
                                }
                                $previous_array_image = $array_image;
                                $images = json_encode($array_image, true);
                            } else {
                                $images = json_encode($previous_array_image, true);
                            }


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
                            //$model->min_price = 0.0;


                            $length = sizeof($_FILES['ProductItem']["tmp_name"][$j]["picture"]);

                            $array_image = array();
                            // if ($j < 1) {

                            for ($k = 0; $k < $length; $k++) {
                                $e =  $_FILES['ProductItem']["name"][$j]["picture"][$k];
                                $type = $_FILES['ProductItem']["type"][$j]["picture"][$k];
                                $name = $_FILES['ProductItem']["tmp_name"][$j]["picture"][$k];
                                $extension = explode(".", $e);
                                // I delete space from Name or description 
                                if ($modelCustomer->partner_category == 3) {
                                    $description = str_replace(' ', '', $model->description);

                                    $array_image[] = 'products' . $description . $j . $k . $timestamp . '.' . $extension[1];
                                } else {
                                    if ($modelCustomer->partner_category == 3) {
                                        $description = str_replace(' ', '', $model->description);

                                        $array_image[] = 'products' . $description . $j . $k . $timestamp . '.' . $extension[1];
                                    } else {
                                        if ($modelCustomer->partner_category == 6) {
                                            $name3 = json_decode($model->name, true);
                                            $name3 = (string)$name3[0];
                                            $array_image[] = 'products' . $name3 . $j . $k . $timestamp . '.' . $extension[1];
                                        } else {
                                            $name1 = str_replace(' ', '', $model->name);
                                            $array_image[] = 'products' . $name1 . $j . $k . $timestamp . '.' . $extension[1];
                                        }
                                    }
                                }
                                $extension = explode(".", $e);
                                $previous_array_image = $array_image;
                                if ($modelCustomer->partner_category == 3) {
                                    $description = str_replace(' ', '', $model->description);
                                    $image = 'products' . $description . $j . $k . $timestamp . '.' . $extension[1];
                                } else {
                                    if ($modelCustomer->partner_category == 6) {
                                        $name3 = json_decode($model->name, true);
                                        $name3 = (string)$name[0];

                                        $image = 'products' . $name3 . $j . $k . $timestamp . '.' . $extension[1];
                                    } else {
                                        $name1 = str_replace(' ', '', $model->name);
                                        $image = 'products' . $name1 . $j . $k . $timestamp . '.' . $extension[1];
                                    }
                                }

                                $images = json_encode($array_image, true);
                                $model->picture = (string) $images;
                                $reverse_image = json_decode($images, true);
                                $target = 'img/products/' . basename($image);
                                foreach ($reverse_image as $picture) {
                                    $target = 'img/products/' . basename($picture);
                                    if (move_uploaded_file($name, $target)) {


                                        $fp = fopen($target, "r");
                                    }
                                }
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
                                if ($model->save(false)) {;
                                } else {
                                    echo "galtha";
                                    print_r($model->getErrors());
                                    die();
                                }
                            }
                        } else {

                            if ($model->save()) {
                            } else {
                                echo "galtha";

                                print_r($model->getErrors());
                                die();
                            }
                        }

                        $j++;
                    }

                    if ($flag) {

                        $transaction->commit();
                    }
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            //   }

        }
    }
}
