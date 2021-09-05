
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
      
       var length = $('#servicesandpriceform-produit_option').children('option').length-2;
       
        
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

       var length = $('#servicesandpriceform-produit_type').children('option').length-2;
       //alert(length) 
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
		//alert(string1)

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
//submiting for modal add new option
		$(document).on('click', '#save_other_option', function(){

		
		var date = $("#other").val();
		var id_step = $("#category_id").val();
		var id_category = $("#step_id").val();
		var partner_id = $("#partner_id").val();
		var type = 0;

		$.get('index.php?r=welcome/other', {'other' : date,'id':id_step,'category_id':id_category,'partner_id':partner_id,'type':type}, function(data){
			location.reload(true);
			
		});
	});
//submiting for modal add new type
	$(document).on('click', '#save_other_type', function(){

		
		var date = $("#other_type").val();
		var id_step = $("#category_id").val();
		var id_category = $("#step_id").val();
		var partner_id = $("#partner_id").val();
		var type = 1;
	$.get('index.php?r=welcome/other', {'other' : date,'id':id_step,'category_id':id_category,'partner_id':partner_id,'type':type}, function(data){
		 location.reload(true);
			
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