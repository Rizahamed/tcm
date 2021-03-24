<?php 
//Header Files 
require_once "db_connection.php";

//Class Include
require_once "../model/class.auth.php";
require_once "../model/class.general.php";

// TimeZone
date_default_timezone_set("Asia/Kolkata");

//Default Param
$date = date('y-m-d H:i:s');
$access = false;
$response = array("status" => "error", "message" => "error_request_invalid");
$message = "";
?>