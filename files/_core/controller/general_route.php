<?php

/**
 * Route controller Started
 * General Route controllers
 */

if ($requestType === "login") {
    $auth = new auth();
    $general = new gClass();

    $uid = input_data($request->email);
    $pass = input_data($request->password);
    $con = connect_mysql();

    $session_id = $auth->CheckLogin($uid, $pass, $con);

    if ($session_id === 0) {
        $message = "Invalid username or password";
        $response = res_sts("error", $message);
    } else if ($session_id === 3) {
        $message = "Account Disabled";
        $response = res_sts("warning", $message);
    } else {
        if ($auth->CheckEmailVerification($session_id, $con)) {

            $user = $general->GetUserDetails($con, $session_id);
            $_SESSION["acm_uid"] = $session_id;
            $_SESSION["acm_email_id"] = $user["email"];
            $_SESSION["acm_name"] = $user["name"];
            $message = "Login Success";
            $response = res_sts("success", $message);
        } else {
            $message = "Email verification pending";
            $response = res_sts("error", $message);
        }
    }

    //Update Log
    $auth->UpdateJournal($con, "Login", $message, $uid, $date, "ACM System");

    //Add Login notification mail method
    close_mysql($con);
}

if ($requestType === "open_order_list") {
    $general = new gClass();    
    $list = $general->GetOpenOrders();
    $response = res_sts("success", "open_orders", json_decode($list));
}

if ($requestType === "open_order_history_list") {
    $general = new gClass();
    $con = connect_mysql();

    $list = $general->GetOrderHistory($con);
    $response = res_sts("success", "order_history", $list);
    close_mysql($con);
}

if ($requestType === "profile") {
    $general = new gClass();
    $con = connect_mysql();    

    $list = $general->GetProfile($con, $_SESSION["acm_uid"]);
    $response = res_sts("success", "profile", $list);
    close_mysql($con);
}

if ($requestType === "change_password") {
    $password = input_data($request->password);
    $general = new gClass();
    $con = connect_mysql(); 
    
    $message = $general->updatePassword($con, $_SESSION["acm_uid"], $password);
    $response = res_sts("success", $message);
    close_mysql($con);    
}

if ($requestType === "open_order_e") {
    $general = new gClass();
    $list = $general->GetOpenTrades();
    $response = res_sts("success", "orders", $list);
}

if ($requestType === "get_acm_fund_history") {
    $general = new gClass();
    $con = connect_mysql(); 
    
    $list = $general->GetFundsACM($con);
    $response = res_sts("success", "fund history", $list);   
    close_mysql($con);        
}

if ($requestType === "balance") {
    $general = new gClass();
    $con = connect_mysql(); 
    
    $balance = $general->GetFundsACMSum($con);
    $response = res_sts("success", "balance", $balance);   
    close_mysql($con);        
}

?>