<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 05/09/2020 - smshook.php
 */
include "inc/func.php";
//plugins
require("plugins/sms.php");
require("plugins/payment.php");
require("plugins/webapi.php");
require("plugins/uploads.php");
//run sms hits
$raw = explode("/", $_GET['cmd']);
$cmd = @$raw[0];
$type = @$raw[1];
switch ($cmd) {
    case 'sms':
        //sms api
        new sms($type);
        break;
    case 'payment':
        //payment api
        new payment($type);
        break;
    case 'web-api':
        //web api
        new webapi($type);
        break;
    case 'uploads':
        //web api
        new uploads($type);
        break;
    default:
        func::outputJson(func::formatOutPut(false, "Invalid global command type", array()));
        return null;
}