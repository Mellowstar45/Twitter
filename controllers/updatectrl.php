<?php
session_start();
// if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset($_POST["wesh"])) {
    $modifyUsername  = $_POST["modifyUsername"];
    $userPassword    = $_SESSION['password'];
    $profilPicture   = $_POST["profile_picture"];
    $bio             = $_POST["bio"];
    $banner          = $_POST["banner"];
    $modifyEmail     = $_POST["modifyEmail"];
    $password        = $_POST["modifyPassword"];
    $confirmPassword = $_POST["confModifyPassword"];
    $city            = $_POST["city"];
}
// echo $modifyUsername;

include '../model/conndb.php';
include '../model/user.php';
include '../model/update.php';

class Updatectrl extends Update
{
    public $modifyUsername;
    public $atUsername;
    public $userPassword;
    public $profilPicture;
    public $bio;
    public $banner;
    private $modifyEmail;
    private $password;
    private $confirmPassword;
    public $city;

    public function __construct($modifyUsername, $atUsername, $userPassword, $profilPicture, $bio, $banner, $modifyEmail, $password, $confirmPassword, $city)
    {
        $this->modifyUsername  = $modifyUsername;
        $this->atUsername      = $atUsername;
        $this->userPassword    = $userPassword;
        $this->profilPicture   = $profilPicture;
        $this->bio             = $bio;
        $this->banner          = $banner;
        $this->modifyEmail     = $modifyEmail;
        $this->password        = $password;
        $this->confirmPassword = $confirmPassword;
        $this->city            = $city;
    }

    public function modifyCheck($profilPicture, $banner, $modifyEmail, $userPassword, $password, $confirmPassword, $city)
    {
        try {
            if ($profilPicture == null || $profilPicture == "") {
                $profilPicture = "Pas d'image de profil";
            }
            if ($banner == null || $banner == "") {
                $banner = "Pas de bannière";
            }
            if (!filter_var($modifyEmail, FILTER_VALIDATE_EMAIL)) {
                // header("Location: ../view/account.php");
                echo "ERREUR MAIL";
            }
            $uppercase    = preg_match('@[A-Z]@', $password);
            $lowercase    = preg_match('@[a-z]@', $password);
            $number       = preg_match('@[0-9]@', $password);
            if (!$uppercase || !$lowercase || !$number) {
                echo 'Password should include at least one upper case letter and one number.';
            } else {
                $salt = "vive le projet tweet_academy";
                $saltpassword = $salt . $password;
                $hashsalt = hash("ripemd160", $saltpassword);
                if ($userPassword !== $hashsalt) {
                    if ($password !== $confirmPassword) {
                        echo "Le mot de passe et la confirmation ne sont pas les mêmes";
                        exit();
                    }
                    header("Location: ../view/account.php");
                }
            }
            $this->modifyUser($this->modifyUsername, $this->atUsername, $profilPicture, $this->bio, $banner, $this->modifyEmail, $this->password, $this->city);
            $this->modifiedSession();
        } catch (PDOException $e) {
            die('<h1>' . 'Error' . $e->getMessage() . '</h1>');
        }
    }
    public function modifyValidation()
    {
        try {
            $this->modifyCheck($this->profilPicture, $this->banner, $this->modifyEmail, $this->userPassword, $this->password, $this->confirmPassword, $this->city);
        } catch (PDOException $e) {
            die('<h1>' . 'Error' . $e->getMessage() . '</h1>');
        }
    }
    public function modifiedSession()
    {
        $_SESSION['username']       = $this->modifyUsername;
        $_SESSION['profilepicture'] = $this->profilPicture;
        $_SESSION['bio']            = $this->bio;
        $_SESSION['banner']         = $this->banner;
        $_SESSION['mail']           = $this->modifyEmail;
        $_SESSION['password']       = $this->password;
        $_SESSION['city']           = $this->city;
    }
}

$modify = new Updatectrl($modifyUsername, $_SESSION['atusername'], $userPassword, $profilPicture, $bio, $banner, $modifyEmail, $password, $confirmPassword, $city);
$modify->modifyValidation();
