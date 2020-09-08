<?php
//error_reporting(0);

/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 05/09/2020 - sms.php
 */
require_once __DIR__ . "/../inc/db.class.php";

//DB::$error_handler = false;
class sms
{
    public $system_else_output = true;

    public function __construct($type)
    {
        //receive data
        switch ($type) {
            case 'console':
                $this->generateSms();
                break;
            default:
                func::outputJson(func::formatOutPut(false, "Invalid sms api command", array()));
        }
    }

    //sms counter
    public function smsUnitCounter($cUnit)
    {
        $cUnit = (int)$cUnit;
        if ($cUnit === 500) {
            //$this->system_else_output = true;
        }
    }

    //get auth
    public function generateSms()
    {
        $raw_data = explode("/", strtoupper(@$_POST['Body']));
        $raw_body = @$_POST['Body'];
        $raw_country = @$_POST['FromCountry'];
        if (count($raw_data) < 3 && count($_POST) < 2) {
            return;
        }
        $phone = @$_POST['From'];
        $keyword = $raw_data[0];
        $cmd = $raw_data[1];
        $name = $raw_data[2];
        //do db work as keywords determine
        $company = DB::queryOneRow("select * from `rs_company` WHERE `ccode`='$keyword' LIMIT 1");
        if ($company) {
            //company config
            $this->system_else_output = (bool)$company['cbug'];
            //check company sms unit and switch
            $this->smsUnitCounter($company['csms']);
            //check company status
            if ($company['cstatus'] === 0) {
                if ($this->system_else_output) {
                    $dumpSms = "Company associated with (" . $keyword . ") has been disabled on our system";
                    $smsResponse = func::formatXmlOut($dumpSms);
                    func::outputXml($smsResponse);
                }
            }
            //do company config
            $isRedirect = (bool)$company['credirect'];
            if ($isRedirect) {
                $url = $company['curlhook'];
                $urlError = $company['cerrorhook'];
                $data = array('company' => $company['ccode'], 'sms' => array("keyword" => $company['ccode'], "from" => $phone, "body" => $raw_body, "country" => $raw_country, "timestamp" => time(), "localtime" => date("Y-m-d h:i:s a", time())));
                $res = func::callUrl($url, $urlError, $data);
                if ($res && strlen($res) > 0 && strlen($res) <= 150) {
                    if ($this->system_else_output) {
                        $dumpSms = $res;
                        $smsResponse = func::formatXmlOut($dumpSms);
                        func::outputXml($smsResponse);
                    }
                }
            }
            //Register logic
            if ($cmd === 'REG') {
                $auth_code = $company['ccode'] . rand(1111, 9999) . time();
                //check if number not exist for same company
                $chkNum = DB::queryOneRow("select * from `rs_auth` WHERE `aphone`='$phone' AND `acid`=" . $company['cid']);
                if (!$chkNum) {
                    //Insert new auth
                    $insertData = array(
                        "acid" => $company['cid'],
                        "acode" => $auth_code,
                        "aname" => $name,
                        "aphone" => $phone,
                        "aamount" => $company['camount'],
                        "astatus" => 0
                    );
                    $ins = DB::insert("rs_auth", $insertData);
                    if ($ins) {
                        if ($this->system_else_output) {
                            $dumpSms = "Your Auth PIN: " . $auth_code;
                            $smsResponse = func::formatXmlOut($dumpSms);
                            func::outputXml($smsResponse);
                        }
                    }
                } else {
                    //output while number could not vote second times
                    if ($this->system_else_output) {
                        $dumpSms = "Unable to be re-enrolled as phone number duplicates detected";
                        $smsResponse = func::formatXmlOut($dumpSms);
                        func::outputXml($smsResponse);
                    }
                }
            }
            //Vote logic
            if ($cmd === 'VOTE') {
                //explode vote body string
                $raw_vdata = explode("/", strtoupper(@$_POST['Body']));
                if (count($raw_vdata) < 3) {
                    //return nothing
                    return;
                }
                $vkeyword = @$company['ccode'];
                $vcode = @$raw_vdata[2];
                $vsess = @$raw_vdata[3];
                //refuse if session not active
                if ($company['csess'] !== $vsess) {
                    if ($this->system_else_output) {
                        $dumpSms = "Invalid session code for (" . $vcode . ")";
                        $smsResponse = func::formatXmlOut($dumpSms);
                        func::outputXml($smsResponse);
                    }
                    return;
                }
                //check if number not exist for same company
                $chkCont = DB::queryOneRow("select * from `rs_contests` WHERE (`xcode`='$vcode' AND `xcid`=" . $company['cid'] . ") AND `xstatus`=1");
                if ($chkCont) {
                    //check if not voted
                    $confirmVote = DB::queryOneRow("select * from `rs_votes` WHERE `vsess`='$vsess' AND `vphone`='$phone' LIMIT 1");
                    if ($confirmVote) {
                        if ($this->system_else_output) {
                            $dumpSms = "Unable to vote more than the stipulated vote count, thank you";
                            $smsResponse = func::formatXmlOut($dumpSms);
                            func::outputXml($smsResponse);
                        }
                        return;
                    }
                    //Insert new auth
                    $insertData = array(
                        "vcompany" => $vkeyword,
                        "vcode" => $vcode,
                        "vphone" => $phone,
                        "vsess" => $vsess,
                    );
                    $ins = DB::insert("rs_votes", $insertData);
                    if ($ins) {
                        if ($this->system_else_output) {
                            $dumpSms = "Your vote to " . $vcode . " (" . $chkCont['xnick'] . ") was successful";
                            $smsResponse = func::formatXmlOut($dumpSms);
                            func::outputXml($smsResponse);
                        }
                    }
                } else {
                    //output while number could not vote second times
                    if ($this->system_else_output) {
                        $dumpSms = "No contestant associated with (" . $vcode . ") voting code !.";
                        $smsResponse = func::formatXmlOut($dumpSms);
                        func::outputXml($smsResponse);
                    }
                }
            }
        } else {
            //output that phone number is invalid
            if ($this->system_else_output) {
                $dumpSms = "The keyword (" . $keyword . ") is not valid or not recognised";
                $smsResponse = func::formatXmlOut($dumpSms);
                func::outputXml($smsResponse);
            }
        }
    }
}