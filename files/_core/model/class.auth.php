<?php
require_once "class.global.php";

class auth extends Global_Methods
{
    public function __construct()
    {}

    // Auth Login
    public function CheckLogin($uid, $password, $con)
    {
        if (!($this->CRMStatus($uid, $con))) {
            return 3;
        }

        $check = $con->prepare("select uid from emplist_acm where email = ? and password = ?");
        $check->bind_param('ss', $uid, $password);
        $check->execute();
        $res = $check->get_result();
        if ($res->num_rows === 1) {
            $rows = $res->fetch_assoc();
            return $rows["uid"];
        }
        return 0;
    }

    public function CRMStatus($email, $con)
    {
        $check = $con->prepare("select status from emplist_acm where email = ? and status = 'active'");
        $check->bind_param('s', $email);
        $check->execute();
        $res = $check->get_result();
        if ($res->num_rows === 1) {
            return true;
        }
        return false;
    }

    //Check Email verification
    public function CheckEmailVerification($uid, $con)
    {
        $check = $con->prepare("select email_confirmed from emplist_acm where uid = ?");
        $check->bind_param('s', $uid);
        $check->execute();
        $res = $check->get_result();
        if ($res->num_rows === 1) {
            $rows = $res->fetch_assoc();
            return $rows["email_confirmed"];
        }
        return 0;
    }

    //add events on DB Journal
    public function UpdateJournal($con, $type, $message, $uid, $date, $updatedBy)
    {
        $ip = $this->GetIpAddress();
        $add = $con->prepare("insert into journal (uid, date, type, message, updatedBy, ip) values (?,?,?,?,?,?)");
        $add->bind_param('ssssss', $uid, $date, $type, $message, $updatedBy, $ip);
        $add->execute();
        return 0;
    }

    private function GenerateUID($name, $email)
    {
        return strtoupper(substr(sha1(md5($name . $email . uniqid())), 0, 15));
    }

    public function GetToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }

        return $token;
    }

    private function CheckDuplicateUser($email, $con)
    {
        $check = $con->prepare("select email from emplist_acm where email = ?");
        $check->bind_param('s', $email);
        $check->execute();
        $duplicate = $check->get_result();
        if ($duplicate->num_rows > 0) {
            return 1;
        }

        return 0;
    }

    /**
     * Get the customer's IP address.
     *
     * @return string
     */
    public function GetIpAddress()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public function __destruct()
    {}
}
