<?php
if (isset($_POST)) {
    $signusername        = $_POST["signusername"];
    $at                  = $_POST["at"];
    $signemail           = $_POST["signemail"];
    $signpassword        = $_POST["signpassword"];
    $confirmsignpassword = $_POST["confirmsignpassword"];
    $birth = $_POST["birthdate"];
}


// CAMELCASE OUBLIE PAS BATARD

include '../model/conndb.php';
include '../model/user.php';
class Signupctrl extends User
{

    public $signusername;
    public $at;
    private $signemail;
    private $signpassword;
    private $confirmsignpassword;
    public $birth;
    public function __construct($signusername, $at, $signemail, $signpassword, $confirmsignpassword, $birth)
    {
        $this->signusername        = $signusername;
        $this->at                  = $at;
        $this->signemail           = $signemail;
        $this->signpassword        = $signpassword;
        $this->confirmsignpassword = $confirmsignpassword;
        $this->birth = $birth;
    }

    public function signupcheck($signusername, $signemail, $signpassword, $confirmsignpassword, $birth)
    {
        try {
            if (!filter_var($signemail, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../view/signup.php");
            }

            $uppercase    = preg_match('@[A-Z]@', $signpassword);
            $lowercase    = preg_match('@[a-z]@', $signpassword);
            $number       = preg_match('@[0-9]@', $signpassword);
            if (!$uppercase || !$lowercase || !$number) {
                echo 'Password should include at least one upper case letter and one number.';
            }

            if ($signpassword !== $confirmsignpassword) {
                header('Location: ../view/signup.php');
            }

            $actualdate = new DateTime('today');
            $birth = new DateTime($birth);
            $dt = $birth->diff($actualdate)->y;
            if ($dt < 16) {
                // header('Location: ../view/signup.php');
                echo "<h1> T'es trop jeune, pour autant de sel </h1>";
                exit();
            }
        } catch (PDOException $e) {
            die('<h1>' . 'Error' . $e->getMessage() . '</h1>');
        }
    }

    public function checkuse($signemail)
    {
        $duplicate = $this->connectDb()->prepare("SELECT * from user where mail=:mail");
        $duplicate->bindParam(':mail', $signemail, PDO::PARAM_STR);
        $duplicate->execute();
        $result = $duplicate->fetchAll();
        if (count($result) > 0) {
            header("Location: ../view/signup.php?error=User exists already");
            exit();
        }
    }
    public function test()
    {
        $this->adduser($this->signusername, $this->at, $this->signemail, $this->signpassword, $this->birth);
    }
    public function everythingcheck()
    {
        try {
            $this->signupcheck($this->signusername ,$this->signemail, $this->signpassword, $this->confirmsignpassword, $this->birth);
        } catch (PDOException $e) {
            die('<h1>' . 'Error' . $e->getMessage() . '</h1>');
        }
        $this->checkuse($this->signemail);
        $this->test();
    }
}

$call = new Signupctrl($signusername, $at, $signemail, $signpassword, $confirmsignpassword, $birth);
$call->everythingcheck();
header("Location:../view/signup.php");
