$(function(){
	//modalButton Branches
	$('#modalButton').click(function() {
		$('#modal').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});

<<<<<<< HEAD
	$('#servicesandpriceform-produit_type').click(function() {
	
	    var dropdown_room_rental=$(this).val();
	   
        if(dropdown_room_rental==7)
=======
	$('#servicesandpriceform-produit_option').click(function() {

	    var dropdown_room_rental=$(this).val();
        if(dropdown_room_rental==4)
>>>>>>> amimar/step3
        {
        	$('#modal').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
<<<<<<< HEAD
	
        }
		
	});
	//full-calendar
	$(document).on('click', '.fc-day', function(){	
		var date = $(this).attr('data-date');

		$.get('index.php?r=event/create', {'date' : date}, function(data){
			$('#modal').modal('show')
				.find('#modalContent')
				.html(data);
		});
=======
        }
		
	});

  $('#other_f').click(function() {

    
  });
  


	

	$(document).on('click', '.fc-day', function(){
		
		var date = $(this).attr('data-date');
			$('.modal').modal('show')
		 .find('#modalContent')
		 .html(data);
		/*$.get('index.php?r=event/creat', {'date' : date,'o':''}, function(data){
		
		});*/
>>>>>>> amimar/step3
	});
		$(document).on('click', '#save_other', function(){
		
		var date = $("#other").val();
		var id_step = $("#category_id").val();
		var id_category = $("#step_id").val();

		$.get('index.php?r=welcome/other', {'other' : date,'id':id_step,'category_id':id_category}, function(data){
			location.reload(true);
<<<<<<< HEAD
=======
			$('#servicesandpriceform-produit_option').val()=1;
>>>>>>> amimar/step3
		});
	});

});