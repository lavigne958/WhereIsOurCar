<?php
require_once "database_access.php";
?>
<!doctype html>
<html lang="en">
<head>
    <title>Where is our car parked ?</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="design.css">
</head>
<body>
	<div class="container" id="accordion">
		<div class="card">
			<div class="card-header" id="headingStore">
				<h5 class="mb-0">
					<button class="btn btn-info btn-block" data-toggle="collapse" data-target="#collapseStore" aria-expanded="true"
						aria-controls="collapseStore">Where do I park the car</button>
				</h5>
			</div>
			<div id="collapseStore" class="collapse" aria-labelledby="headingStore" data-parent="#accordion">
				<div class="container">
					<div class="row">
						<div class="col">
							<form class="needs-validation" novalidate>
								<div class="form-group">
									<label for="input-name">Name</label> <input type="text" name="name" class="form-control" id="input-name"
										aria-describedby="nameHelp" placeholder="Name" required>
									<div class="invalid-feedback">Please enter you name or nickname, only characteres, no symbols, no numbers,...</div>
								</div>
								<div class="form-group">
									<label for="input-addr">Street</label> <input type="text" name="street" class="form-control" id="input-steet"
										aria-describedby="streetHelp" placeholder="Street">
									<div class="invalid-feedback">Please the street name where the car is parked, no number, no symbols, ...</div>
								</div>
								<div class="form-group">
									<label for="input-city">City</label> <input type="text" name="city" class="form-control" id="input-city"
										aria-describedby="cityHelp" placeholder="City">
									<div class="invalid-feedback">Please the city name where the car is parked, no number, no symbols, ...</div>
								</div>
								<input type="hidden" name="lat" id="input-lat"> <input type="hidden" name="lng" id="input-lng">
								<button class="btn btn-secondary" type="button" onclick="getPosition()">Refresh location</button>
								<button class="btn btn-primary" type="submit">Save</button>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<iframe height="400px" width="100%" seamless='seamless' frameBorder="0" src="parked_map.html"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingLoad">
				<h5 class="mb-0">
					<button class="btn btn-info btn-block" data-toggle="collapse" data-target="#collapseLoad" aria-expanded="false"
						aria-controls="collapseLoad">Show last stored location</button>
				</h5>
			</div>
			<div id="collapseLoad" class="collapse" aria-labelledby="headingLoad" data-parent="#accordion">
				<div class="container">
					<div class="row">
						<div class="col last_loc">
                <?php
                // $loc = load_previous_location();
                // echo location_to_html($loc);
                ?>
              			</div>
					</div>
					<div class="row">
						<div class="col">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
