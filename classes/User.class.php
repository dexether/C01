<?php

/* * ****************************************************************************
 * User.class.php
 *
 * @description
 * Description goes here
 *
 *
 * **************************************************************************** */

function UsertradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

class User {
    /*     * **************************************************************************
     * ATTRIBUTES                                                                *
     * ************************************************************************** */

    var $userid;
    var $username;
    var $aecodeid;
    var $password; // In MD5 Format
    var $groupid;
    var $group_description;
    var $credit;
    var $lastlogin;
    var $lastactivity;
    var $countertype; // Array
    var $countertype_user; // Array
    var $tradingtype; // AccNo / AeCode //BranchCode //SelectBranch
    var $isadmin;
    var $issupervisor;
    var $ismanager;
    var $isamanger;
    var $lockingid;
    var $companygroup;
    var $viewtype;
    var $userfield_aecode;
    var $userfield_branch;
    var $userfield_group;
    var $aename;
    var $aenametengah;
    var $aenameakhir;
    var $html;

    /*     * **************************************************************************
     * CONSTRUCTOR                                                               *
     * ************************************************************************** */

    function User($userid = "") {
        if (!empty($userid)) {
            $this->userid = $userid;
        }
    }

    /*     * **************************************************************************
     * METHODS                                                                   *
     * ************************************************************************** */

    function setAeName($aename) {
        $this->aename = $aename;
    }

    function getAeName() {
        return $this->aename;
    }

    function setAeNameTengah($aenametengah) {
        $this->aenametengah = $aenametengah;
    }

    function getAeNameTengah() {
        return $this->aenametengah;
    }

    function setAeNameAkhir($aenameakhir) {
        $this->aenameakhir = $aenameakhir;
    }

    function getAeNameAkhir() {
        return $this->aenameakhir;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }

