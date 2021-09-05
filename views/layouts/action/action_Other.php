<?php
$ls = '
$( document ).ready(function() {
    
  $("ul.pagination  li a ").addClass("page-link");
  var active =$("#namiro1").text() 
  if($("#namiro").text()!="")
  var active =$("#namiro").text()
  
 
  
    
    
    if (active ==1){
      $("ul#tabs  li:nth-child(1) a ").addClass("active");
      $("ul#tabs  li:nth-child(2) a").removeClass("active");
      $("ul#tabs  li:nth-child(3) a").removeClass("active");
    }
    if (active ==2){
      $("ul#tabs  li:nth-child(1) a").removeClass("active");
       $("ul#tabs  li:nth-child(2) a ").addClass("active");
    }
    if (active ==3){
      $("ul#tabs  li:nth-child(1) a").removeClass("active");
      $("ul#tabs  li:nth-child(2) a").removeClass("active");
       $("ul#tabs  li:nth-child(3) a ").addClass("active");
    }
  
   // var elem = $("ul#tabs  li:nth-child(2) a").attr("class");
  
  


   });

 
   function fetch0() {

    var prix = $("input:checkbox:checked").val();
    var active = 0;
    var type_of_room = [];
    var space_for_rent=[];
    var accepts=[];
    var facilities=[];
    var transport;
    var parking;
//getting the second variable Type of room
    $.each($(":checkbox:checked[name=Room]"), function(){
      if($(this).val()!=1)
      type_of_room.push($(this).val());
    });
//getting the third variable space for rebt
  $.each($(":checkbox:checked[name=Space]"), function(){
    if($(this).val()!=1)
    space_for_rent.push($(this).val());
  });
//getting the fourth variable accepts
  $.each($(":checkbox:checked[name=accepts]"), function(){
    if($(this).val()!=1)
    accepts.push($(this).val());
  });
//getting the fifth variable facilities
  $.each($(":checkbox:checked[name=Facilities]"), function(){
    if($(this).val()!=1)
    facilities.push($(this).val());
  });
//geeting the transport value
  transport = $("input:checkbox:checked[name=Transport]").val();
//geeting the parking  value
  parking = $("input:checkbox:checked[name=Parking]").val();
    var elem1 = $("ul#tabs  li:nth-child(1) a").attr("class");
    var elem2 = $("ul#tabs  li:nth-child(2) a").attr("class");
    var elem3 = $("ul#tabs  li:nth-child(3) a").attr("class");
    if (elem1 == "nav-link active") {
      active = 1;
    }
    if (elem2 == "nav-link active") {
      active = 2;
    }
    if (elem3 == "nav-link active") {
      active = 3;
    }
    if (
      elem1 == "nav-link active" ||
      elem2 == "nav-link active" ||
      elem3 == "nav-link active"
    ) {
      $.ajax({
        type: "POST",
        url: "?r=site/active&price=" + prix +"&type_of_room="+type_of_room+"&space_for_rent="+space_for_rent+"&accepts="+accepts+"&facilities="+facilities+"&transport="+transport+"&parking="+parking+"&active=" + active,
        timeout: 5000,
        data: prix,
        dataType: "html",
        beforeSend: function () {
        //  $("#some_pjax_id").html(" ");
         // $("#loaderDiv").show();
        },
        success: function (data) {
          
         // $("#loaderDiv").hide();
          $("#namiro").html(data);
        },
      });
    }
  }
  function fetch3() {
    //i will have 6 paramtere from Room Rental then globally i will use 5 paramtre and declaret them empty
    //creating the 6 variable
    var prix=0;
    var price_array= [];
    var distance=[];


//getting the first variable Prix
    var prix = $("input:checkbox:checked").val();
    if(prix="on")
        prix=0;
//getting the second variable price_array
    $.each($(":checkbox:checked[name=price]"), function(){
      if($(this).val()!=1)
      price_array.push($(this).val());
    });
    $.each($(":checkbox:checked[name=km]"), function(){
      if($(this).val()!=1)
      distance.push($(this).val());
    });

    


//geeting the active element
    var active = 0;
    var elem1 = $("ul#tabs  li:nth-child(1) a").attr("class");
    var elem2 = $("ul#tabs  li:nth-child(2) a").attr("class");
    var elem3 = $("ul#tabs  li:nth-child(3) a").attr("class");
    if (elem1 == "nav-link active") {
      active = 1;
    }
    if (elem2 == "nav-link active") {
      active = 2;
    }
    if (elem3 == "nav-link active") {
      active = 3;
    }
    if (
      elem1 == "nav-link active" ||
      elem2 == "nav-link active" ||
      elem3 == "nav-link active"
    ) {
      
      $.ajax({
        type: "POST",

        url: "?r=site/filter-other&price="+prix+"&Distance="+distance+"&price_array="+price_array+"&active=" + active,
        timeout: 5000,
        data: {price_array:price_array,Distance:distance},
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {
          $("#some_pjax_id").html(" ");
          $("#loaderDiv").show();
        },
        success: function (data) {
          $("#loaderDiv").hide();
          $("#some_pjax_id").html(data);
        },
      });
    }
  }
  
  $(".nav-link").click(function () {
    
    
      setTimeout(function () {
        fetch0();
      }, 1000);
    
   
  });
  $(".page-link").click(function () {
    
    
    setTimeout(function () {
      fetch3();
    }, 1000);
  
 
});

  $("input:checkbox").click(function () {
    fetch3();
  });
';
