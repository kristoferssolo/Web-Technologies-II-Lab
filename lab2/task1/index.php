<?php
require_once "./config.php";

header("Content-Type:text/plain");

//TODO: set up Mysql connection;
$DB = new mysqli(Config::$DBHOST, Config::$DBUSER, Config::$DPASSWORD, Config::$DBNAME);

//TODO: Fill the array of manufacturer IDs and titles (e.g. "33" => "Alfa Romeo")
$manufacturers = array();

//TODO: Fill the array of color IDs and titles (e.g. "19" => "Tumši pelēka" (dark grey)) 
$colors = array();


//TODO: collect and sanitize the current inputs from GET data
$year = "";
$manufacturer = "";
$color = "";

//TODO: connect to database, make a query, collect results, save it to $results array as objects
$results = array();

//TODO: complete the view file
require "view.php";
