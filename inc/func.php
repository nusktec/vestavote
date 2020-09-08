<?php
session_start();
//declare constant
const BASE_URL = "https://apply.reedax.com";
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 05/09/2020 - functions.php
 */
class func
{
    static function callUrl($curl, $errorUrl, $data)
    {
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($curl, false, $context);
        if ($result === FALSE) { /* Handle error */
            file_get_contents($errorUrl . "?error=Unable to delivered a message from " . $data['from'] . " using your supplied post url. see message body: " . $data['body'] . "--------as at " . time());
            return false;
        }
        return $result;
    }

    static function formatXmlOut($data)
    {
        return "<Response>
               <Message>" . $data . "</Message>
               </Response>";
    }

    static function formatOutPut($status, $msg, $data)
    {
        return array("status" => $status, "msg" => $msg, "data" => $data);
    }

    static function outputJson($data)
    {
        header("Content-Type: application.json");
        exit(json_encode($data));
    }

    static function outputXml($data)
    {
        header("Content-Type: text/xml");
        exit($data);
    }

    static function doNull($data, $def)
    {
        if (!$data || empty($data) || $data === "") {
            return $def;
        }
        return $data;
    }

    static function getTitle()
    {
        return self::doNull($_SESSION['title'], 'No Title');
    }

    static function setTitle($title)
    {
        $_SESSION['title'] = $title;
    }

    //auth login session
    static function checkAuthOkay()
    {
        return self::doNull($_SESSION['authOkay'], null);
    }

    static function setAuthOkay($data)
    {
        $_SESSION['authOkay'] = $data;
    }

    //auth user login
    static function setAuthUser($data)
    {
        $_SESSION['authUser'] = $data;
    }

    static function checkAuthUser()
    {
        return self::doNull($_SESSION['authUser'], null);
    }
}