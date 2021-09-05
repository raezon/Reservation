<?php

use app\widgets\Description as WidgetsDescription;
use app\widgets\FirstDetatil as WidgetsFirstDetail;
use app\widgets\Bill as WidgetsBill;
use app\widgets\Inforamtion as WidgetsInformation;
use app\widgets\Room as WidgetsRoom;
use app\widgets\CatersMenu as WidgetsCaterMenu;
use app\widgets\RoomsMenu as WidgetsRoomsMenu;
use app\widgets\SecurityMenu as WidgetsSecurityMenu;
use app\widgets\ExtraPrice as WidgetsExtraPrice;
?>

<!--Premier Partie Gallerie -->
    <div  class="row color-bottom" style="padding-bottom:250px;margin-top:-58px;">
        <div class="gallery">
            <?php WidgetsFirstDetail::widgetGallery($count, $model) ?>
        
        </div>
        <div class="card-body " style="position: absolute;top: 500px;left: 177px;">
                <!-- Deuxieme partie Nom en plus de voir sur map en plus de l'addresse -->
                <?php WidgetsFirstDetail::widgetMapAndNameOfProduct($partner, $product, $product_parent, $modelmap, $latitude, $longitude, $latFrom, $lngFrom) ?>
            </div>
    </div>


<!-- Deuxieme partie Nom en plus de voir sur map en plus de l'addresse -->
<div class="row color-bottom">
    <div class="col-sm-8   center">
        <!--- Description -->
        <?= WidgetsDescription::Description($product_parent, $product, $cancelation) ?>
        <!--- Footer Logo Categorie -->
        <!--Information-->
        <?= WidgetsInformation::widget([
            'category' => $product_parent->partner_category,
            'qte' => $product->quantity,
            'duration' => $product->periode,
            'number_of_people' => $product->people_number,
            'number_of_agent' => $product->number_of_agent,
            'cautionAndArea' => $product->product_type,
            'temp' => $product->temp,
            'name' => $product->name,
            'description' => $product->description,
            'camera' => $product->checkbox,
            'kind_of_food' => $product_parent->kind_of_food,
            'product' => $product->checkbox,
            'product_parent' => $product_parent->partner_category,
            'Languages' => $Languages,
            'categories' => $product_parent->partner_category
        ]) ?>
        <?= WidgetsRoom::widget([
            'roomRental' => $product->product_type,
            'categories' => $product_parent->partner_category

        ]) ?>
        <!--Room Menu-->
        <?= WidgetsRoomsMenu::widget([
            'name' => $product->temp,
            'type' => $product->description,
            'categories' => $product_parent->partner_category
        ]) ?>

        <!--Cater Menu-->
        <?= WidgetsCaterMenu::widget([
            'name' => $product->name,
            'type' => $product->languages,
            'categories' => $product_parent->partner_category
        ]) ?>

        <!--Cater Menu-->
        <?= WidgetsSecurityMenu::widget([
            'name' => $product->name,
            'type' => $product->temp,
            'categories' => $product_parent->partner_category
        ]) ?>
        <!--Extra Services -->


        <?= WidgetsExtraPrice::widget([
            'count' => $count,
            'Extra' => $extra,
            'product_item' => $id,
            'product_parent' => $product_parent->id
        ]) ?>


    </div>

    <div class="col-sm-4  center Billing">
        <?php if ($product_parent->partner_category != 1) : ?>
            <?= WidgetsBill::widget([
                'product_item' => $id,
                'category' => $product_parent->partner_category,
                'description' => $product->description,
                'people_number' => $product->people_number,
                'date_depart' => $_SESSION['date_depart'],
                'date_arriver' => $_SESSION['date_arriver'],
                'deliveryServiceAndPrice' => $deliveryPrice,
                'product' => $product,


            ]) ?>
        <?php endif; ?>
        <?php if ($product_parent->partner_category == 1) : ?>
            <?= WidgetsBill::widget([
                'product_item' => $id,
                'category' => $product_parent->partner_category,
                'description' => $product->description,
                'people_number' => $qte,
                'date_depart' => $_SESSION['date_depart'],
                'date_arriver' => $_SESSION['date_arriver'],
                'deliveryServiceAndPrice' => 0

            ]) ?>
        <?php endif; ?>
    </div>
</div>


<?php
$js = '
var content= $("[data-toggle=modal] span u ").html()

if(content=="voir sur la carte"){
$(".card-body [data-toggle=modal]").css("background-color", "#fff");
$(".card-body [data-toggle=modal]").css("border", "none");
}
';
$this->registerJs($js); ?>