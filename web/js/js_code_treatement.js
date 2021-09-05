
$(function(){	   
	



  $('#other_s').attr('disabled', 'disabled');
  $('#other_m').attr('disabled', 'disabled');
  $('#other_c').attr('disabled', 'disabled');
	//modalButton Branches
	$('#modalButton').click(function() {
		$('#modal').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});

//$('.close').click(function() {
	

//}
	$('#servicesandpriceform-produit_option').click(function() {

	    var dropdown_room_rental1=$(this).val();
	   var dropdown_room_rental=$('#servicesandpriceform-produit_option').html()
      
       var length = $('#servicesandpriceform-produit_option').children('option').length-1;
      
     
        if(dropdown_room_rental1==length)
        {
        	$('#modal').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
			
        }	
 $(document).on('hide.bs.modal','#modal', function () {
 	
       $("#servicesandpriceform-produit_option")[0].selectedIndex = 0;
 //Do stuff here
});
	});
		$('#servicesandpriceform-produit_type').click(function() {

	   var dropdown_room_rental1=$(this).val();      
       var length = $('#servicesandpriceform-produit_type').children('option').length-1;
        if(dropdown_room_rental1==length)
        {
        	$('#modal2').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
        }
         $(document).on('hide.bs.modal','#modal2', function () {
                $("#servicesandpriceform-produit_type")[0].selectedIndex = 0;
 //Do stuff here
});		
	});

  $('#other_f').click(function() {

    
  });
  
      $(document).on('click', '.fc-day', function(){
		var date = $(this).attr('data-date');
		var category = $("#category_id_id").val();
		$.get('index.php?r=event/create', {'date' : date,'category_id':category}, function(data){
		
		 $('.modal').modal('show')
		 .find('#modalContent')
		 .html(data);
		});
	});
		$(document).on('click', '.fc-title', function(){

		var string1=$(this).text();
		

		var date =  string1.split('/')[1];
		var category = $("#category_id_id").val();
		
		//var category = $("#category_id_id").val();
		$.get('index.php?r=event/create1', {'date' : date,'category_id':category}, function(data){
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
		$(document).on('click', '#save_other', function(){

		
		var date = $("#other").val();
		var id_step = $("#category_id").val();
		var id_category = $("#step_id").val();

		$.get('index.php?r=welcome/other', {'other' : date,'id':id_step,'category_id':id_category}, function(data){
			location.reload(true);
			$('#servicesandpriceform-produit_option').val()=1;
		});
	});
		//
		$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
		

});