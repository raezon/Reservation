<?php
$rules = <<< JS
//Regles sur les periode de temps
$(document).ready(function(){
  $("#servicesandpriceform-ouverturefermuture-0-period1-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period1-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period2-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period2-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period3-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period3-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period4-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period4-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period5-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period5-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-0-period6-disp").prop("type", "time");
  $("#servicesandpriceform-ouverturefermuture-1-period6-disp").prop("type", "time");
  //required
 // $('[name="servicesandpriceform-ouverturefermuture-0-period1-disp"]').prop('required', true);
 // $('[name="servicesandpriceform-ouverturefermuture-1-period1-disp"]').prop('required', true);
  //$('[name="servicesandpriceform-ouverturefermuture-0-period2-disp"]').prop('required', true);
  //$('[name="servicesandpriceform-ouverturefermuture-1-period2-disp"]').prop('required', true);
  //$('[name="servicesandpriceform-ouverturefermuture-0-period3-disp"]').prop('required', true);
  //$('[name="servicesandpriceform-ouverturefermuture-1-period3-disp"]').prop('required', true);





  let select_cache = null
  var hourDiff=0;
  var previousEnding=-1;
  var nextStart=0;
  for (k = 1; k < 7; k++) {
  var j=0;
  var startDate="";
  var endDate="";
  var response=false;
 // var startDate = $('input[type=time]').valueAsDate;

   i=k
  $("#servicesandpriceform-ouverturefermuture-0-period"+i+"-disp").off('change').change(function(event){
  
    switch ($(this).attr('id')) {
          case "servicesandpriceform-ouverturefermuture-0-period1-disp":
            i=1;
            break;
          case "servicesandpriceform-ouverturefermuture-0-period2-disp":
            i=2;
            break;
          case "servicesandpriceform-ouverturefermuture-0-period3-disp":
            i=3;
            break;
          case "servicesandpriceform-ouverturefermuture-0-period4-disp":
            i=4;
            break;
          case "servicesandpriceform-ouverturefermuture-0-period5-disp":
            i=5;
            break;
          case "servicesandpriceform-ouverturefermuture-0-period6-disp":
            i=6;
            break;
        }
    if (!select_cache) {
        setTimeout(() => {
          
           
            //Getting the previous hour
            if(i>1){
              previousEnding= $(" #servicesandpriceform-ouverturefermuture-0-period"+(i)+"-disp").valueAsDate
              previousEnding = new Date(endDate);
              previousEnding=endDate.getHours()-1;
            }
            //Getting the hour
            startDate =this.valueAsDate
            startDate = new Date(startDate);
            hourD=startDate.getHours()-1;
            //The case of 12 am to do not get a negative value
            if(hourD==-1)
                hourD=startDate.getHours() +1;
                minutesS=startDate.getMinutes()
                nextStart=startDate.getHours() -1;
            //verify that the value of next start >previos neding
            
           
 
              if(nextStart<previousEnding){
                alert("Hours of next period should be bigger than the ending of previous periode")
              }
           

            //clear the cache do to the repition
            select_cache = null
        }, 100)
    }
    select_cache = event
    
})

 

  $(" #servicesandpriceform-ouverturefermuture-1-period"+i+"-disp").off("change").change(function(){
    
    if (!select_cache) {
        setTimeout(() => {
          endDate =this.valueAsDate
          endDate = new Date(endDate);
          hourA=endDate.getHours()-1;
          if(hourA==-1)
              hourA=endDate.getHours()+1;
          minutesA=endDate.getMinutes();
          previousEnding=hourA;
          hourDiff+=hourA-hourD;
          
          if(hourDiff>24){
            var errName = $('div .field-servicesandpriceform-ouverturefermuture-1-period'+i+' .form-group div .help-block .help-block-error') //Element selector
           
            errName.append('Please Hour starting at periode'+i+'should be less than Hour ending of periode'+i); //append information to #name
            errName.attr('style', 'color: red;'); //add a style attribute
            response=true
          }
          if (startDate > endDate) { 
            
              if(endDate>0 && endDate>11 )
                response=true
                //I should do cases get the id li rani fih 
                $('.field-servicesandpriceform-ouverturefermuture-0-period'+i+' div').html('hour start < than hour end') //append information to #name
                alert( $('.field-servicesandpriceform-ouverturefermuture-0-period'+i+' div').html()) //append information to #name)
                $('.field-servicesandpriceform-ouverturefermuture-0-period'+i+' div').attr('style', 'color: red;'); //add a style attribute
              
            }else{
              
                response=false
            }
          
            //clear the cache
            select_cache = null
        }, 100)
    }
    select_cache = event 

    
  });
  }
    $(document).ready(function(){
    $("button#ClickAdd").on('click',function(e){
    //case une heure depart inferieur a date arriver et autre chose
      if(response){
          e.preventDefault()
      }
      //case everything clear  
      else {
          return true
      }   
        
  });
});
  
$("#1").click(function(){
$("#partner-registration-form").toggle();
})
});
JS;