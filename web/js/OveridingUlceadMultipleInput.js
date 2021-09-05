$(function(){	
  //for adding the label km to the checkbox of the second step of the multipleinput
  $('div.field-generalinformationform-schedule-0-distance.form-group div.checkbox').append("<label>0 at 30 Km</label>");
  $('div.field-generalinformationform-schedule-1-distance.form-group div.checkbox').append("<label>30 at 60 Km</label>");
  $('div.field-generalinformationform-schedule-2-distance.form-group div.checkbox').append("<label>60 at 100 Km</label>");
  //Value checkbox
  $('#generalinformationform-schedule-0-distance').val("0 at 30");
  $('#generalinformationform-schedule-1-distance').val("30 at 60");
  $('#generalinformationform-schedule-2-distance').val("60 at 100</label>");	     


});