<?php

/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 08/09/2020 - model.php
 */
class models
{
    static function getContestant($id)
    {
        if ($id === null) return null;
        return DB::queryOneRow("select * from `rs_contests` where `xid`=" . $id . " limit 1");
    }

    static function getCompany($id)
    {
        if ($id === null) return null;
        return DB::queryOneRow("select *, NULL AS cpass, NULL AS curlhook from `rs_company` where `cid`=" . $id . " limit 1");
    }

    static function getAuth($id)
    {
        if ($id === null) return null;
        return DB::queryOneRow("select * from `rs_auth` where `aid`=" . $id . " limit 1");
    }

    static function getVotes($code)
    {
        if ($code === null) return null;
        return DB::query("select * from `rs_votes` where `vcode`='$code'");
    }

    static function getPublicVotes()
    {
        return DB::query("select * from `rs_votes` vt INNER JOIN `rs_contests` cs ON vt.vcode=cs.xcode INNER JOIN  `rs_company` cp ON vt.vcompany=cp.ccode");
    }

    static function getCompanies(){
        return DB::query("select * from `rs_company` ORDER BY cid DESC");
    }
}