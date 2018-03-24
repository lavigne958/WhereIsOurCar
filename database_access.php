<?php
function store_new_location($street, $city, $who) {
    //need to check what database to use 
}

function load_previous_location() {
    $res = array();

    $res["who"] = "Alex";
    $res["street"] = "Rue félix faure";
    $res["city"] = "Enghien-les-bains";

    return $res;
}


function location_to_html($location) {
    $output = "";

    $output .= "<h3>The car is parked by: ".$location["who"]."</h3>\n";
    $output .= "<p>" . $location["street"] . ", " . $location["city"] . "</p>\n";

    return $output;
}
?>
