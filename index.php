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
    <div class="container" id="accordion">
        <div class="card">
            <div class="card-header" id="headingStore">
                <h5 class="mb-0">
                    <button class="btn btn-info btn-block" data-toggle="collapse" data-target="#collapseStore" aria-expanded="true" aria-controls="collapseStore">
                        Where do I park the car
                    </button>
                </h5>
            </div>
            <div id="collapseStore" class="collapse" aria-labelledby="headingStore" data-parent="#accordion">
                <div class="container">
                    <div class="row">
                        <div class="col">
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
                                    <input type="text" name="street" class="form-control" id="input-steet" aria-describedby="streetHelp" placeholder="Street">
                                    <div class="invalid-feedback">
                                        Please the street name where the car is parked, no number, no symbols, ...
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-city">City</label>
                                    <input type="text" name="city" class="form-control" id="input-city" aria-describedby="cityHelp" placeholder="City">
                                    <div class="invalid-feedback">
                                        Please the city name where the car is parked, no number, no symbols, ...
                                    </div>
                                </div>
                                <input type="hidden" name="lat" id="input-lat">
                                <input type="hidden" name="lng" id="input-lng">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="locate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingLoad">
                <h5 class="mb-0">
                    <button class="btn btn-info btn-block" data-toggle="collapse" data-target="#collapseLoad" aria-expanded="false" aria-controls="collapseLoad">
                        Show last stored location
                    </button>
                </h5>
            </div>
            <div id="collapseLoad" class="collapse" aria-labelledby="headingLoad" data-parent="#accordion">
                <div class="container">
                    <div class="row">
                        <div class="col last_loc">
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
            </div>
        </div>
    </div>
    <script>
    var newPos;

    function isLocationFound() {
      return 'lat' in newPos && 'lng' in newPos;
    }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false && !isLocationFound()) {
                        console.log("form not valid");
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    $("#input-lat").val(newPos.lat);
                    $("#input-lng").val(newPos.lng);

                    form.classList.add('was-validated');
                    console.log("form is valid");
                });
            });
        });
    })();

    function myMap() {
        var street = "<?= ($loc["street"])?$loc["street"]: "";?>";
        var city = "<?= ($loc["city"])?$loc["city"]:"";?>";
        var lat = <?= ($loc["lat"])?$loc["lat"]:0;?>;
        var lng = <?= ($loc["lng"])?$loc["lng"]:0;?>;

        var geocodeOptions;

        if (lat != 0 && lng != 0) {
          geocodeOptions = {
            'location': {
              'lat': lat,
              'lng': lng
            },
          };
        } else {
          geocodeOptions = {
            'address': street + " " + city + ", France",
          };
        }

        var mapCanvas = $("#map")[0];
        geocoder = new google.maps.Geocoder();
        geocoder.geocode(geocodeOptions, function(results, status) {
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

        var map = new google.maps.Map($("#locate")[0], {
            center: {lat: 48.966980, lng: 2.314853},
            zoom: 15
        });

        var infoWindow = new google.maps.InfoWindow({map: map});

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                newPos = pos;

                infoWindow.setPosition(pos);
                infoWindow.setContent("Car position");
                map.setCenter(pos);
            }, function() {
                console.log("dunno");
            })
        } else {
            alert("FAIL, you have no geolocation");
        }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARwG851bxKo9ceMcC3WRLYvYHSRXaXB7M&callback=myMap"></script>
</body>

</html>
