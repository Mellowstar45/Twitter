<?php
class User extends MyDatabase
{
    /*-------------REGISTERING--------------------*/
    protected function addUser($signusername, $at, $signemail, $signpassword, $birth)    {

      $profilepicture = "txt.jpg";
      $banner = "Dom.jpg";
      $salt = "vive le projet tweet_academy";
      $saltpassword = $salt . $signpassword;
      $hashsalt = hash("ripemd160", $saltpassword);
      $banger="@".$at;

      $query = $this->connectDb()->prepare("INSERT INTO user VALUES (NULL,:username, :at_user_name, :profile_picture, NULL, :banner,:mail, :password, :birthdate,NULL, CURRENT_TIMESTAMP, NULL, NULL);");
      $query->bindParam(':username', $signusername, PDO::PARAM_STR);
      $query->bindParam(':at_user_name', $banger, PDO::PARAM_STR);
      $query->bindParam(':profile_picture', $profilepicture, PDO::PARAM_STR);
      $query->bindParam(':banner', $banner, PDO::PARAM_STR);
      $query->bindParam(':mail', $signemail, PDO::PARAM_STR);
      $query->bindParam(':password', $hashsalt, PDO::PARAM_STR);
      $query->bindParam(':birthdate', $birth, PDO::PARAM_STR);
      $query->execute();
    }

    public function getUser($mail)
    {
        $query = $this->connectDb()->prepare("SELECT * FROM user WHERE mail=:mail");
        $query->bindParam(':mail', $mail, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetchAll();
        return ($user);
    }
}
