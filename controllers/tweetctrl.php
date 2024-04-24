<?php
$accountusername="";
$thatusername="";
$message="";
if (isset ($_POST["content"]) && strlen(trim($_POST["content"])) < 1 && !isset ($_FILES["image"])) {
    header("Location: ../view/tweet.php?error=there is no content in your tweet");
    exit();
} else if (isset ($_POST["contentres"]) && strlen(trim($_POST["contentres"])) < 1 && !isset ($_FILES["rimage"])) {
    header("Location: ../view/tweetresponse.php?tweetid=" . $idtweet);
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["content"])) {
    $input1 = $_POST["content"];
    $input2 = $_FILES["image"];
    if (empty ($input1) && $input2["tmp_name"] == "") {
        header("Location: ../view/tweet.php?error=there is no content in your tweet");
        exit();
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["contentres"])) {
    $input1 = $_POST["contentres"];
    $input2 = $_FILES["rimage"];
    if (empty ($input1) && $input2["tmp_name"] == "") {
        header("Location: ../view/tweetresponse.php?tweetid=" . $idtweet);
        exit();
    }
}
if (strpos($_SERVER["REQUEST_URI"], "account.php") == true) {
    // session_start();
    $img='';
    $userid = $_SESSION["id_user"];
}
else if (isset ($_POST["content"])) {
    session_start();
    $img = $_FILES["image"];
    $message = $_POST["content"];
    $userid = $_SESSION["id_user"];
} else if (isset ($_POST["contentres"])) {
    session_start();
    $img = $_FILES["rimage"];
    $message = $_POST["contentres"];
    $userid = $_SESSION["id_user"];
} else {
    $message = "";
    $userid = "";
    $img = "";
}
if (isset ($_GET["tweetid"])) {
    $idtweet = intval($_GET["tweetid"]);
} else if (isset ($_SESSION["retweetid"])) {
    $idtweet = intval($_SESSION["retweetid"]);
} else {
    $idtweet = "no tweet selected";
}
if(isset($_GET["username"])){
    $thatusername=$_GET["username"];
    $message = "";
}
include_once ('../model/conndb.php');
include ('../model/tweetclass.php');
class Tweetctrl extends Tweet
{
    private $id;
    private $at_username;
    private $username;
    public $message;
    public $messageimg;
    public $response;
    private $accountusername;

    public function __construct($id, $message, $messageimg, $response,$accountusername)
    {
        $this->id = $id;
        $this->message = $message;
        $this->messageimg = $messageimg;
        $this->response = $response;
        $this->accountusername=$accountusername;
    }
    public function tweetshow()
    {
        $this->displayTweet();
    }
    public function getTweet()
    {
        $this->Tweet($this->id, $this->message);
    }
    public function GetRetweet()
    {
        $this->Retweet($this->response, $this->id, $this->message);
    }
    public function AllowResponse()
    {
        $this->response($this->id, $this->message, $this->response);
    }
    public function handleupload()
    {
        $uploadDirectory = '../img';
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $file = $this->messageimg;
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = $this->Rename($uploadDirectory, $extension);
        $destination = $uploadDirectory . '/' . $fileName;
        if ($this->uploadFile($file, $destination)) {
            $this->message .= " " . $destination;
        }
    }
    public function getresponse()
    {
        $this->Displayresponse($this->response);
    }
    public function checkfortweet()
    {
        $this->at_hastag($this->message);
    }
    public function showusertweet()
    {
        $this->UserTweet($this->id);
    }
    public function usernameinfo(){
        $this->getuserinfo($this->accountusername);
    }
}
$display = new Tweetctrl($userid, $message, $img, $idtweet,$thatusername);
if(isset($_GET["username"])){
    $display->usernameinfo();
}
if (isset($_SESSION["followers"]) && !isset ($_POST["contentres"]) && !isset ($_POST["content"])) {
    $display->showusertweet();
} else if (isset ($_POST["contentres"]) && isset ($idtweet) && isset ($_FILES["rimage"]) && strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $display->handleupload();
    $display->AllowResponse();
} else if (isset ($_POST["contentres"]) && isset ($idtweet) && !isset ($_FILES["rimage"]) && strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $display->AllowResponse();
} else if (isset ($_POST["content"]) && isset ($_FILES["image"]) && !isset ($_SESSION["retweetid"]) && strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $display->handleupload();
    $display->getTweet();
} else if (isset ($_POST["content"]) && !isset ($_FILES["image"]) && !isset ($_SESSION["retweetid"]) && strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $display->getTweet();
}
if (isset ($_GET["tweetid"]) && strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $display->getresponse();
} else if (isset ($_SESSION["retweetid"]) && isset ($_POST["content"]) && !isset ($_FILES["image"]) && strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $display->GetRetweet();
} else if (isset ($_SESSION["retweetid"]) && isset ($_POST["content"]) && isset ($_FILES["image"]) && strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $display->handleupload();
    $display->GetRetweet();
} else if (strpos($_SERVER["REQUEST_URI"], "account.php") == false) {
    $display->tweetshow();
}
