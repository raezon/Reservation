<?php 
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager ;
use kartik\tabs\TabsX;
$categoriesNames = [];
echo 
'<style>
.has-star{
  display:none;
  }


</style>';
$_SESSION['active1']= $_SESSION['active'];



   echo '<div style="display:none">'.$_SESSION['active1'].'</div>';
   $ms = '
   $( document ).ready(function() {
    
       
     var active =$("#namiro").text()
     
    
      // var active =<?php echo json_encode($active) ?>;
      $("#namiro1").html(2);
       
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

    
     
   
 
  ';

   $this->registerJs($ms);

  
