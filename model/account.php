<?php
include_once ("../model/conndb.php");
class Account extends MyDatabase
{
    public function followthat()
    {
        $stmt2 = $this->connectDb()->prepare("SELECT * from follow INNER JOIN user on follow.id_follow=user.id WHERE follow.id_user=:senderid AND follow.id_follow=:receiverid");
        $stmt2->bindParam(':senderid', $_SESSION["id_user"], PDO::PARAM_INT);
        $stmt2->bindParam(':receiverid', $_SESSION["thatid"], PDO::PARAM_INT);
        $stmt2->execute();
        $result2 = $stmt2->fetchAll();
        if (count($result2) !== 0) {
            echo '<a href="../controllers/followctrl.php?receiverid=' . $_SESSION['thatid'] . '"> <button class="bg-amber-500 hover:bg-amber-400 text-white font-bold py-1 px-5 rounded-full h-12">
        Followed </button></a>';
        } else {
            echo '<a href="../controllers/followctrl.php?receiverid=' . $_SESSION['thatid'] . '"> <button class="bg-amber-500 hover:bg-amber-400 text-white font-bold py-1 px-5 rounded-full h-12">
        Follow </button></a>';
        }
    }
}
$account=new Account();
if(isset($_SESSION["thatid"])){
    $account->followthat();
}