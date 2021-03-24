<?php
require_once "class.global.php";

class gClass extends Global_Methods
{
    public function __construct()
    {}

    //Live Account List
    public function GetLiveAccounts($uid, $con)
    {
        $list = array();
        $get = $con->prepare("select * from liveaccount where userId = ?");
        $get->bind_param('s', $uid);
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                array_push($list, array(
                    "account_type" => $rows["account_type"],
                    "leverage" => $rows["leverage"],
                    "balance" => $rows["Balance"],
                    "equity" => $rows["equity"],
                    "login" => $rows["trade_id"],
                    "date" => $rows["Registered_Date"],
                    "type" => "live",
                    "phonePwd" => $rows["phone_pwd"],
                    "credit" => $rows["credit"],
                ));
            }
        }
        return $list;
    }

    //Demo Account List
    public function GetDemoAccounts($uid, $con)
    {
        $list = array();
        $get = $con->prepare("select * from demoaccount where userId = ?");
        $get->bind_param('s', $uid);
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                array_push($list, array(
                    "account_type" => $rows["account_type"],
                    "leverage" => $rows["leverage"],
                    "balance" => $rows["Balance"],
                    "equity" => $rows["equity"],
                    "login" => $rows["trade_id"],
                    "date" => $rows["Registered_Date"],
                    "type" => "demo",
                    "phonePwd" => $rows["phone_pwd"],
                ));
            }
        }
        return $list;
    }

    //Account types
    public function GetAccountTypeLive($con, $uid)
    {
        $list = array();
        $get = $con->prepare("select * from account_types where ac_type = 'live'");
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                array_push($list, array(
                    "name" => $rows["ac_name"],
                    "min" => $rows["ac_min_deposit"],
                    "max" => $rows["ac_max_deposit"],
                    "leverage" => $rows["ac_max_leverage"],
                ));
            }
        }
        return $list;
    }

    //Account types
    public function GetAccountTypeDemo($con, $uid)
    {
        $list = array();
        $get = $con->prepare("select * from account_types where ac_type = 'demo'");
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                array_push($list, array(
                    "name" => $rows["ac_name"],
                    "min" => $rows["ac_min_deposit"],
                    "max" => $rows["ac_max_deposit"],
                    "leverage" => $rows["ac_max_leverage"],
                ));
            }
        }
        return $list;
    }

    private function GetGroupDetails($con, $name)
    {
        $detail = array("group" => "DEFAULT-USD", "leverage" => 100);
        $get = $con->prepare("select * from account_types where ac_name = ?");
        $get->bind_param('s', $name);
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows === 1) {
            $rows = $result->fetch_assoc();
            $detail["group"] = $rows["ac_group"];
            $detail["leverage"] = $rows["ac_max_leverage"];
        }
        return $detail;
    }

    public function UpdateProfile($con, $number, $address, $state, $city, $country, $zipcode, $uid)
    {
        $update = $con->prepare("update aspnetusers set number = ?, address = ?, state = ?, city = ?, country = ?, zipcode = ? where uid = ?");
        $update->bind_param('sssssss', $number, $address, $state, $city, $country, $zipcode, $uid);
        $update->execute();
        if ($update->affected_rows === 1) {
            return 1;
        }
        return 0;
    }

    public function updatePassword($con, $uid, $password)
    {
        $update = $con->prepare("update emplist_acm set password = ? where uid = ?");
        $update->bind_param('ss', $password, $uid);
        $update->execute();
        if ($update->affected_rows === 1) {
            return "password updated";
        }
        return "unable to update passwod";
    }

    public function ResetPassword($con, $email, $token, $password)
    {
        $time = time();
        $newToken = substr(sha1(uniqid()), 8);
        $update = $con->prepare("update aspnetusers set password = ?, emailToken = ?, email_token_time = ? where emailToken = ? and email = ?");
        $update->bind_param('sssss', $password, $newToken, $time, $token, $email);
        $update->execute();
        if ($update->affected_rows === 1) {
            return 1;
        }
        return 0;
    }

    public function PasswordRestRequest($con, $email)
    {
        $token = $this->GetEmailToken($con, $email);
        $data = array(
            "key" => $this->username,
            "password" => $this->password,
            "email" => $email,
            "token" => $token,
            "subject" => "Password Reset Token",
            "tempID" => $this->password_reset_request,
        );
        $res = $this->MailCurlCall($data, "ResetRequest", $this->mail_url);
        if ($res) {
            return 1;
        }

        return 0;
    }

    public function GetOpenOrders() 
    {
        $data = array(
            "group_a" => "real\\TCM-A-*",
            "group_b" => "real\\TCM-B-*",
        );
        $res = $this->CurlCall($data, "GetOpenPositionsAll", $this->api_url);
        return $res;
    }

    public function GetOrderHistory($con) 
    {
        $list = array();
        $get = $con->prepare("select * from metatradertradehistory where SUBSTR(orderGroupOpen, 6, 5) = 'TCM-A' or SUBSTR(orderGroupClose, 6, 5) = 'TCM-A'");
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()) {
                array_push($list, array(
                    "closePrice" => number_format($rows["closePrice"], 5),
                    "closeTime" => $rows["closeTime"],
                    "openTime" => $rows["openTime"],
                    "cmd" => $rows["cmd"],
                    "symbol" => $rows["symbol"],
                    "comment" => $rows["comment"],
                    "commission" => $rows["commission"],
                    "login" => $rows["login"],
                    "openPrice" => number_format($rows["openPrice"], 5),
                    "orderId" => $rows["orderId"],
                    "sl" => $rows["sl"],
                    "tp" => $rows["tp"],
                    "volumeReal" => $rows["volumeReal"],
                    "pnl" => $rows["pnl"],
                    "positionID" => $rows["positionID"],
                    "deal" => $rows["deal"],
                    "pricePosition" => $rows["pricePosition"],
                    "profitRaw" => $rows["profitRaw"],
                    "volumeClosed" => $rows["volumeClosed"] / 10000,
                    "cCmd" => $rows["cCmd"],
                    "cOrder" => $rows["cOrder"],
                    "cDeal" => $rows["cDeal"],
                    "orderGroupOpen" => substr($rows["orderGroupOpen"], 5),
                    "orderGroupClose" => substr($rows["orderGroupClose"], 5),
                ));
            }
        }
        return $list;
    }

    public function GetProfile($con, $uid) 
    {
        $get = $con->prepare("select * from emplist_acm where uid = ?");
        $get->bind_param('s', $uid);
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows === 1) {
            $rows = $result->fetch_assoc();
            return array("name" => $rows["company_name"], "email" => $rows["email"], "number" => $rows["company_number"], "country" => $rows["country"]);
        }
        return array();
    }

    public function GetOpenTrades() {
        $response = json_decode($this->GetOpenOrders());

        $list = array();
        if (count($list) === 0) {
            array_push($list, array(
                "symbol" => $response[0]->Symbol,
                "position" => ($response[0]->Action === 1 ? (-1 * (($response[0]->Volume))) : (($response[0]->Volume))),
                "unrealized_pl" => $response[0]->Profit,
            ));
        }
        $local = true;
        if ((count($list) >= 0) && (count($response) >= 1)) {
            for ($i = 1; $i < count($response); $i++) {
                for ($j = 0; $j < count($list); $j++) {
                    if ($list[$j]["symbol"] === $response[$i]->Symbol) {
                        $list[$j]["position"] += ($response[$i]->Action === 1 ? (-1 * (($response[$i]->Volume))) : (($response[$i]->Volume)));
                        $list[$j]["unrealized_pl"] += $response[$i]->Profit;
                        $local = false;
                        break;
                    }
                }
                if ($local) {
                    array_push($list, array(
                        "symbol" => $response[$i]->Symbol,
                        "position" => ($response[$i]->Action === 1 ? (-1 * (($response[$i]->Volume))) : (($response[$i]->Volume))),
                        "unrealized_pl" => $response[$i]->Profit,
                    ));
                }
                $local = true;
            }
        }
        return $list;
    }    

    public function GetFundsACM($con) 
    {
        $list = array();
        $get = $con->prepare("select * from fund_acm");
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()) {
                array_push($list, array(
                    "date" => $rows["date"],
                    "amount" => $rows["amount"],
                    "operation" => $rows["operation"],
                ));
            }
        }
        return $list;
    }

    public function GetFundsACMSum($con) 
    {
        $sum = 0;
        $get = $con->prepare("select sum(amount) as sum from fund_acm where operation = 'deposit'");
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_assoc();
            $sum = $rows["sum"];
            if (is_null($sum))
                $sum = 0;
        }
        return $sum;
    }    

    /**
     * Private Methods
     */

    //Get Email Token
    private function GetEmailToken($con, $email)
    {
        $get = $con->prepare("select emailToken from aspnetusers where email = ?");
        $get->bind_param('s', $email);
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows === 1) {
            $rows = $result->fetch_assoc();
            return $rows["emailToken"];
        }
        return 0;
    }

    private function GetDocType($type)
    {
        if ($type === "image/jpeg") {
            return "jpeg";
        } else if ($type === "image/jpg") {
            return "jpg";
        } else if ($type === "image/png") {
            return "png";
        } else if ($type === "application/pdf") {
            return "pdf";
        } else {
            return "";
        }

    }

    public function __destruct()
    {}

}
