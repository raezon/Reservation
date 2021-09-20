<?php

use app\widgets\FirstDetatil as WidgetsFirstDetail;
use app\widgets\SecurityMenu as WidgetsSecurityMenu;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\rating\StarRating;
$avis=new app\models\Avis;
?>
<!-- product-detail-top -->
<div class="product-detail-top">
    <div class="container">



        <div class="row main-productdetail" data-product_layout_thumb="list_thumb" style="position: relative;">
            <div class="col-lg-5 col-md-4 col-xs-12 box-image">

                <section class="page-content" id="content">



                    <div class="images-container list_thumb">

                        <div class="product-cover">
                            <?php WidgetsFirstDetail::widgetGallery($count, $model)?>
                            <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                                <i class="fa fa-expand"></i>
                            </div>
                        </div>


                    </div>

                </section>

            </div>

            <div class="col-lg-7 col-md-8 col-xs-12 mt-sm-20">
                <div class="product-information">
                    <div class="product-actions">

                        <form action="index.php?r=site/reservation" 
                            id="add-to-cart-or-refresh" class="row">
                        
                            <div class="productdetail-right col-12 col-lg-6 col-md-6">
                                <div class="product-reviews">
                                    <div id="product_comments_block_extra">

                                        <div class="comments_note">
                                            <span>Review: </span>
                                            <div class="star_content clearfix">
                                                <div class="star star_on"></div>
                                                <div class="star star_on"></div>
                                                <div class="star star_on"></div>
                                                <div class="star star_on"></div>
                                                <div class="star star_on"></div>
                                            </div>
                                        </div>


                                        <div class="comments_advices">
                                            <a href="#" class="comments_advices_tab"><i class="fa fa-comments"></i>Lire
                                                avis (1)</a>
                                            <a class="open-comment-form" data-toggle="modal"
                                                data-target="#new_comment_form" href="#"><i
                                                    class="fa fa-edit"></i>Ecrire avis</a>
                                        </div>
                                    </div>


                                    <!--  /Module NovProductComments -->

                                </div>

                                <h1 class="detail-product-name" itemprop="name"><?=$product->name?></h1>



                                <div class="group-price d-flex justify-content-start align-items-center">

                                    <div class="product-prices">


                                        <div class="product-price " itemprop="offers" itemscope=""
                                            itemtype="https://schema.org/Offer">
                                            <link itemprop="availability" href="https://schema.org/InStock">
                                            <meta itemprop="priceCurrency" content="GBP">

                                            <div class="current-price">

                                                <span itemprop="price" class="price"
                                                    content="24"><?=$product->price?>&nbsp;Da</span>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="in_border end">

                                    <div class="sku">
                                        <label class="control-label">Description:</label>
                                        <span itemprop="sku" content="demo_1"><?=$product_parent->description?></span>
                                    </div>
                                    <div class="pro-cate">
                                        <label class="control-label">Bien:</label>
                                        <?=$product_parent->partnerCategory->name?>
                                        <div>
                                        </div>
                                    </div>
                                   
                                </div>

                                <input class="sb-search-input" placeholder="I want your freebies!" type="hidden" id="email" name="email"  value='2'>
                                <div id="_desktop_productcart_detail">
                                    <div class="product-add-to-cart in_border">
                                        <div class="add">
                                            
                                            <a class="btn btn-primary add-to-cart"  
                                                href='index.php?r=site/reservation&prix=<?=$product->price?>&id=<?=$product->id?>&partner_id=<?=$product_parent->partner_id?>' >
                                                <div class="icon-cart">
                                                    <i class="shopping-cart"></i>
                                                </div>
                                                <?php if($product_parent->partnerCategory->id==2){?>
                                                <span>Acheter</span>
                                                <?php }else{?>
                                               
                                                    <span>Reserver</span>
                                                <?php }?>

