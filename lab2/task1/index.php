<?php
require_once "./config.php";
require "../task2/logger.php";
$logger = new Logger("/tmp/Web-Technologies-II-Lab/task-c.log");
$error = false;

//set up Mysql connection;
$DB = new mysqli(Config::$DBHOST, Config::$DBUSER, Config::$DBPASSWORD, Config::$DBNAME);

if ($DB->connect_error) {
    die("Connection failed: " . $DB->connect_error);
}

//Fill the array of manufacturer IDs and titles (e.g. "33" => "Alfa Romeo")
$manufacturers = array();
$manufacturers_handle = $DB->query("SELECT id, title FROM manufacturers ORDER BY title");

while ($row = $manufacturers_handle->fetch_assoc()) {
    $manufacturers[$row["id"]] = $row["title"];
}

//Fill the array of color IDs and titles (e.g. "19" => "Tumši pelēka" (dark grey)) 
$colors = array();
$colors_handle = $DB->query("select id, title from colors order by title");

while ($row = $colors_handle->fetch_assoc()) {
    $colors[$row["id"]] = $row["title"];
}

//collect and sanitize the current inputs from GET data
$manufacturer = $_GET['manufacturer'] ?? '';
$color = $_GET['color'] ?? '';
$year = $_GET['year'] ?? '';

// Sanitize and validate input
$manufacturer = filter_var($manufacturer, FILTER_VALIDATE_INT);
$color = filter_var($color, FILTER_VALIDATE_INT);
$year = filter_var($year, FILTER_VALIDATE_INT);


//connect to database, make a query, collect results, save it to $results array as objects

if ($manufacturer === false || $color === false || $year === false) {
    $error = true;
} else {
    // Query the database with the input parameters
    $stmt = $DB->prepare(
        "SELECT manufacturers.title AS manufacturer, models.title AS model, COUNT(*) AS count
        FROM manufacturers
        INNER JOIN models ON manufacturer_id = manufacturers.id
        INNER JOIN cars ON cars.model_id = models.id
        WHERE manufacturer_id = ?
        AND color_id = ?
        AND cars.registration_year = ?
        GROUP BY manufacturers.title, models.title
        ORDER BY count DESC"
    );

    $stmt->bind_param("iii", $manufacturer, $color, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    // Collect the query results and save them to $results array as objects.
    $results = [];
    while ($row = $result->fetch_object()) {
        $results[] = $row;
    }
}
$error = "[" . $_SERVER["REMOTE_ADDR"] . "][" . date("c", time()) . "][" . $_SERVER["QUERY_STRING"] . "][" . ($error ? "ERROR" : "OK") . "]\n";
$logger->log($error);

//complete the view file
require "view.php";
