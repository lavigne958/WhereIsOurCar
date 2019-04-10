<?php
require_once 'database_access.php';

$prev = load_previous_location();

if (isset($prev["lat"]) && isset($prev["lng"])) {
    echo json_encode($prev);
} else if (isset($prev["street"]) && isset($prev["city"])) {
    echo json_encode($prev);
} else {
    return "";
}
?>