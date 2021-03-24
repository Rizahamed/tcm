<?php
/**
 * General Functions
 */
function CheckSession()
{
    if (isset($_SESSION["acm_uid"]) && !empty($_SESSION["acm_uid"])) {
        return true;
    }
    return false;
}

function res_sts($sts, $message, $data = array())
{
    return array("status" => $sts, "message" => $message, "data" => $data);
}

function input_data($data)
{
    if (is_numeric($data) || is_bool($data)) {
        return $data;
    }

    if (empty($data) || !isset($data)) {
        $data = "";
    }
    $data = htmlspecialchars($data);
    $data = stripslashes($data);    
    $data = trim($data);
    return $data;
}