</a>


                                        </div>

                                        <div class="clearfix"></div>

                                        <div id="product-availability" class="info-stock mt-20">
                                        </div>




                                    </div>
                                </div>


                                <input class="product-refresh ps-hidden-by-js" name="refresh" type="submit"
                                    value="Rafraîchir" style="display: none;">

                            </div>
                            <div class="productdetail-left col-12 col-lg-6 col-md-6">







                                <div class="product-variants in_border">

                                    <?php WidgetsFirstDetail::widgetMapAndNameOfProduct($partner, $product, $product_parent, $modelmap, $latitude, $longitude, $latFrom, $lngFrom)?>
                                </div>








                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-detail-middle">
        <div class="container">
            <div class="row">
                <div class="tabs col-lg-9 col-md-7 ">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#description" aria-expanded="true">La
                                description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#product-details" aria-expanded="false">Product
                                Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#reviews" aria-expanded="false">Ecrire votre
                                avis<span class="count-comment"> (1)</span></a>
                        </li>


                    </ul>

                    <div class="tab-content" id="tab-content">
                        <div class="tab-pane fade active in" id="description" aria-expanded="true">

                            <div class="product-description">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                    quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet
                                    nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                    Aenean commodo ligula eget dolor. Aenean massa.</p>
                                <h3>Lorem ipsum dolor sit amet</h3>
                                <div class="image-des"><a href="#"><img class="img-fluid"
                                            src="http://images.vinovathemes.com/prestashop_savemart/image-product-1.jpg"
                                            alt="#"></a></div>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. <br> Donec quam felis, ultricies nec, pellentesque eu,
                                    pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel,
                                    aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer
                                    adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor
                                    sit amet, consectetuer adipiscing elit.</p>
                                <div class="image-des"><a href="#"><img class="img-fluid"
                                            src="http://images.vinovathemes.com/prestashop_savemart/image-product-2.jpg"
                                            alt="#"></a></div>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. <br> Donec quam felis, ultricies nec, pellentesque eu,
                                    pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel,
                                    aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer
                                    adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor
                                    sit amet, consectetuer adipiscing elit.<br> Lorem ipsum dolor sit amet, consectetuer
                                    adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque
                                    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor
                                    sit amet, consectetuer adipiscing elit.</p>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="product-details"
                            data-product="{&quot;id_shop_default&quot;:&quot;1&quot;,&quot;id_manufacturer&quot;:&quot;1&quot;,&quot;id_supplier&quot;:&quot;0&quot;,&quot;reference&quot;:&quot;demo_1&quot;,&quot;is_virtual&quot;:&quot;0&quot;,&quot;delivery_in_stock&quot;:&quot;&quot;,&quot;delivery_out_stock&quot;:&quot;&quot;,&quot;id_category_default&quot;:&quot;9&quot;,&quot;on_sale&quot;:&quot;0&quot;,&quot;online_only&quot;:&quot;0&quot;,&quot;ecotax&quot;:0,&quot;minimal_quantity&quot;:&quot;2&quot;,&quot;low_stock_threshold&quot;:null,&quot;low_stock_alert&quot;:&quot;0&quot;,&quot;price&quot;:&quot;24,00\u00a0\u00a3&quot;,&quot;unity&quot;:&quot;&quot;,&quot;unit_price_ratio&quot;:&quot;0.000000&quot;,&quot;additional_shipping_cost&quot;:&quot;0.00&quot;,&quot;customizable&quot;:&quot;0&quot;,&quot;text_fields&quot;:&quot;0&quot;,&quot;uploadable_files&quot;:&quot;0&quot;,&quot;redirect_type&quot;:&quot;404&quot;,&quot;id_type_redirected&quot;:&quot;0&quot;,&quot;available_for_order&quot;:&quot;1&quot;,&quot;available_date&quot;:null,&quot;show_condition&quot;:&quot;0&quot;,&quot;condition&quot;:&quot;new&quot;,&quot;show_price&quot;:&quot;1&quot;,&quot;indexed&quot;:&quot;1&quot;,&quot;visibility&quot;:&quot;both&quot;,&quot;cache_default_attribute&quot;:&quot;40&quot;,&quot;advanced_stock_management&quot;:&quot;0&quot;,&quot;date_add&quot;:&quot;2018-07-13 03:39:58&quot;,&quot;date_upd&quot;:&quot;2018-08-30 05:50:25&quot;,&quot;pack_stock_type&quot;:&quot;3&quot;,&quot;meta_description&quot;:&quot;&quot;,&quot;meta_keywords&quot;:&quot;&quot;,&quot;meta_title&quot;:&quot;&quot;,&quot;link_rewrite&quot;:&quot;hummingbird-printed-t-shirt&quot;,&quot;name&quot;:&quot;Nullam sed sollicitudin mauris&quot;,&quot;description&quot;:&quot;<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.<\/p>\r\n<h3>Lorem ipsum dolor sit amet<\/h3>\r\n<div class=\&quot;image-des\&quot;><a href=\&quot;#\&quot;><img class=\&quot;img-fluid\&quot; src=\&quot;http:\/\/images.vinovathemes.com\/prestashop_savemart\/image-product-1.jpg\&quot; alt=\&quot;#\&quot; \/><\/a><\/div>\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <br \/> Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\/p>\r\n<div class=\&quot;image-des\&quot;><a href=\&quot;#\&quot;><img class=\&quot;img-fluid\&quot; src=\&quot;http:\/\/images.vinovathemes.com\/prestashop_savemart\/image-product-2.jpg\&quot; alt=\&quot;#\&quot; \/><\/a><\/div>\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <br \/> Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<br \/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.<\/p>&quot;,&quot;description_short&quot;:&quot;<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.<\/p>&quot;,&quot;available_now&quot;:&quot;&quot;,&quot;available_later&quot;:&quot;&quot;,&quot;id&quot;:1,&quot;id_product&quot;:1,&quot;out_of_stock&quot;:2,&quot;new&quot;:1,&quot;id_product_attribute&quot;:40,&quot;quantity_wanted&quot;:2,&quot;extraContent&quot;:[],&quot;allow_oosp&quot;:0,&quot;category&quot;:&quot;smartphone-tablet&quot;,&quot;category_name&quot;:&quot;Smartphone &amp; Tablet&quot;,&quot;link&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/fr\/smartphone-tablet\/1-hummingbird-printed-t-shirt.html&quot;,&quot;attribute_price&quot;:0,&quot;price_tax_exc&quot;:20,&quot;price_without_reduction&quot;:24,&quot;reduction&quot;:0,&quot;specific_prices&quot;:false,&quot;quantity&quot;:84,&quot;quantity_all_versions&quot;:1883,&quot;id_image&quot;:&quot;fr-default&quot;,&quot;features&quot;:[],&quot;attachments&quot;:[],&quot;virtual&quot;:0,&quot;pack&quot;:0,&quot;packItems&quot;:[],&quot;nopackprice&quot;:0,&quot;customization_required&quot;:false,&quot;attributes&quot;:{&quot;1&quot;:{&quot;id_attribute&quot;:&quot;1&quot;,&quot;id_attribute_group&quot;:&quot;1&quot;,&quot;name&quot;:&quot;S&quot;,&quot;group&quot;:&quot;Taille&quot;,&quot;reference&quot;:&quot;&quot;,&quot;ean13&quot;:&quot;&quot;,&quot;isbn&quot;:&quot;&quot;,&quot;upc&quot;:&quot;&quot;},&quot;2&quot;:{&quot;id_attribute&quot;:&quot;6&quot;,&quot;id_attribute_group&quot;:&quot;2&quot;,&quot;name&quot;:&quot;Taupe&quot;,&quot;group&quot;:&quot;Colour&quot;,&quot;reference&quot;:&quot;&quot;,&quot;ean13&quot;:&quot;&quot;,&quot;isbn&quot;:&quot;&quot;,&quot;upc&quot;:&quot;&quot;}},&quot;rate&quot;:20,&quot;tax_name&quot;:&quot;VAT UK 20%&quot;,&quot;ecotax_rate&quot;:0,&quot;unit_price&quot;:&quot;&quot;,&quot;customizations&quot;:{&quot;fields&quot;:[]},&quot;id_customization&quot;:0,&quot;is_customizable&quot;:false,&quot;show_quantities&quot;:true,&quot;quantity_label&quot;:&quot;Produits&quot;,&quot;quantity_discounts&quot;:[],&quot;customer_group_discount&quot;:0,&quot;images&quot;:[{&quot;bySize&quot;:{&quot;cart_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;small_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-small_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:150,&quot;height&quot;:150},&quot;medium_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;home_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-home_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;large_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600}},&quot;small&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;medium&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;large&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;legend&quot;:&quot;&quot;,&quot;cover&quot;:&quot;1&quot;,&quot;id_image&quot;:&quot;24&quot;,&quot;position&quot;:&quot;1&quot;,&quot;associatedVariants&quot;:[&quot;40&quot;]},{&quot;bySize&quot;:{&quot;cart_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/25-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;small_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/25-small_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:150,&quot;height&quot;:150},&quot;medium_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/25-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;home_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/25-home_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;large_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/25-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600}},&quot;small&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/25-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;medium&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/25-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;large&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/25-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;legend&quot;:&quot;&quot;,&quot;cover&quot;:null,&quot;id_image&quot;:&quot;25&quot;,&quot;position&quot;:&quot;2&quot;,&quot;associatedVariants&quot;:[&quot;40&quot;,&quot;41&quot;]},{&quot;bySize&quot;:{&quot;cart_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/26-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;small_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/26-small_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:150,&quot;height&quot;:150},&quot;medium_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/26-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;home_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/26-home_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;large_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/26-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600}},&quot;small&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/26-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;medium&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/26-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;large&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/26-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;legend&quot;:&quot;&quot;,&quot;cover&quot;:null,&quot;id_image&quot;:&quot;26&quot;,&quot;position&quot;:&quot;3&quot;,&quot;associatedVariants&quot;:[&quot;40&quot;,&quot;41&quot;,&quot;44&quot;,&quot;57&quot;,&quot;42&quot;,&quot;50&quot;]},{&quot;bySize&quot;:{&quot;cart_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/27-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;small_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/27-small_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:150,&quot;height&quot;:150},&quot;medium_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/27-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;home_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/27-home_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;large_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/27-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600}},&quot;small&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/27-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;medium&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/27-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;large&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/27-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;legend&quot;:&quot;&quot;,&quot;cover&quot;:null,&quot;id_image&quot;:&quot;27&quot;,&quot;position&quot;:&quot;4&quot;,&quot;associatedVariants&quot;:[&quot;40&quot;,&quot;41&quot;,&quot;44&quot;,&quot;42&quot;,&quot;50&quot;,&quot;51&quot;,&quot;48&quot;]},{&quot;bySize&quot;:{&quot;cart_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/28-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;small_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/28-small_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:150,&quot;height&quot;:150},&quot;medium_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/28-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;home_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/28-home_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;large_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/28-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600}},&quot;small&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/28-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;medium&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/28-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;large&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/28-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;legend&quot;:&quot;&quot;,&quot;cover&quot;:null,&quot;id_image&quot;:&quot;28&quot;,&quot;position&quot;:&quot;5&quot;,&quot;associatedVariants&quot;:[&quot;40&quot;,&quot;41&quot;,&quot;44&quot;,&quot;57&quot;,&quot;42&quot;,&quot;50&quot;]}],&quot;cover&quot;:{&quot;bySize&quot;:{&quot;cart_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;small_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-small_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:150,&quot;height&quot;:150},&quot;medium_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;home_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-home_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;large_default&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600}},&quot;small&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-cart_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;medium&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-medium_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:210,&quot;height&quot;:210},&quot;large&quot;:{&quot;url&quot;:&quot;http:\/\/demo.bestprestashoptheme.com\/savemart\/24-large_default\/hummingbird-printed-t-shirt.jpg&quot;,&quot;width&quot;:600,&quot;height&quot;:600},&quot;legend&quot;:&quot;&quot;,&quot;cover&quot;:&quot;1&quot;,&quot;id_image&quot;:&quot;24&quot;,&quot;position&quot;:&quot;1&quot;,&quot;associatedVariants&quot;:[&quot;40&quot;]},&quot;has_discount&quot;:false,&quot;discount_type&quot;:null,&quot;discount_percentage&quot;:null,&quot;discount_percentage_absolute&quot;:null,&quot;discount_amount&quot;:null,&quot;discount_amount_to_display&quot;:null,&quot;price_amount&quot;:24,&quot;unit_price_full&quot;:&quot;&quot;,&quot;show_availability&quot;:true,&quot;availability_date&quot;:null,&quot;availability_message&quot;:&quot;&quot;,&quot;availability&quot;:&quot;available&quot;}"
                            aria-expanded="false">

                            <div class="product-manufacturer">
                                <a href="http://demo.bestprestashoptheme.com/savemart/fr/1_lorem-ipsum">
                                    <img src="http://demo.bestprestashoptheme.com/savemart/img/m/1.jpg"
                                        class="img img-thumbnail manufacturer-logo">
                                </a>
                            </div>
                            <div class="product-reference">
                                <label class="label">Référence </label>
                                <span itemprop="sku">demo_1</span>
                            </div>

                            <div class="product-quantities">
                                <label class="label">En stock</label>
                                <span>84 Produits</span>
                            </div>

                            <div class="product-out-of-stock">

                            </div>

                            <section class="product-features">
                                <h3>Références spécifiques</h3>
                                <dl class="data-sheet">
                                </dl>
                            </section>




                        </div>





                        <script type="text/javascript">
                        var novproductcomments_controller_url =
                            'http://demo.bestprestashoptheme.com/savemart/fr/module/novproductcomments/default';
                        var confirm_report_message = 'Are you sure that you want to report this comment?';
                        var secure_key = 'c0d88cffbca7857951c1805219eba7c2';
                        var novproductcomments_url_rewrite = '1';
                        var productcomment_added = 'Your comment has been added!';
                        var productcomment_added_moderation =
                            'Your comment has been submitted and will be available once approved by a moderator.';
                        var productcomment_title = 'New comment';
                        var productcomment_ok = 'OK';
                        var moderation_active = 1;

                        
                        </script>

                        <div class="tab-pane fade" id="reviews" aria-expanded="false">
                            <div id="product_comments_block_tab">
                                <div class="comment clearfix">
                                    <div class="comment_author">
                                        <span>Grade&nbsp;</span>
                                        <div class="star_content clearfix">
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                        </div>
                                        <div class="comment_author_infos">
                                            <div class="user-comment"><i class="fa fa-user-o"></i> dfsfs</div>
                                            <div class="date-comment">07/08/2018</div>
                                        </div>
                                    </div>
                                    <div class="comment_details">
                                        <h4>fsfdfs</h4>
                                        <p>fdfsd</p>
                                        <ul>
                                            <li>3 out of 5 people found this review useful.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-10">
                                <a id="new_comment_tab_btn" class="open-comment-form btn btn-default"
                                    data-toggle="modal" data-target="#new_comment_form" href="#">Ecrire votre avis !</a>
                            </p>

                        </div>


                        <div class="modal fade" id="new_comment_form" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-xs-center"><i class="fa fa-edit"></i> Ecrire votre
                                            avis</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="material-icons close">close</i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <?php
                                     $picture=json_decode($product->picture,true);
                                     $path = Yii::getAlias('@productImgUrl') . '/' . $picture[0];
                                    ?>
                                            <div class="product row no-gutters">
                                                <div class="product-image col-4">
                                                    <img class="img-fluid"
                                                        src="<?= $path ?>"
                                                        height="" width="" alt="Nullam sed sollicitudin mauris">
                                                </div>
                                                <div class="product_desc col-8">
                                                    <p class="product_name"><?=$product->name?></p>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="new_comment_form_content">
                                                <div id="new_comment_form_error" class="error alert alert-danger">
                                                    <ul></ul>
                                                </div>
                                              
                                                <?php $form = ActiveForm::begin();?>
                                               

                                              <?=$form->field($avis, 'commentaire')->textarea()?>
                                              <div class="star_content clearfix">
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                        </div>
                                           

                                                    <div class="fr">
                                                        <button id="submitNewMessage" data-dismiss="modal"
                                                            aria-label="Close" class="btn btn-primary"
                                                            name="submitMessage" type="submit">Envoyer</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php ActiveForm::end();?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="tab-custom" aria-expanded="false">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla congue
                                ultricies. Nam cursus velit in erat rutrum, sed ullamcorper nunc dictum. Sed volutpat,
                                mauris ac pulvinar lobortis, felis ipsum commodo diam, nec vehicula lorem dui eu urna.
                                Proin sodales nisi vitae diam congue, viverra congue metus iaculis. Pellentesque
                                ultricies erat purus, ut commodo sapien imperdiet quis. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Maecenas eu sagittis nibh, sed scelerisque nunc.
                                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                                egestas. Sed elit tortor, scelerisque id pellentesque nec, facilisis ut urna. Etiam
                                scelerisque eleifend eros. Donec consectetur aliquam magna ac tristique</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla congue
                                ultricies. Nam cursus velit in erat rutrum, sed ullamcorper nunc dictum. Sed volutpat,
                                mauris ac pulvinar lobortis, felis ipsum commodo diam, nec vehicula lorem dui eu urna.
                                Proin sodales nisi vitae diam congue, viverra congue metus iaculis. Pellentesque
                                ultricies erat purus, ut commodo sapien imperdiet quis. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Maecenas eu sagittis nibh, sed scelerisque nunc.
                                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                                egestas. Sed elit tortor, scelerisque id pellentesque nec, facilisis ut urna. Etiam
                                scelerisque eleifend eros. Donec consectetur aliquam magna ac tristique</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla congue
                                ultricies. Nam cursus velit in erat rutrum, sed ullamcorper nunc dictum. Sed volutpat,
                                mauris ac pulvinar lobortis, felis ipsum commodo diam, nec vehicula lorem dui eu urna.
                                Proin sodales nisi vitae diam congue, viverra congue metus iaculis. Pellentesque
                                ultricies erat purus, ut commodo sapien imperdiet quis. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Maecenas eu sagittis nibh, sed scelerisque nunc.
                                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                                egestas. Sed elit tortor, scelerisque id pellentesque nec, facilisis ut urna. Etiam
                                scelerisque eleifend eros. Donec consectetur aliquam magna ac tristique</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5">


                    <div class="nov-html col-xl-12 col-lg-12 col-md-12 policy-product no-padding">
                        <div class="block">
                            <div class="block_content">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>