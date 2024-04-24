<?php
class Update extends User
{

    function modifyUser($modifyUsername, $atUsername ,$profilePicture, $bio, $banner, $modifyEmail, $password, $city)
    {
        try {
            $salt = "vive le projet tweet_academy";
            $saltpassword = $salt . $password;
            $hashsalt = hash("ripemd160", $saltpassword);
            $query = $this->connectDb()->prepare("UPDATE user SET username = :username, profile_picture = :profile_picture, bio = :bio, banner = :banner, mail = :mail, password = :password, city = :city WHERE at_user_name = :atusername;");
            $query->bindParam(':username', $modifyUsername, PDO::PARAM_STR);
            $query->bindParam(':atusername', $atUsername, PDO::PARAM_STR);
            $query->bindParam(':profile_picture', $profilePicture, PDO::PARAM_STR);
            $query->bindParam(':bio', $bio, PDO::PARAM_STR);
            $query->bindParam(':banner', $banner, PDO::PARAM_STR);
            $query->bindParam(':mail', $modifyEmail, PDO::PARAM_STR);
            $query->bindParam(':password', $hashsalt, PDO::PARAM_STR);
            $query->bindParam(':city', $city, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            echo $atUsername;
            die('<h1>' . 'Error' . $e->getMessage() . '</h1>');
        }
    }
    // htmlentities
}
