<?php
error_reporting(0);
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 05/09/2020 - paystack.php
 */
require_once __DIR__ . "/../inc/db.class.php";

//DB::$error_handler = false;
class payment
{
    public function __construct($type)
    {
        switch ($type) {
            case 'paystack':
                $this->paystack();
                break;
            default:
                func::outputJson(func::formatOutPut(false, "Invalid payment api command", array()));
        }
    }
    //random code
    function getCode()
    {
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return $str[rand(0, strlen($str) - 1)].$str[rand(0, strlen($str) - 1)].rand(1111,9999);
    }
    //payment received
    public function paystack()
    {
        //filter vars and assigned
        $input = @file_get_contents("php://input");
        //file_put_contents('ttttttt.txt',$input);
        // Decode it and parse
        $stk = json_decode($input, true);
        //filter input methods
        if (count($stk) < 1) {
            func::outputJson(func::formatOutPut(false, "Payment system not organised. client side", array()));
        }
        //start computations
        $data = $stk['data'];
        $meta = $stk['data']['metadata']['custom_fields'][0];
        $amount = ((int)$data['amount']) / 100;
        $customer_email = $stk['customer']['email'];
        $vpin = $meta['pin'];
        $aextra = $meta['extra'];
        //check if payment gone through
        if ($data['status'] !== 'success') {
            func::outputJson(func::formatOutPut(false, "Payment not successful !", array()));
        }
        //start db communications and confirm pin validations
        $rd_auth = DB::queryOneRow("select * from `rs_auth` where `acode`='$vpin' limit 1");
        if ($rd_auth) {
            //update that has been paid
            $upd = DB::update("rs_auth", array(
                "amethod" => "paystack",
                "astatus" => 1,
                "aamount" => $amount,
                "aextra" => $aextra['xextra'],
                "apemail" => $aextra['xemail']
            ), "acode=%s", $vpin);
            //insert into contestant
            if ($upd) {
                DB::insert("rs_contests", array(
                    "xphone" => $rd_auth["aphone"],
                    "xemail" => $aextra['xemail'],
                    "xname"=>$rd_auth['aname'],
                    "xaid" => $rd_auth['aid'],
                    "xcid" => $rd_auth['acid'],
                    "xcode"=> $this->getCode()
                ));
            }
        }
    }

}