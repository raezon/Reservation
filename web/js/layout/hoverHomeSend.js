
var category ='<?php echo $_SESSION["category"]; ?>'
var filter ='<?php echo $_SESSION["category"]; ?>'
if(category){
    document.getElementById(id).src="http://clicangoevent.com//web/img/logos/locationhover.png"
    document.getElementById("locationText").style.color = "#fcb502";
}

function hover(id) {
    
    document.getElementById(id).src="http://clicangoevent.com//web/img/logos/"+id+"hover.png"
    document.getElementById(id+"Text").style.color = "#fcb502";

  
}

function unhover(id) {
    document.getElementById(id).src="http://clicangoevent.com/web/img/logos/"+id+".png"
    document.getElementById(id+"Text").style.color = "#ffffff";
}