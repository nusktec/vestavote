<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 08/09/2020 - upload.php
 */
require_once __DIR__ . "/../inc/db.class.php";

//DB::$error_handler = false;
class uploads
{
    public $public_data = array();

    public function __construct($type)
    {
        //before hit confirm out api key
        $ssk = apache_request_headers()['ssk'];
        if ($ssk !== SERVER_SSK) {
            func::outputJson(func::formatOutPut(false, "Invalid ssk or not presents", array()));
        }
        $this->public_data = $_POST;
        //receive data
        switch ($type) {
            case 'profile-dp':
                $this->dpUploads();
                break;
            default:
                func::outputJson(func::formatOutPut(false, "Invalid uploads api command", array()));
        }
    }

    //dp uploads
    function dpUploads()
    {
        $uploads_dir = __DIR__ . '/../uploads';
        $company = $this->public_data['xcid'];
        //check if file exist or create
        if (!file_exists($uploads_dir . "/" . $company)) {
            //create folder
            mkdir($uploads_dir . "/" . $company, 0777, true);
        }
        //check if user available
        if (!DB::queryOneRow("select * from `rs_contests` where `xcode`='" . $this->public_data['xcode'] . "' limit 1")) {
            func::outputJson(func::formatOutPut(false, "Uploads wasn't successful, no user account", array()));
        }
        //do move
        if ($_FILES["file-image"]["error"] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["file-image"]["tmp_name"];
            // basename() may prevent filesystem traversal attacks;
            $file_name_tmp = $uploads_dir . "/" . $company . "/" . $this->public_data['xcode'] . ".jpg";
            // further validation/sanitation of the filename may be appropriate
            move_uploaded_file($tmp_name, $file_name_tmp);
            //run permission
            chmod($uploads_dir, 0777);
            chmod($file_name_tmp, 0777);
            //update the image set in the db
            DB::update("rs_contests", array("ximage" => 1), "xcode=%s", $this->public_data['xcode']);
            //output rubbish
            func::outputJson(func::formatOutPut(true, "Uploads was successful !", array()));
        } else {
            func::outputJson(func::formatOutPut(false, "Unable to upload pictures...", array()));
        }
    }
}