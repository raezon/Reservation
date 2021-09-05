<?php
$ms = '
$( document ).ready(function() {

$("ul.pagination li a ").addClass("page-link");
var active =$("#namiro1").text()
if($("#namiro").text()!="")
var active =$("#namiro").text()

if (active ==1){
$("ul#tabs li:nth-child(1) a ").addClass("active");
$("ul#tabs li:nth-child(2) a").removeClass("active");
$("ul#tabs li:nth-child(3) a").removeClass("active");
}
if (active ==2){
$("ul#tabs li:nth-child(1) a").removeClass("active");
$("ul#tabs li:nth-child(2) a ").addClass("active");
}
if (active ==3){
$("ul#tabs li:nth-child(1) a").removeClass("active");
$("ul#tabs li:nth-child(2) a").removeClass("active");
$("ul#tabs li:nth-child(3) a ").addClass("active");
}

// var elem = $("ul#tabs li:nth-child(2) a").attr("class");




});



function fetch4(sort) {
var filter=$("#browser").val();

//geeting the active element
var active = 0;
var elem1 = $("ul#tabs li:nth-child(1) a").attr("class");
var elem2 = $("ul#tabs li:nth-child(2) a").attr("class");
var elem3 = $("ul#tabs li:nth-child(3) a").attr("class");
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

url: "?r=site/sort&filter=" + filter+"&sort="+sort,

data: {filter:filter,sort:sort},
contentType: "application/json; charset=utf-8",
beforeSend: function () {
$("#some_pjax_id").html(" ");
// $("#loaderDiv").show();
},
success: function (data) {

// $("#loaderDiv").hide();
$("#some_pjax_id").html(data);
},
});
}
}




$(" #ascending").click(function () {
var sort=$("#ascending").val();
fetch4(sort);
});
$("#desending").click(function () {
var sort=$("#desending").val();
fetch4(sort);
});
';
