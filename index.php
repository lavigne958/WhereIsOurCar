<?php
require_once "database_access.php";
?>
<!doctype html>
<html lang="en">
<head>
    <title> Where is our car parked ?</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="design.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Where do I park the car</h1>
                <form class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="input-name">Name</label>
                        <input type="text" name="name" class="form-control" id="input-name" aria-describedby="nameHelp" placeholder="Name" required>
                        <div class="invalid-feedback">
                            Please enter you name or nickname, only characteres, no symbols, no numbers,...
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-addr">Street</label>
                        <input type="text" name="street" class="form-control" id="input-steet" aria-describedby="streetHelp" placeholder="Street" required>
                        <div class="invalid-feedback">
                            Please the street name where the car is parked, no number, no symbols, ...
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-city">City</label>
                        <input type="text" name="city" class="form-control" id="input-city" aria-describedby="cityHelp" placeholder="City" required>
                        <div class="invalid-feedback">
                            Please the city name where the car is parked, no number, no symbols, ...
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
        <div class='row last_loc'>
          <div class='col'>
<?php
$loc = load_previous_location();
echo location_to_html($loc);
?>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div id="map"></div>
         </div>
       </div>
     </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            console.log("form not valid");
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                        console.log("form is valid");
                    });
                });
            });
        })();

        function myMap() {
            var street = "<?= $loc["street"];?>";
            var city = "<?= $loc["city"];?>";
            console.log("street: " + street + " city: " + city);
            var mapCanvas = $("#map")[0];
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': street + " " + city + ", France",
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var myOptions = {
                        zoom: 15,
                        center: results[0].geometry.location,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                    }
                    map = new google.maps.Map(mapCanvas, myOptions);

                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                }
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
</body>

</html>
