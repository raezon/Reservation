$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
       // events: "?r=event/afficher",
        events:"fetch-event.php",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
               eventAfterRender: function (event, element, view) {
        if(event.title=="Absent"){
        // element.css('color', 'blue');
          element.css('background-color', 'red');
          
        }
         if(event.title=="Available"){

          //   element.css('color', 'blue');
             element.css('background-color', 'green');
             
        }
       
        
          
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
          /*  var title ="présent"
            // prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: 'add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');*/
        },
        
        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) {
           
           // var deleteMsg = confirm("Do you really want to delete?");
            //if (deleteMsg) {
                var title=$(this).text()
                title=title.replace( /\s/g, '')
                var search1= "Absent"
                var search2= "Available"
          
        if(title=="Absent"){
           $(this).css('background-color','green');
           $(this).css('border-color','green');
           $(this).text('Available');
           $.ajax({
            type: "POST",
            url: "delete-event.php",
            data: "&id=" + event.id+"&type=1",
            success: function (response) {
              
              //  if(parseInt(response) > 0) {
              //     $('#calendar').fullCalendar('removeEvents', event.id);
                    //displayMessage("Deleted Successfully");
                    
               // }
            }
        });
        }
         if(title=="Available"){

          //   element.css('color', 'blue');
             $(this).css('background-color','red');
             $(this).css('border-color','red');
                    $(this).text('Absent');
               $.ajax({
                    type: "POST",
                    url: "delete-event.php",
                    data: "&id=" + event.id+"&type=0",
                    success: function (response) {
                      //  if(parseInt(response) > 0) {
                      //     $('#calendar').fullCalendar('removeEvents', event.id);
                            //displayMessage("Deleted Successfully");
                            
                       // }
                    }
                });
             
        }
                    

             
                


          //  }
        }

    });
});

function displayMessage(message) {
        $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}