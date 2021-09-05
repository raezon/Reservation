<!DOCTYPE html>
<html>

<head>
    <title>Add Map</title>

    <style type="text/css">
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>
    <script>
      
        //the maps api is setup above
        window.onload = function() {

            var lat = <?php echo json_encode($latitude); ?>;
                                        var lng = <?php echo json_encode($longitude); ?>;
            var latlng = new google.maps.LatLng(lat, lng); //Set the default location of map

            var map = new google.maps.Map(document.getElementById('map'), {

                center: latlng,

                zoom: 11, //The zoom value for map

                mapTypeId: google.maps.MapTypeId.ROADMAP

            });

            var marker = new google.maps.Marker({

                position: latlng,

                map: map,

                title: 'Place the marker for your location!', //The title on hover to display

                draggable: true //this makes it drag and drop

            });

            google.maps.event.addListener(marker, 'dragend', function(a) {

                console.log(a);

                document.getElementById('loc').value = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4); //Place the value in input box



            });

        };
    </script>
</head>

<body>
    <h3> </h3>
    <!--The div element for the map -->
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7Iz5ZKGr0_5l_LD47xNf9umU7GSiUVuw&callback=initMap" async defer></script>
</body>

</html>