<?php
/**
 * Common methods and param
 */

class Global_Methods
{
    protected $username = "BridgingFX_Api_2019";
    protected $password = "YXFQdWgZ";
    protected $api_url = "http://vapi.bridgingfx.com/api/mt5manager/";
    protected $mail_url = "http://vapi.bridgingfx.com/api/mail/";

    /**
     * MetaTrader 5 Access
     */
    protected $mt5_login = "1000";
    protected $mt5_password = "Navin@2202";

    /**
     * Mailjet Default param
     */
    protected $send_email = "noreply@bridgingfx.com";
    protected $company_name = "BridgingFX Limited";

    /**
     * Make PHP Curl Method for .net Api call
     */
    public function CurlCall($data, $action, $url)
    {
        $curl = curl_init();
        $data["mt5_login"] = $this->mt5_login;
        $data["mt5_password"] = $this->mt5_password;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url . $action,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }  
    
    public function MailCurlCall($data, $action, $url)
    {
        $curl = curl_init();
        $data["send_email"] = $this->send_email;
        $data["company_name"] = $this->company_name;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url . $action,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /**
     * Get Client Details
     */
    public function GetUserDetails($con, $uid)
    {
        $details = array();
        $get = $con->prepare("select * from emplist_acm where uid = ?");
        $get->bind_param('s', $uid);
        $get->execute();
        $result = $get->get_result();
        if ($result->num_rows === 1) {
            $rows = $result->fetch_assoc();
            $details = array(
                "email" => $rows["email"],
                "number" => $rows["company_number"],
                "name" => $rows["company_name"],
                "country" => $rows["country"],
                "dial_code" => $rows["dial_code"],
                "zipcode" => $rows["zipcode"],
                "address" => $rows["company_address"],
                "state" => $rows["state"],
                "city" => $rows["city"],
            );
        }
        return $details;
    }    
}
