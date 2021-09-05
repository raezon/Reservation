<?php
$script = <<< JS
$(document).ready(function(){
  $("#3").click(function(){
    $("#partner-registration-form2").toggle();
  })
});
JS;
$this->registerJs($script);
//////////////////////////////////////////////////
$script = <<< JS
$(document).ready(function(){
  $("#5").click(function(){
    $("#partner-registration-form3").toggle();
  })
});
JS;
$this->registerJs($script);
/////////////////////////////////////////////////////
$script = <<< JS
$(document).ready(function(){
  $("#4").click(function(){
    $("#form5").toggle();
  })
});
JS;
$this->registerJs($script);
