<?php
$mail     = $_POST["logemail"];
$password = $_POST["logpassword"];

include '../model/conndb.php';
include '../model/user.php';
class Loginctrl extends User
{
    private $mail;
    private $password;

    public function __construct($mail, $password)
    {
        $this->mail     = $mail;
        $this->password = $password;
    }


    public function tlogin($mail, $password)
    {
        $user = $this->getUser($mail);
        if (count($user) == 0) {
            header("Location:../view/signup.php");
            echo 'NOPE !';
        } else {
            $salt = "vive le projet tweet_academy";
            $saltpassword = $salt . $password;
            $hashsalt = hash("ripemd160", $saltpassword);
            if ($user[0]['password'] == $hashsalt) {
                session_start();
                $_SESSION['username'] = $user[0]['username'];
                $_SESSION['atusername'] = $user[0]['at_user_name'];
                $_SESSION['profilepicture'] = $user[0]['profile_picture'];
                $_SESSION['bio'] = $user[0]['bio'];
                $_SESSION['banner'] = $user[0]['banner'];
                $_SESSION['mail'] = $user[0]['mail'];
                $_SESSION['password'] = $user[0]['password'];
                $_SESSION['birthdate'] = $user[0]['birthdate'];
                $_SESSION['private'] = $user[0]['private'];
                $_SESSION['creationtime'] = $user[0]['creation_time'];
                $_SESSION['city'] = $user[0]['city'];
                $_SESSION['campus'] = $user[0]['campus'];
                $_SESSION['id_user'] = $user[0]['id'];
                header("Location: ../view/mainpage.php");
            }
            else {
              header("Location:../view/signup.php");
            }
        }
    }
}
$call = new Loginctrl($mail, $password);
$call->tlogin($mail, $password);
