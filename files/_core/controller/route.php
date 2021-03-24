<?php
session_start();
require_once "../config/init.php";
require_once "_global_methods.php";

/**
 * Check Request Method
 * Check Session Auth
 * Check POST Data Request
 */

$request_method = $_SERVER['REQUEST_METHOD'];

/**
 *  Check Request Method
 */

if ($request_method !== "POST") {
    $message = "invalid_request_method";
    echo (json_encode(array("status" => "error", "message" => $message)));
    $con = connect_mysql();
    $auth = new auth();
    $auth->UpdateJournal($con, "Direct Route Access", $message, "Request", $date, "ACM System");
    close_mysql($con);
    exit();
}

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

/**
 * Check Any request on Post Method
 */
if (is_null($request)) {
    $requestType = input_data($_POST['request']);
} else {
    $requestType = input_data($request->request);
}

/**
 * Check Request Param is empty or not
 */(isset($requestType) && !empty($requestType) ? $access = true : $access = false);
if (!$access) {
    echo (json_encode(array("status" => "error", "message" => "error_request_invalid")));
    exit();
}

/**
 * Check Session or Request is login call
 */
if (!CheckSession() && ($requestType !== "login") && ($requestType !== "password_rest_request") && ($requestType !== "reset_password_token")) {
    echo (json_encode(array("status" => "error", "message" => "error_auth_invalid")));
    exit();
} else if (($requestType === "login") || ($requestType === "password_rest_request") || ($requestType === "reset_password_token")) {
    $uid = null;
} else if (CheckSession()) {
    $uid = $_SESSION["acm_uid"];
} else {
    echo (json_encode(array("status" => "error", "message" => "error_auth_invalid")));
    exit();
}

/**
 * All Route Start
 */

require_once "general_route.php";

/**
 * All Route End
 */


/**
 * Echo all response from any route
 */
echo json_encode($response);
?>