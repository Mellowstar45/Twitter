<?php
class Follow extends MyDatabase
{

    protected function checkfollow($senderid, $receiverid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * FROM follow WHERE id_user=:senderid AND id_follow=:receiverid;");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':receiverid', $receiverid, PDO::PARAM_INT);
        $stmt->execute();
        $result1 = $stmt->fetchAll();
        if (count($result1) == 0) {
            $this->follow($senderid, $receiverid);
            $this->countfollowing($senderid);
        } else {
            $this->unfollow($senderid, $receiverid);
        }
    }
    protected function follow($senderid, $receiverid)
    {
        $stmt = $this->connectDb()->prepare("INSERT INTO follow VALUES (:senderid, :receiverid,CURRENT_TIMESTAMP);");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':receiverid', $receiverid, PDO::PARAM_INT);
        $stmt->execute();
    }
    protected function unfollow($senderid, $receiverid)
    {

        $stmt = $this->connectDb()->prepare("DELETE FROM follow WHERE id_user=:senderid AND id_follow=:receiverid;");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':receiverid', $receiverid, PDO::PARAM_INT);
        $stmt->execute();
    }
    protected function countfollowing($senderid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * FROM follow WHERE id_user=:senderid");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $myfollowers = count($result);
        // session_start();
        $_SESSION["following"]=$myfollowers;
    }
    protected function countuserfollowing($accountusername)
    {
        $stmt = $this->connectDb()->prepare("SELECT * FROM follow INNER JOIN user ON user.id=follow.id_user WHERE username=:username");
        $stmt->bindParam(':username', $accountusername, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $myufollowers = count($result);
        // session_start();
        if (isset($result[0])) {
          $_SESSION["thatusername"]=$result[0]["username"];
          $_SESSION["thatatusername"]=$result[0]["at_user_name"];
          $_SESSION["thatbirthday"]=$result[0]["birthdate"];
          $_SESSION["thatid"]=$result[0]["id"];
          $_SESSION["thatbio"]=$result[0]["bio"];
          $_SESSION["thatpfp"]=$result[0]["profile_picture"];
          $_SESSION["thatbanner"]=$result[0]["banner"];
          $_SESSION["thatcreation"]=$result[0]["creation_time"];
          $_SESSION["userfollowing"]=$myufollowers;
        }
    }
    protected function countfollowers($senderid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * FROM follow WHERE id_follow=:senderid");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $myfollowers = count($result);
        // session_start();
        $_SESSION["followers"]=$myfollowers;
    }
    protected function countuserfollowers($accountusername)
    {
        $stmt = $this->connectDb()->prepare("SELECT * FROM follow INNER JOIN user ON user.id=follow.id_follow WHERE username=:username");
        $stmt->bindParam(':username', $accountusername, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $myfollowers = count($result);
        // session_start();
        if (isset($result[0])) {
          $_SESSION["thatusername"]=$result[0]["username"];
          $_SESSION["thatatusername"]=$result[0]["at_user_name"];
          $_SESSION["thatbirthday"]=$result[0]["birthdate"];
          $_SESSION["thatid"]=$result[0]["id"];
          $_SESSION["thatbio"]=$result[0]["bio"];
          $_SESSION["thatpfp"]=$result[0]["profile_picture"];
          $_SESSION["thatbanner"]=$result[0]["banner"];
          $_SESSION["thatcreation"]=$result[0]["creation_time"];
          $_SESSION["userfollowers"]=$myfollowers;
        }
    }
    protected function displayfollowed($senderid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * from follow INNER JOIN user ON follow.id_follow=user.id WHERE  follow.id_user=:senderid");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll();
        echo '<div id="tab1" class="tabcontent p-4"> ';
        if ($results) {
            foreach ($results as $result) {
                echo '<div class=" mt-2 flex flex-row justify-between">';
                echo '<img src="../img/pp-logo-with-circle-rounded-negative-space-design-vector-29230298.jpg"
                alt="logo test" class="avatar rounded-full"> ';
                echo '<div class="flex flex-col -mt-4 ml-2">';
                echo '<p class="text-sm">' . $result['username'] . '</p>';
                echo '<small>' . $result['at_user_name'] . '</small>';
                if ($result['bio'] !== NULL) {
                    echo "<p class='py-2 text-xs'>" . $result['bio'] . "</p>";
                } else {
                    echo "<p class='py-2 text-xs'>This user doesn't have a bio</p>";
                }
                echo '</div>';
                echo '<a href="../controllers/followctrl.php?receiverid=' . $result['id'] . '"> <button class="bg-amber-500 hover:bg-amber-400 text-white font-bold py-1 px-5 rounded-full h-12">
                Followed </button></a>';
                echo '</div>';
            }
        } else {
            echo "<h2>You don't follow anyone</h2>";
        }
        echo "</div>";
    }
    protected function displayfollowers($senderid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * from follow INNER JOIN user ON follow.id_user=user.id WHERE  follow.id_follow=:senderid");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll();
        echo '<div id="tab2" class="tabcontent p-4 hidden">';
        if ($results) {
            foreach ($results as $result) {
                try {
                    $stmt2 = $this->connectDb()->prepare("SELECT * from follow INNER JOIN user on follow.id_follow=user.id WHERE follow.id_user=:senderid AND follow.id_follow=:receiverid");
                    $stmt2->bindParam(':senderid', $senderid, PDO::PARAM_INT);
                    $stmt2->bindParam(':receiverid', $result['id'], PDO::PARAM_INT);
                    $stmt2->execute();
                    $result2 = $stmt2->fetchAll();
                } catch (PDOException $e) {
                    var_dump($e->getMessage());
                    exit();
                }
                echo '<div class=" mt-2 flex flex-row justify-between">';
                echo '<img src="../img/pp-logo-with-circle-rounded-negative-space-design-vector-29230298.jpg"
                alt="logo test" class="avatar rounded-full"> ';
                echo '<div class="flex flex-col -mt-4 ml-2">';
                echo '<p class="text-sm">' . $result['username'] . '</p>';
                echo '<small>' . $result['at_user_name'] . '</small>';
                if ($result['bio'] !== NULL) {
                    echo "<p class='py-2 text-xs'>" . $result['bio'] . "</p>";
                } else {
                    echo "<p class='py-2 text-xs'>This user doesn't have a bio</p>";
                }
                echo '</div>';
                if (count($result2) !== 0) {
                    echo '<a href="../controllers/followctrl.php?receiverid=' . $result['id'] . '"> <button class="bg-amber-500 hover:bg-amber-400 text-white font-bold py-1 px-5 rounded-full h-12">
                Followed </button></a>';
                } else {
                    echo '<a href="../controllers/followctrl.php?receiverid=' . $result['id'] . '"> <button class="bg-amber-500 hover:bg-amber-400 text-white font-bold py-1 px-5 rounded-full h-12">
                    Follow </button></a>';
                }
                echo '</div>';
            }
        } else {
            echo "<h2>No one following</h2>";
        }
        echo '</div>';
    }
    protected function comparefollow($senderid,$receiverid){

    }
}
