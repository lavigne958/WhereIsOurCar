<?php

require_once 'config.php';

function store_new_address($data, $who) {
  global $config;

  $mysqli = mysqli_connect("localhost", $config["user"], $config["passwd"], $config["db"]);

  if (mysqli_connect_errno($mysqli)) {
    echo "Echec de la connection à mysql: " . mysqli_connect_error();
  }

  $store_addr = "insert into voiture ";
  $store_addr .= " (street, city, lat, lng, who)";
  $store_addr .= " values (\"" . $data["street"] . "\", \"" . $data["city"] . "\", 0.0, 0.0, \"" . $who . "\")";

  $res = mysqli_query($mysqli, $store_addr);

  if (!$res) {
    echo "Error when trying to save new location (". $mysqli->errno .") " . $mysqli->error;
  }
}

function store_new_coordonates($data, $who) {
  global $config;

  $mysqli = mysqli_connect("localhost", $config["user"], $config["passwd"], $config["db"]);

  if (mysqli_connect_errno($mysqli)) {
    echo "Echec de la connection à mysql: " . mysqli_connect_error();
  }

  $store_coo = "insert into voiture";
  $store_coo .= " (lat, lng, who)";
  $store_coo .= " values (" . $data["lat"] . ", " . $data["lng"] . ", \"" . $who . "\")";
  echo $store_coo;

  $res = mysqli_query($mysqli, $store_coo);

  if (!$res) {
    echo "Error when trying to save new location (". $mysqli->errno .") " . $mysqli->error;
  }
}

function store_new_location($type, $data, $who) {
  $callback = "store_new_";

  if ($type == "coordonates" || $type == "address") {
    $callback .= $type;

    $callback($data, $who);
  }
}

function load_previous_location() {
    $res = "";
    global $config;

    $mysqli = mysqli_connect("localhost", $config["user"], $config["passwd"], $config["db"]);

    if (mysqli_connect_errno($mysqli)) {
      echo "Echec de la connection à mysql: " . mysqli_connect_error();
    }

    $last_pos = "select lat, lng, street, city, who from voiture where id = (select max(id) from voiture)";
    $sql_res = mysqli_query($mysqli, $last_pos);

    if ($row = $sql_res->fetch_assoc()){
        $res = $row;
    }

    echo "fetched from db" . $res;

    return $res;
}


function location_to_html($location) {
    $output = "";

    $output .= "<h3>The car is parked by: ".$location["who"]."</h3>\n";
    $output .= "<p>" . $location["street"] . ", " . $location["city"] . "</p>\n";

    return $output;
}

if (isset($_GET["name"])) {
    $type = "";
    if (!empty($_GET["street"]) && !empty($_GET["city"])) {
      $type = "address";
      $data["street"] = $_GET["street"];
      $data["city"] = $_GET["city"];
    } else if (!empty($_GET["lat"]) && !empty($_GET["lng"])) {
      $type = "coordonates";
      $data["lat"] = $_GET["lat"];
      $data["lng"] = $_GET["lng"];
    }

    if (!empty($type)) {
      store_new_location($type, $data, $_GET["name"]);
    }
}
?>