    function getUserid() {
        return $this->userid;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function getUsername() {
        return $this->username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getPassword() {
        return $this->password;
    }

    function setGroupid($groupid) {
        $this->groupid = $groupid;
    }

    function getGroupid() {
        return $this->groupid;
    }

    function setUserfield_aecode($userfield_aecode) {
        $this->userfield_aecode = $userfield_aecode;
    }

    function getUserfield_aecode() {
        return $this->userfield_aecode;
    }

    function setUserfield_branch($userfield_branch) {
        $this->userfield_branch = $userfield_branch;
    }

    function getUserfield_branch() {
        return $this->userfield_branch;
    }

    function setUserfield_group($userfield_group) {
        $this->userfield_group = $userfield_group;
    }

    function getUserfield_group() {
        return $this->userfield_group;
    }

    function setGroup_description($group_description) {
        $this->group_description = $group_description;
    }

    function getGroup_description() {
        return $this->group_description;
    }

    function setCredit($credit) {
        $this->credit = $credit;
    }

    function getCredit() {
        return $this->credit;
    }

    function setLockingid($lockingid) {
        $this->lockingid = $lockingid;
    }

    function getLockingid() {
        return $this->lockingid;
    }

    function setCompanygroup($companygroup) {
        $this->companygroup = $companygroup;
    }

    function getCompanygroup() {
        return $this->companygroup;
    }

    function setViewtype($viewtype) {
        $this->viewtype = $viewtype;
    }

    function getViewtype() {
        return $this->viewtype;
    }

    function setCounterType_User($countertype_user) {
        $this->countertype_user = $countertype_user;
    }

    function getCounterType_User() {
        return $this->countertype_user;
    }

    function setCounterType($countertype) {
        $this->countertype = $countertype;
    }

    function getCounterType() {
        return $this->countertype;
    }

    function fetch() { // Fetch user from database
        if (empty($this->userid) && empty($this->username)) {
            echo "User.class.php: userid and username are both empty";
        }
        if (!empty($this->userid)) {
            $where = " userid = '$this->userid' ";
        } elseif (!empty($this->username)) {
            $where = " username = '$this->username' ";
        }
        $query = "";


        global $DB;
        $query = "SELECT
                client_aecode.aecodeid, user.*, group.isadmin, group.issupervisor, group.ismanager,
                group.description AS group_description
                FROM user,`group`, client_aecode
                WHERE  user.groupid = group.groupid
                AND user.username = client_aecode.aecode
                and
                $where";
        //echo "$query";
        $rows = $DB->execresultset($query);
        $adadata = "no";
        //UsertradeLog("User.class.php-216:" . $query);
        foreach ($rows as $row) {
            $adadata = "yes";
            //UsertradeLog("User.class.php-219-UserId:" . $row[userid]);
            $this->userid = $row['userid'];
            $this->aecodeid = $row['aecodeid'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->groupid = $row['groupid'];
            $this->lastlogin = $row['lastlogin'];
            $this->lastactivity = $row['lastactivity'];
            $this->group_description = $row['group_description'];
            $this->companygroup = $row['companygroup'];

            if ($row['groupid'] == '3') {
                $query2 = "SELECT client_aecode.name,client_aecode.nametengah,
                client_aecode.nameakhir,
                user.*, group.isadmin, group.issupervisor, group.ismanager,
                group.description AS group_description
                FROM user,client_aecode,`group`
                WHERE user.username = client_aecode.aecode
                AND user.groupid = group.groupid
                and
                $where";
                $rows2 = $DB->execresultset($query2);
                $adadata = "no";
                //UsertradeLog("User.class.php-250:" . $query2);
                foreach ($rows2 as $row2) {
                    $this->aename = $row2['name'];
                    $this->aenametengah = $row2['nametengah'];
                    $this->aenameakhir = $row2['nameakhir'];
                }
            }//if ($row['groupid'] == '3') {

            if (!empty($row['countertype'])) {
                $countertypes = explode(",", $row['countertype']);
            } else {
                $countertypes = "";
            }
            $this->countertype = $countertypes;

            if (!empty($row['countertype_user']) || $row['countertype_user'] != null) {
                $countertypes_user = explode(",", $row['countertype_user']);
            } else {
                $countertypes_user = $countertypes;
            }
            $this->countertype_user = $countertypes_user;

            switch ($this->groupid) {
                case "1":
                    $this->tradingtype = "AccNo";
                    break;
                case "3":
                    $this->tradingtype = "AeCode";
                    break;
                case "11":
                    $this->tradingtype = "Group";
                    break;
                case "12":
                    $this->tradingtype = "GroupSelect";
                    break;
            }

            $query3 = "SELECT fieldname, fieldvalue FROM userfield WHERE userid = '$this->userid'";
            $rows3 = $DB->execresultset($query3);
            //UsertradeLog("User.class.php-288:" . $query3);
            foreach ($rows3 as $row3) {
                if ($row[fieldname] == 'aecode') {
                    $this->userfield_aecode = $row['fieldvalue'];
                }
                if ($row['fieldname'] == 'branch') {
                    $this->userfield_branch = $row['fieldvalue'];
                }
                if ($row['fieldname'] == 'group') {
                    $this->userfield_group = $row['fieldvalue'];
                }
            }//foreach ($rows3 as $row3) {

            return true;
        }//foreach ($rows as $row) {
        if ($adadata == "no") {
            return false;
            exit;
        }
    }

//function fetch() {

    function resetLastActivity() {
        $query = "UPDATE user SET lastactivity = (NOW()-15) WHERE userid = '$this->userid'";
        global $DB;
        $DB->execonly($query);
    }

    function updateLastActivity() {
        $query = "UPDATE user SET lastactivity = NOW() WHERE userid = '$this->userid'";
        global $DB;
        $DB->execonly($query);
    }

    function updateLastLogin() {
        $query = "UPDATE user SET lastlogin = NOW(),fromip = '$_SERVER[REMOTE_ADDR]',frommachine = '$_SERVER[HTTP_REFERER]' WHERE userid = '$this->userid'";
        global $DB;
        $DB->execonly($query);
    }

    function isActive() { // Checks whether user is still active to prevent multiple logins
        $query = "SELECT (NOW()-lastactivity) as lastactivitylapse FROM user WHERE userid = '$this->userid'";
        global $DB;
        $rows = $DB->execresultset($query);
        $adadata = "no";
        foreach ($rows as $row) {
            $adadata = "yes";
            if ($row['lastactivitylapse'] < 15) {
                return true;
            } else {
                return false;
            }
        }
    }

    function isExpired() { // Checks whether user is expired
        $query = "SELECT * FROM user WHERE userid = '$this->userid' and login_end < NOW()";
        global $DB;
        $rows = $DB->execresultset($query);
        $adadata = "no";
        foreach ($rows as $row) {
            $adadata = "yes";
        }
        if ($adadata == "no") {
            return false;
            exit;
        } else {
            return true;
        }
    }

    function checkPassword($password = "") { // [+fetch()]
        global $DB;
        if (empty($this->userid)) {
            die("User.class.php: Userid is empty");
        }
        if (empty($password)) {
            $password = $this->password;
        }

        $query = "SELECT userid FROM user WHERE password = '$password' AND userid = '$this->userid'";
        $rows = $DB->execresultset($query);
        $adadata = "no";
        foreach ($rows as $row) {
            $adadata = "yes";
            return true;
        }
        //UsertradeLog("User.class.php-361:" . $query.";AdaData:".$adadata);
        if ($adadata == "no") {
            return false;
            exit;
        }
    }

    /*     * **************************************************************************
     * END OF CLASS                                                              *
     * ************************************************************************** */
}

?>
