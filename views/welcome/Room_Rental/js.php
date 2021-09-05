<?php
$script = <<< JS
$(document).ready(function(){

});
JS;
$this->registerJs($script);
?>
<?php
$script = <<< JS
$(document).ready(function(){
  $("#2").click(function(){
      $("#partner-registration-form1").toggle();
  
  })
});
JS;
$this->registerJs($script);
?>
<?php
$script = <<< JS
$(document).ready(function(){
  
  $("#3").click(function(){
    $("#partner-registration-form2").toggle();
  })

});
JS;

$this->registerJs($script);
?>
<?php
$script = <<< JS
$(document).ready(function(){
  $("#Facilities_id").hide();
  $('#other_s').click(function() {
  
/*$('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));*/
    
      $("#Facilities_id").toggle();
      
    
  })
  });
JS;
$this->registerJs($script); ?>

<?php
$script = <<< JS
$(document).ready(function(){
  $("#5").click(function(){
    $("#partner-registration-form3").toggle();
  })
});
JS;
$this->registerJs($script); ?>
<?php
$script = <<< JS
$(document).ready(function(){
  $("#4").click(function(){
    $("#form5").toggle();
  })
});
JS;
$this->registerJs($script);
?>

<?php
$script = <<< JS
$(document).ready(function(){
  $("#Possibilities_id").hide();
  $('#other_c').click(function() {
      $("#Possibilities_id").toggle();   
/*$('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));*/

    
  })
  });
JS;
$this->registerJs($script); ?>
<?php
$script = <<< JS
$(document).ready(function(){
  $("#6").click(function(){
    $("#partner-registration-form4").toggle();
  })
});
JS;
$this->registerJs($script); ?>
<?php
$script = <<< JS
$(document).ready(function(){
   $("#field1").hide();
   $("#field2").hide();
   $("#field3").hide();
   $("#field4").hide();
  $("#4").click(function(){
    $("#form5").toggle();
  });
  $("#click1").click(function(){
    $("#field1").toggle();
  });
  $("#click2").click(function(){
    $("#field2").toggle();
  });
  $("#click3").click(function(){
    $("#field3").toggle();
  })
   $("#click4").click(function(){
    $("#field4").toggle();
  })

});
JS;
$this->registerJs($script);
?>

</div>
<?php
$script = <<< JS
$(document).ready(function(){
  $("#Transport_id").hide();
  $('#other_m').click(function() {
    $("#Transport_id").toggle();
/*$('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));*/
    
  })
  });
JS;
$this->registerJs($script); ?>