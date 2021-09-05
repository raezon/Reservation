<?php
$js = '
         //Facilities
           $("#servicesandpriceform-services_f-0-description").attr("placeholder","Facilities 1");
           $("#servicesandpriceform-services_f-0-description2").attr("placeholder","Facilities 2");
           $("#servicesandpriceform-services_f-1-description").attr("placeholder","Facilities3");
           $("#servicesandpriceform-services_f-1-description2").attr("placeholder","Facilities 4");
           $("#servicesandpriceform-services_f-2-description").attr("placeholder","Facilities 5");
           $("#servicesandpriceform-services_f-2-description2").attr("placeholder","Facilities 6");
           $("#servicesandpriceform-services_f-3-description").attr("placeholder", "Facilities 7");
           $("#servicesandpriceform-services_f-3-description2").attr("placeholder","Facilities 8");
         //part two Possibility
           $("#servicesandpriceform-extra_p-0-possibility_check_name").attr("placeholder","Possibility Check 1");
           $("#servicesandpriceform-extra_p-0-possibility_check_name2").attr("placeholder","Possibility Check  2");
           $("#servicesandpriceform-extra_p-1-possibility_check_name").attr("placeholder","Possibility Check 3");
           $("#servicesandpriceform-extra_p-1-possibility_check_name2").attr("placeholder","Possibility Check  4");
           $("#servicesandpriceform-extra_p-2-possibility_check_name").attr("placeholder","Possibility Check  5");
           $("#servicesandpriceform-extra_p-2-possibility_check_name2").attr("placeholder","Possibility Check  6");
           $("#servicesandpriceform-extra_p-3-possibility_check_name").attr("placeholder", "Possibility Check  7");
           $("#servicesandpriceform-extra_p-3-possibility_check_name2").attr("placeholder","Possibility Check  8");

            j=0;
  $(".multiple-input-list__btn ").mousedown(function(){

    if(j==0){
      j=1;
     $("#servicesandpriceform-services-0-price-disp").attr("id","servicesandpriceform-services-6-price-disp");
     $("#servicesandpriceform-services-0-price-disp").attr("id","servicesandpriceform-services-6-price-disp");
     $("#servicesandpriceform-services-6-price").attr("name", "ServicesAndPriceForm[services][6][Price]");
     $("#servicesandpriceform-services-6-price-disp").attr("name","servicesandpriceform-services-6-price-disp");
     //
     $("#servicesandpriceform-services-0-description").attr("id","servicesandpriceform-services-6-description");
     $("#servicesandpriceform-services-6-description").attr("name", "ServicesAndPriceForm[services][6][Description]");
      $("#servicesandpriceform-services-0-quantity").attr("id","servicesandpriceform-services-6-quantity");
     $("#servicesandpriceform-services-6-quantity").attr("name", "ServicesAndPriceForm[services][0][Quantity]");

  }

});';
$this->registerJs($js);
$zs = '
        $( document ).ready(function() {
         
      $("#id").click(function(){
        
     
         $("#dynamic-form").attr("action", "index.php?r=welcome%2Fnext&id=3&category_id=1");
       });
   });
      ';
$this->registerJs($zs);
