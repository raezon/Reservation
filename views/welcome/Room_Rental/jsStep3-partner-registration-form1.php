<?php
$script = <<< JS
$(document).ready(function(){
  $("#2").click(function(){
    $("#partner-registration-form1").toggle();
  })
});
JS;
$this->registerJs($script);
