$(function () {

  k = 0;
  j = 0;
  $(".multiple-input-list__btn ").mousedown(function () {
    if (j == 0) {
      j = 1;
      $("#servicesandpriceform-services-0-price-disp").attr("id", "servicesandpriceform-services-6-price-disp");
      $("#servicesandpriceform-services-0-price-disp").attr("id", "servicesandpriceform-services-6-price-disp");
      $("#servicesandpriceform-services-6-price").attr("name", "ServicesAndPriceForm[services][6][Price]");
      $("#servicesandpriceform-services-6-price-disp").attr("name", "servicesandpriceform-services-6-price-disp");
      //
      $("#servicesandpriceform-services-0-description").attr("id", "servicesandpriceform-services-6-description");
      $("#servicesandpriceform-services-6-description").attr("name", "ServicesAndPriceForm[services][6][Description]");
      $("#servicesandpriceform-services-0-quantity").attr("id", "servicesandpriceform-services-6-quantity");
      $("#servicesandpriceform-services-6-quantity").attr("name", "ServicesAndPriceForm[services][0][Quantity]");

    }

    $("#servicesandpriceform-services-6-price-disp")
      .keypress(function () {

        var value = $("#servicesandpriceform-services-6-price-disp").val();
        var slicedValue = value.slice(1, value.length - 1)

        $("#servicesandpriceform-services-6-price").attr("value", slicedValue);

      });

    if (k == 0) {
      k = 1;
      $("#productparent-extra-0-price-disp").attr("id", "productparent-extra-6-price-disp");
      $("#productparent-extra-0-price").attr("id", "productparent-extra-6-price");
      $("#productparent-extra-6-price").attr("name", "ProductParent[extra][6][Price]");
      $("#productparent-extra-6-price-disp").attr("name", "productparent-extra-6-price-disp");
      $("#productparent-extra-0-description").attr("id", "productparent-extra-6-description");
      $("#productparent-extra-6-description").attr("name", "ProductParent[extra][6][Description]");

    }
    //Before click
    var value = $("#productparent-extra-6-price-disp").val();
    var slicedValue = value.slice(1, value.length - 1)

    $("#productparent-extra-6-price").attr("value", slicedValue);
    $("#productparent-extra-6-price-disp").keypress(function () {

      var value = $("#productparent-extra-6-price-disp").val();
      var slicedValue = value.slice(1, value.length - 1)

      $("#productparent-extra-6-price").attr("value", slicedValue);

    });
    var h = 0;
    if (h == 0) {
      h = 1;
      $("#productparent-extra-0-price-disp").attr("id", "productparent-extra-6-price-disp");
      $("#productparent-extra-0-price").attr("id", "productparent-extra-6-price");
      $("#productparent-extra-6-price").attr("name", "ProductParent[extra][6][Price]");
      $("#productparent-extra-6-price-disp").attr("name", "productparent-extra-6-price-disp");
      $("#productparent-extra-0-description").attr("id", "productparent-extra-6-description");
      $("#productparent-extra-6-description").attr("name", "ProductParent[extra][6][Description]");
      $("#productparent-extra-0-unit").attr("id", "productparent-extra-6-unit");
      $("#productparent-extra-6-unit").attr("name", "ProductParent[extra][6][Unit]");
      $("#productparent-extra-0-services").attr("id", "productparent-extra-6-services");
      $("#productparent-extra-6-services").attr("name", "ProductParent[extra][6][Services]");
    }
    var m = 0;
    if (m == 0) {
      m = 1;
      $("#generalinformationform-schedule-0-price-disp").attr("id", "generalinformationform-schedule-6-price-disp");
      $("#generalinformationform-schedule-0-price").attr("id", "generalinformationform-schedule-6-price");
      $("#generalinformationform-schedule-6-price").attr("name", "GeneralInformationForm[schedule][6][Price]");
      $("#generalinformationform-schedule-0-price-disp").attr("name", "productparent-extra-6-price-disp");
      $("#generalinformationform-schedule-0-country").attr("id", "generalinformationform-schedule-6-country");
      $("#generalinformationform-schedule-6-country").attr("name", "GeneralInformationForm[schedule][6][Country]");
      $("#generalinformationform-schedule-0-city").attr("id", "generalinformationform-schedule-6-city");
      $("#generalinformationform-schedule-6-city").attr("name", "GeneralInformationForm[schedule][6][City]");

    }

    $("#generalinformationform-schedule-6-price")
      .keypress(function () {

        var value = $("#generalinformationform-schedule-6-price").val();
        var slicedValue = value.slice(1, value.length - 1)
        $("#generalinformationform-schedule-6-price").attr("value", slicedValue);

      });

  });
  $('#other_s').attr('disabled', 'disabled');
  $('#other_m').attr('disabled', 'disabled');
  $('#other_c').attr('disabled', 'disabled');
  //modalButton Branches
  /*$('#modalButton').click(function() {
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });*/

  //$('.close').click(function() { }
  $('#servicesandpriceform-produit_option').click(function () {

    var dropdown_room_rental1 = $(this).val();
    var dropdown_room_rental = $('#servicesandpriceform-produit_option').html()

    var length = $('#servicesandpriceform-produit_option')
      .children('option')
      .length - 2;

    /*  if(dropdown_room_rental1=="Other")
        {

            $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));

        }	*/
    $(document).on('hide.bs.modal', '#modal', function () {

      $("#servicesandpriceform-produit_option")[0].selectedIndex = 0;
      //Do stuff here
    });
  });
  $('#servicesandpriceform-produit_nom').click(function () {

    var dropdown_room_rental1 = $(this).val();

    var length = $('#servicesandpriceform-produit_nom')
      .children('option')
      .length - 2;
    //alert(length)
    /*   if(dropdown_room_rental1=="Other")
        {
            $('#modal2').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        }*/
    $(document).on('hide.bs.modal', '#modal2', function () {
      $("#servicesandpriceform-produit_nom")[0].selectedIndex = 0;
      //Do stuff here
    });
  });

  $('#other_f').click(function () {});

  $(document).on('click', '.fc-day', function () {
    var date = $(this).attr('data-date');
    var category = $("#category_id_id").val();
    $.get('index.php?r=event/create', {
      'date': date,
      'category_id': category
    }, function (data) {

      $('.modal')
        .modal('show')
        .find('#modalContent')
        .html(data);
    });
  });
  $(document).on('click', '.fc-title', function () {

    var string1 = $(this).text();
    //alert(string1)

    var date = string1.split('/')[1];
    var category = $("#category_id_id").val();
    //alert(date); var category = $("#category_id_id").val();
    $.get('index.php?r=event/create1', {
      'date': date,
      'category_id': category
    }, function (data) {
      location.reload(true);
      //location.reload(true);
      /* $.ajax({
             url:"index.php?r=event/calendar",
             method:"POST",
             data:{},
             success:function(data)
             {
              $('#calendar').html(data);
             }
            }) */

    });

  });
  ///caterss and securité and transport

  $('#productitem-0-name').click(function () {

    var dropdown_room_rental1 = $(this).val();
    var dropdown_room_rental = $('#productitem-0-name').html()
    var length = $('#productitem-0-name')
      .children('option')
      .length - 1;

    /* if(dropdown_room_rental1=="Other")
        {


            $('#modal2').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));

        }*/

    $(document).on('hide.bs.modal', '#modal2', function () {

      $("#productitem-0-name")[0].selectedIndex = 0;
      //Do stuff here
    });
  });
  var myInterval = setInterval(function () {
    for (var i = 1; i < 4; i++) {
      $('#productitem-' + i + '-name')
        .click(function () {

          var dropdown_room_rental1 = $(this).val();

          var dropdown_room_rental = $('#productitem-' + i + '-name').html()
          var length = $('#productitem-' + i + '-name')
            .children('option')
            .length - 1;

          /* if(dropdown_room_rental1=="Other")
        {


            $('#modal2').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));

        }*/

          $(document).on('hide.bs.modal', '#modal2', function () {

            $('#productitem-' + i + '-name')[0].selectedIndex = 0;
            clearInterval(myInterval);
            close();
          });
        });
    }
  }, 300);

  //submiting for modal add new option
  /*		$(document).on('click', '#save_other_option', function(){


        var date = $("#other").val();
        var id_step = $("#category_id").val();
        var id_category = $("#step_id").val();
        var partner_id = $("#partner_id").val();
        var type = 0;

        $.get('index.php?r=welcome/other', {'other' : date,'id':id_step,'category_id':id_category,'partner_id':partner_id,'type':type}, function(data){
            location.reload(true);

        });
    });*/
  //submiting for modal add new type
  /*$(document).on('click', '#save_other_type', function(){

        var date = $("#other_type").val();
        var id_step =  $("#step_id").val();
        var id_category =$("#category_id").val();
        var partner_id = $("#partner_id").val();
        var type = 1;
    $.get('index.php?r=welcome/other', {'other' : date,'id':id_step,'category_id':id_category,'partner_id':partner_id,'type':type}, function(data){
         location.reload(true);

        });
    });*/
  //submiting for modal add new security
  /*$(document).on('click', '#save_other_type_1', function(){

        var date = $("#other_type_1").val();
        var id_step =  $("#step_id_1").val();
        var id_category =$("#category_id_1").val();
        var partner_id = $("#partner_id_1").val();
        var type = 1;
    $.get('index.php?r=welcome/other', {'other' : date,'id':id_step,'category_id':id_category,'partner_id':partner_id,'type':type}, function(data){
         location.reload(true);

        });
    });*/
  //
  $(".dynamicform_wrapper").on("beforeInsert", function (e, item) {
    console.log("beforeInsert");
  });

  $(".dynamicform_wrapper").on("afterInsert", function (e, item) {
    console.log("afterInsert");
  });

  $(".dynamicform_wrapper").on("beforeDelete", function (e, item) {
    if (!confirm("Are you sure you want to delete this item?")) {
      return false;
    }
    return true;
  });

  $(".dynamicform_wrapper").on("afterDelete", function (e) {
    console.log("Deleted item!");
  });

  $(".dynamicform_wrapper").on("limitReached", function (e, item) {
    alert("Limit reached");
  });

});