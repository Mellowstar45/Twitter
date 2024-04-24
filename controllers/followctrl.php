<?php
// session_start();
include_once("../model/conndb.php");
include("../model/follow.php");
class Followctrl extends Follow
{
    private $senderid;
    private $receiverid;
    private $accountusername;
    public function __construct($senderid, $receiverid, $accountusername)
    {
        $this->senderid = $senderid;
        $this->receiverid = $receiverid;
        $this->accountusername = $accountusername;
    }
    public function ctrlfollow()
    {
        $this->checkfollow($this->senderid, $this->receiverid);
    }
    public function seefollow()
    {
        $this->displayfollowed($this->senderid);
        $this->displayfollowers($this->senderid);
    }
    public function counterfollowing()
    {
        $this->countfollowing($this->senderid);
        $this->countfollowers($this->senderid);
    }
    public function usercountfollow()
    {
        $this->countuserfollowing($this->accountusername);
        $this->countuserfollowers($this->accountusername);
        $this->countfollowers($this->accountusername);
    }
}

if (isset($_GET['username'])) {
    $senderid = "test1";
    $receiverid = "test";
    $accountusername = $_GET['username'];
    $initfollow = new Followctrl($senderid, $receiverid, $accountusername);
    $initfollow->usercountfollow();
} else {
    $accountusername = "vide";
    $senderid = $_SESSION['id_user'];
    $receiverid = "test";
    $initfollow = new Followctrl($senderid, $receiverid, $accountusername);
    $initfollow->counterfollowing();
}
if (isset ($_GET['receiverid'])) {
    session_start();
    $senderid = $_SESSION['id_user'];
    $receiverid = intval($_GET['receiverid']);
    $checkfollow = new Followctrl($senderid, $receiverid, $accountusername);
    $checkfollow->ctrlfollow();
    header("Location: ../view/account.php");
}

if ($_SESSION['id_user'] && !isset ($_GET['receiverid']) && strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $senderid = $_SESSION['id_user'];
    $receiverid = "test";
    $startfollow = new Followctrl($senderid, $receiverid, $accountusername);
    $startfollow->seefollow();
    $startfollow->counterfollowing();
}
