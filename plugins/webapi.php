<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 06/09/2020 - web-api.php
 */
require_once __DIR__ . "/../inc/db.class.php";

//DB::$error_handler = false;

class webapi
{
    public $public_data = array();

    public function __construct($type)
    {
        //before hit confirm out api key
        $ssk = apache_request_headers()['ssk'];
        if ($ssk !== SERVER_SSK) {
            func::outputJson(func::formatOutPut(false, "Invalid ssk or not presents", array()));
        }
        //collect raw/axios input
        $input = @file_get_contents("php://input");
        $this->public_data = json_decode($input, true);
        //$this->public_data = $_POST;
        //receive data
        switch ($type) {
            case 'auth-pin':
                $this->authPIN();
                break;
            case 'update-info':
                $this->updateInfo();
                break;
            default:
                func::outputJson(func::formatOutPut(false, "Invalid web api command", array()));
        }
    }

    //auth pin
    public function authPIN()
    {
        $pin = $this->public_data['pin'];
        if (!$pin) {
            func::outputJson(func::formatOutPut(false, "No valid PIN passed", array()));
        }
        $rd_pin = DB::queryOneRow("select *, NULL AS cpass, NULL AS curlhook from `rs_auth` auth INNER JOIN `rs_company` cp ON `cp`.`cid`=`auth`.`aid` where `auth`.`acode`='$pin'");
        if ($rd_pin) {
            //read user alongside
            $rd_user = DB::queryOneRow("select * from `rs_contests` where `xaid`=" . $rd_pin['aid']);
            //check if available then just login
            if ((int)$rd_pin['astatus'] === 1 && $rd_user) {
                //set internal app to login
                func::setAuthOkay(array("auth" => $rd_pin, "contestant" => $rd_user));
            }
            //dump data out
            func::outputJson(func::formatOutPut(true, "Successful !", array("auth" => $rd_pin, "contestant" => $rd_user)));
        }
        func::outputJson(func::formatOutPut(false, "Invalid PIN number !", array()));
    }

    //update user info
    public function updateInfo()
    {
        //$this->public_data = $_POST;
        if (count($this->public_data) > 3 && $this->public_data['xcode'] !== '') {
            $updated = array(
                "xnick" => $this->public_data["xnick"],
                "xemail" => $this->public_data["xemail"],
                "xstate" => $this->public_data["xstate"],
                "xaddress" => $this->public_data["xaddress"],
                "xcity" => $this->public_data["xcity"],
                "xsocial" => $this->public_data["xsocial"],
                "xquali" => $this->public_data["xquali"],
                "xdob" => $this->public_data["xdob"]
            );
            DB::update("rs_contests", $updated, "xcode=%s", $this->public_data['xcode']);
            func::outputJson(func::formatOutPut(true, "Updated !", $this->public_data));
        }
    }
}