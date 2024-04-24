<?php
class Tweet extends MyDatabase
{
    protected function displayTweet()
    {
        $stmt = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time, id_quoted_tweet FROM tweet INNER JOIN user ON id_user=user.id  WHERE id_response IS NULL ORDER BY time DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $results) {
            $str = "";
            $test = $this->at_hastag($results["content"]);
            /*    var_dump($test);
               exit(); */
            $arr = explode("../", $results["content"]);
            if (key_exists(1, $arr)) {
                $str = $arr[1];
                $str = "../" . $str;
            }
            // var_dump($results["id_quoted_tweet"]);

            if ($results["id_quoted_tweet"] != NULL) {
                $stmt3 = $this->connectDb()->prepare("SELECT * FROM tweet INNER JOIN user ON user.id=tweet.id_user WHERE tweet.id=:tweetid;");
                $stmt3->bindParam(":tweetid", $results['id_quoted_tweet'], PDO::PARAM_INT);
                $stmt3->execute();
                $retweetresult = $stmt3->fetchAll();
                $retweetcontent = $retweetresult[0]["content"];
                $retweetusername = $retweetresult[0]["username"];
                $retweetat = $retweetresult[0]["at_user_name"];
                $retweetime = $retweetresult[0]["time"];
                $rarr = explode("../", $retweetresult[0]["content"]);
                $rtest = $this->at_hastag($retweetcontent);
                $rstr = "../";
                if (key_exists(1, $rarr)) {
                    $rstr = $rarr[1];
                    $rstr = "../" . $rstr;
                }
                echo '<div class="border-y border-amber-400">
    <div class="flex py-3 px-2 items-center">
        <span class="material-symbols-outlined h-8">
            account_circle
        </span>
        <a href="../view/account.php?username=' . $results["username"] . '" class="px-3 font-bold">'
                    . $results["username"] . '
        </a>
        <a href="../view/account.php?username=' . $results["username"] . '"class="font-light text-sm">'
                    . $results["at_user_name"] . '
</a>
<p>' . $results["time"] . '</p>
</div>
<div class="containt">
    <p>';
                if ($test["mentions"] != NULL) {
                    for ($i = 0; $i < count($test["mentions"]); $i++) {
                        if ($arr[0]) {
                            $arr[0] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$test["mentions"][$i])."'>" . $test["mentions"][$i] . "</a>", $arr[0]);
                        } else {
                            $results["content"] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$test["mentions"][$i])."'>" . $test["mentions"][$i] . "</a>", $results["content"]);
                        }
                    }
                }
                if ($test["hashtags"] != NULL) {
                    for ($i = 0; $i < count($test["hashtags"]); $i++) {
                        var_dump($test["hashtags"]);
                        if ($arr[0]) {
                            $arr[0] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $arr[0]);
                        } else {
                            $results["content"] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $results["content"]);
                        }
                    }
                }
                if ($arr[0]) {
                    echo $arr[0];
                } else {
                    echo $results["content"];
                }
                echo '</p>
                </div>
                <div class="flex justify-center py-4">';
                if ($str != "../") {
                    echo '<div  class="imgwidth">
                           <img src=' . $str . '>
                           </div>';
                }
                echo '
                </div>';
                echo '<div class="border-y border-amber-400">
                <div class="flex py-3 px-2 items-center">
                    <span class="material-symbols-outlined h-8">
                        account_circle
                    </span>
                    <a href="../view/account.php?username=' . $retweetusername . '"  class="px-3 font-bold">'
                    . $retweetusername . '
                    </a>
                    <a href="../view/account.php?username=' . $retweetusername . '" class="font-light text-sm">'
                    . $retweetat . '
            </a>
            <p>' . $retweetime . '</p>
            </div>
            <div class="containt">
                <p>';
                if ($rtest["mentions"] != NULL) {
                    for ($i = 0; $i < count($rtest["mentions"]); $i++) {
                        if ($rarr[0]) {
                            $rarr[0] = str_replace($rtest["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$rtest["mentions"][$i])."'>" . $rtest["mentions"][$i] . "</a>", $rarr[0]);
                        } else {
                            $retweetcontent = str_replace($rtest["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$rtest["mentions"][$i])."'>" . $rtest["mentions"][$i] . "</a>", $retweetcontent);
                        }
                    }
                }
                if ($rtest["hashtags"] != NULL) {
                    for ($i = 0; $i < count($rtest["hashtags"]); $i++) {
                        var_dump($rtest["hashtags"]);
                        if ($rarr[0]) {
                            $rarr[0] = str_replace($rtest["hashtags"][$i], "<a href='../view/search.php'>" . $rtest["hashtags"][$i] . "</a>", $rarr[0]);
                        } else {
                            $retweetcontent = str_replace($rtest["hashtags"][$i], "<a href='../view/search.php'>" . $rtest["hashtags"][$i] . "</a>", $retweetcontent);
                        }
                    }
                }
                if ($rarr[0]) {
                    echo $rarr[0];
                } else {
                    echo $retweetcontent;
                }
                echo '</p>
                </div>
                <div class="flex justify-center py-4">';
                if ($rstr != "../") {
                    echo '<div  class="imgwidth">
                           <img src="' . $rstr . '" onclick="window.open(this.src)">
                           </div>';
                }
                echo '
                </div>
                <div class="max-w-screen-xl px-4 py-3 mx-auto bordertweet">
                    <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                        <li>
                            <a href="tweetresponse.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
                        </li>
                        <li>
                            <a href="tweet.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                        </li>
                    </ul>
                </div>
                </div>';
            } else {
                echo '<div class="border-y border-amber-400">
                <div class="flex py-3 px-2 items-center">
                    <span class="material-symbols-outlined h-8">
                        account_circle
                    </span>
                    <a  href="../view/account.php?username=' . $results["username"] . '" class="px-3 font-bold">'
                    . $results["username"] . '
                    </a>
                    <a  href="../view/account.php?username=' . $results["username"]. '" class="font-light text-sm">'
                    . $results["at_user_name"] . '
            </a>
            </div>
            <div class="containt">
                <p>';
                if ($test["mentions"] != NULL) {
                    for ($i = 0; $i < count($test["mentions"]); $i++) {
                        if ($arr[0]) {
                            $arr[0] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$test["mentions"][$i])."'>" . $test["mentions"][$i] . "</a>", $arr[0]);
                        } else {
                            $results["content"] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$test["mentions"][$i])."'>" . $test["mentions"][$i] . "</a>", $results["content"]);
                        }
                    }
                }
                if ($test["hashtags"] != NULL) {
                    for ($i = 0; $i < count($test["hashtags"]); $i++) {
                        var_dump($test["hashtags"]);
                        if ($arr[0]) {
                            $arr[0] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $arr[0]);
                        } else {
                            $results["content"] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $results["content"]);
                        }
                    }
                }
                if ($arr[0]) {
                    echo $arr[0];

                } else {
                    echo $results["content"];
                }
                echo '</p>
            </div>
            <div class="flex justify-center py-4">';
                if ($str != "../") {
                    echo '<div  class="imgwidth">
                       <img src="' . $str . '" onclick="window.open(this.src)">
                       </div>';
                }
                echo '
            </div>
            <div class="max-w-screen-xl px-4 py-3 mx-auto bordertweet">
                <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                    <li>
                        <a href="tweetresponse.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
                    </li>
                    <li>
                        <a href="tweet.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                    </li>
                </ul>
            </div>
            </div>';
            }
        }
    }
    protected function Tweet($senderid, $message)
    {
        $stmt = $this->connectDb()->prepare("INSERT INTO tweet VALUES(NULL,:senderid,NULL,CURRENT_TIMESTAMP, :contentmessage,NULL);");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':contentmessage', $message, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: ../view/mainpage.php");
    }
    protected function response($senderid, $message, $tweetid)
    {
        $stmt = $this->connectDb()->prepare("INSERT INTO tweet VALUES(NULL,:senderid,:tweetid,CURRENT_TIMESTAMP, :contentmessage,NULL);");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':tweetid', $tweetid, PDO::PARAM_INT);
        $stmt->bindParam(':contentmessage', $message, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: ../view/mainpage.php");
    }
    protected function Displayresponse($tweetid)
    {
        $stmt = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time,id_response FROM tweet INNER JOIN user ON id_user=user.id  WHERE  tweet.id=:tweetid");
        $stmt->bindParam(":tweetid", $tweetid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $test = $this->at_hastag($result[0]["content"]);
        /* var_dump($result);
        exit(); */
        $arr = explode("../", $result[0]["content"]);
        $str = "../";
        if (array_key_exists(1, $arr)) {
            $str = $arr[1];
            $str = "../" . $str;
        }
        if ($result[0]["id_response"] != NULL) {
            $stmt3 = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time,id_response FROM tweet INNER JOIN user ON id_user=user.id  WHERE  tweet.id=:tweetid");
            $stmt3->bindParam(":tweetid", $result[0]["id_response"], PDO::PARAM_INT);
            $stmt3->execute();
            $result3 = $stmt3->fetchAll();
            $stest = $this->at_hastag($result3[0]["content"]);
            $tarr = explode("../", $result3[0]["content"]);
            $tstr = "../";
            if (array_key_exists(1, $tarr)) {
                $tstr = $tarr[1];
                $tstr = "../" . $tstr;
            }

            echo '
            <div class="border-y border-amber-400 border-b-2">
            <div class="flex py-3 px-2 items-center">
                <span class="material-symbols-outlined h-8">
                    account_circle
                </span>
                <a  href="../view/account.php?username=' . $result3[0]["username"] . '" class="px-3 font-bold">'
                . $result3[0]["username"] . '
                </a>
                <a href="../view/account.php?username=' . $result3[0]["username"] . '" class="font-light text-sm">'
                . $result3[0]["at_user_name"] . '
        </a>
        <p>' . $result3[0]["time"] . '</p>
        </div>
        <div class="containt">
            <p>';
            if ($stest["mentions"] != NULL) {
                for ($i = 0; $i < count($stest["mentions"]); $i++) {
                    if ($tarr[0]) {
                        $tarr[0] = str_replace($stest["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$stest["mentions"][$i])."'>" . $stest["mentions"][$i] . "</a>", $tarr[0]);
                    } else {
                        $result3[0]["content"] = str_replace($stest["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$stest["mentions"][$i])."'>" . $stest["mentions"][$i] . "</a>", $result3[0]["content"]);
                    }
                }
            }
            if ($stest["hashtags"] != NULL) {
                for ($i = 0; $i < count($stest["hashtags"]); $i++) {
                    var_dump($stest["hashtags"]);
                    if ($tarr[0]) {
                        $tarr[0] = str_replace($stest["hashtags"][$i], "<a href='../view/search.php'>" . $stest["hashtags"][$i] . "</a>", $tarr[0]);
                    } else {
                        $result3[0]["content"] = str_replace($stest["hashtags"][$i], "<a href='../view/search.php'>" . $stest["hashtags"][$i] . "</a>", $result3[0]["content"]);
                    }
                }
            }
            if ($tarr[0]) {
                echo $tarr[0];

            } else {
                echo $result3[0]["content"];
            }
            echo '</p>
            </div>
            <div class="flex justify-center py-4">';
            if ($tstr != "../") {
                echo '<div  class="imgwidth">
                       <img src="' . $tstr . '" onclick="window.open(this.src)">
                       </div>
                       </div>
                       </div>';
            }
        }
        echo '<div class="border-y border-amber-400 border-b-2">
            <div class="flex py-3 px-2 items-center">
                <span class="material-symbols-outlined h-8">
                    account_circle
                </span>
                <a  href="../view/account.php?username=' . $result[0]["username"] . '" class="px-3 font-bold">'
            . $result[0]["username"] . '
                </a>
                <a  href="../view/account.php?username=' . $result[0]["username"] . '" class="font-light text-sm">'
            . $result[0]["at_user_name"] . '
        </a>
        <p>' . $result[0]["time"] . '</p>
        </div>
        <div class="containt">
            <p>';
        if ($test["mentions"] != NULL) {
            for ($i = 0; $i < count($test["mentions"]); $i++) {
                if ($arr[0]) {
                    $arr[0] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$test["mentions"][$i])."'>" . $test["mentions"][$i] . "</a>", $arr[0]);
                } else {
                    $result[0]["content"] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$test["mentions"][$i])."'>" . $test["mentions"][$i] . "</a>", $result[0]["content"]);
                }
            }
        }
        if ($test["hashtags"] != NULL) {
            for ($i = 0; $i < count($test["hashtags"]); $i++) {
                var_dump($test["hashtags"]);
                if ($arr[0]) {
                    $arr[0] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $arr[0]);
                } else {
                    $result[0]["content"] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $result[0]["content"]);
                }
            }
        }
        if ($arr[0]) {
            echo $arr[0];

        } else {
            echo $result[0]["content"];
        }
        echo '</p>
        </div>
        <div class="flex justify-center py-4">';
        if ($str != "../") {
            echo '<div  class="imgwidth">
                   <img src="' . $str . '" onclick="window.open(this.src)">
                   </div>';
        }
        echo '
        </div>
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <ul class="flex justify-center flex-row font-medium mt-0 space-x-8 text-smn">
            <li>
            <a href="tweetresponse.php?tweetid=' . $result[0]["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
        </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                </li>
            </ul>
        </div>
        </div>
        </div>
        </div>';

        $stmt2 = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time FROM tweet INNER JOIN user ON id_user=user.id  WHERE id_response=:id ORDER BY time DESC");
        $stmt2->bindParam(":id", $tweetid, PDO::PARAM_INT);
        $stmt2->execute();
        $result2 = $stmt2->fetchAll();
        echo '  <form method="POST" name="respondtweet" action="../controllers/tweetctrl.php?tweetid=' . $result[0]["tweetid"] . '" enctype="multipart/form-data">
        <textarea placeholder="Post your reply. . ." name="contentres" id="content" cols="28" rows="5" maxlength="144"
            class="border shadow-inner" style="resize: none;"></textarea>
            <div class="flex justify-center py-2">
            <label for="rimage" class="label-file justify-center">Choose image</label>
            <input id="rimage" name="rimage" class="input-file" type="file" accept="image/png, image/jpeg, image/jpg">
        <button type="submit" class="border bg-white hover:bg-gray-100 text-gray-800 font-semibold  items-center border border-gray-400 rounded shadow hover:bg-lime-200 px-4 mx-3">send</button>
            </div>
    </form>';
        foreach ($result2 as $results2) {
            $rtest = $this->at_hastag($results2["content"]);
            $rarr = explode("../", $results2["content"]);
            $rstr = "../";
            if (array_key_exists(1, $rarr)) {
                $rstr = $rarr[1];
                $rstr = "../" . $rstr;
            }
            echo '<div class="border-y-2 border-yellow-400 blockResponse">
                    <div class="flex items-center">
                    <span class="material-symbols-outlined h-8">
                        account_circle
                    </span>
                    <a  href="../view/account.php?username=' . $results2["username"] . '" class="px-3 font-bold">'
                . $results2["username"] . '
                    </a>
                    <a  href="../view/account.php?username=' . $results2["username"] . '" class="font-light text-sm text-center">'
                . $results2["at_user_name"] . '
                    </a>
                    <p class="px-2 text-sm">' . $results2["time"] . '</p>
                    </div>
                    <div class="containt">
                    <p>';
            if ($rtest["mentions"] != NULL) {
                for ($i = 0; $i < count($rtest["mentions"]); $i++) {
                    if ($rarr[0]) {
                        $rarr[0] = str_replace($rtest["mentions"][$i], "<a href='../view/account.php'>" . str_replace("@","",$rtest["mentions"][$i]) . "</a>", $rarr[0]);
                    } else {
                        $results2["content"] = str_replace($rtest["mentions"][$i], "<a href='../view/account.php'>" . str_replace("@","",$rtest["mentions"][$i]) . "</a>", $results2["content"]);
                    }
                }
            }
            if ($rtest["hashtags"] != NULL) {
                for ($i = 0; $i < count($rtest["hashtags"]); $i++) {
                    var_dump($rtest["hashtags"]);
                    if ($rarr[0]) {
                        $rarr[0] = str_replace($rtest["hashtags"][$i], "<a href='../view/search.php'>" . $rtest["hashtags"][$i] . "</a>", $rarr[0]);
                    } else {
                        $results2["content"] = str_replace($rtest["hashtags"][$i], "<a href='../view/search.php'>" . $rtest["hashtags"][$i] . "</a>", $results2["content"]);
                    }
                }
            }
            if ($rarr[0]) {
                echo $rarr[0];
            } else {

                echo $results2["content"];
            }
            echo '</p>
                    </div>
                    <div class="flex justify-center py-4">';
            if ($rstr != "../") {
                echo '<div  class="imgwidth">
                        <img src="' . $rstr . '" onclick="window.open(this.src)">
                        </div>';
            }
            echo '
                    </div>
                    <div class="max-w-screen-xl px-4 py-1 mx-auto betweentwotweet">
                    <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                    <li>
                    <a href="tweetresponse.php?tweetid=' . $results2["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
                    </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                        </li>
                    </ul>
                    </div>
            </div>';
        }
    }
    protected function Rename($directory, $extension)
    {
        $fileName = '';
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $max = strlen($alphabet) - 1;

        do {
            $fileName = '';
            for ($i = 0; $i < 5; $i++) {
                $fileName .= $alphabet[rand(0, $max)];
            }
            $fileName .= '.' . $extension;
        } while (file_exists($directory . '/' . $fileName));

        return $fileName;
    }
    protected function uploadFile($file, $destination)
    {
        return move_uploaded_file($file['tmp_name'], $destination);
    }
    protected function Retweet($tweetid, $senderid, $message)
    {
        $stmt2 = $this->connectDb()->prepare("INSERT INTO tweet VALUES(NULL,:senderid,NULL,CURRENT_TIMESTAMP, :contentmessage, :tweetid); ");
        $stmt2->bindParam(":tweetid", $tweetid, PDO::PARAM_INT);
        $stmt2->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt2->bindParam(':contentmessage', $message, PDO::PARAM_STR);
        $stmt2->execute();
        unset($_SESSION['retweetid']);
        header("Location: ../view/mainpage.php");
    }
    protected function at_hastag($message)
    {
        $mentions = [];
        $hashtags = [];
        $words = explode(" ", $message);
        foreach ($words as $word) {
            if (str_starts_with($word, "@")) {
                $mentions[] = $word;
            } elseif (str_starts_with($word, "#")) {
                $hashtags[] = $word;
            }
        }
        return [
            'mentions' => $mentions,
            'hashtags' => $hashtags
        ];
    }
    protected function UserTweet($senderid)
    {
        $stmt = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time, id_quoted_tweet FROM tweet INNER JOIN user ON id_user=user.id  WHERE id_response IS NULL AND id_user=:senderid ORDER BY time DESC");
        $stmt->bindParam(":senderid", $senderid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $results) {
            $str = "";
            $test = $this->at_hastag($results["content"]);
            /*    var_dump($test);
               exit(); */
            $arr = explode("../", $results["content"]);
            if (key_exists(1, $arr)) {
                $str = $arr[1];
                $str = "../" . $str;
            }
            echo '<div class="border-y-2 border-yellow-500">
            <div class="flex py-3 px-2 items-center">
                <span class="material-symbols-outlined h-8">
                    account_circle
                </span>
                <p class="px-3 font-bold">'
                . $results["username"] . '
                </p>
                <p class="font-light text-sm">'
                . $results["at_user_name"] . '
        </p>
        </div>
        <div class="containt">
            <p>';
            if ($test["mentions"] != NULL) {
                for ($i = 0; $i < count($test["mentions"]); $i++) {
                    if ($arr[0]) {
                        $arr[0] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$test["mentions"][$i])."'>" . $test["mentions"][$i] . "</a>", $arr[0]);
                    } else {
                        $results["content"] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".str_replace("@","",$test["mentions"][$i])."'>" . $test["mentions"][$i] . "</a>", $results["content"]);
                    }
                }
            }
            if ($test["hashtags"] != NULL) {
                for ($i = 0; $i < count($test["hashtags"]); $i++) {
                    var_dump($test["hashtags"]);
                    if ($arr[0]) {
                        $arr[0] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $arr[0]);
                    } else {
                        $results["content"] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $results["content"]);
                    }
                }
            }
            if ($arr[0]) {
                echo $arr[0];

            } else {
                echo $results["content"];
            }
            echo '</p>
        </div>
        <div class="flex justify-center py-4">';
            if ($str != "../") {
                echo '<div  class="imgwidth">
                   <img src="' . $str . '" onclick="window.open(this.src)">
                   </div>';
            }
            echo '
        </div>
        <div class="max-w-screen-xl px-4 py-3 mx-auto bordertweet">
            <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                <li>
                    <a href="tweetresponse.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
                </li>
                <li>
                    <a href="tweet.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                </li>
            </ul>
        </div>
        </div>';
        }
    }
    protected function getuserinfo($accountusername)
    {
        $stmt = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time FROM tweet INNER JOIN user ON user.id=tweet.id_user WHERE username=:username");
        $stmt->bindParam(':username', $accountusername, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $results) {
            $str = "";
            $test = $this->at_hastag($results["content"]);
            /*    var_dump($test);
               exit(); */
            $arr = explode("../", $results["content"]);
            if (key_exists(1, $arr)) {
                $str = $arr[1];
                $str = "../" . $str;
            }
            echo '<div class="border-y-2 border-yellow-500">
            <div class="flex py-3 px-2 items-center">
                <span class="material-symbols-outlined h-8">
                    account_circle
                </span>
                <p class="px-3 font-bold">'
                . $results["username"] . '
                </p>
                <p class="font-light text-sm">'
                . $results["at_user_name"] . '
        </p>
        </div>
        <div class="containt">
            <p>';
            if ($test["mentions"] != NULL) {
                for ($i = 0; $i < count($test["mentions"]); $i++) {
                    if ($arr[0]) {
                        $arr[0] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".$test["mentions"]."'>" . $test["mentions"][$i] . "</a>", $arr[0]);
                    } else {
                        $results["content"] = str_replace($test["mentions"][$i], "<a href='../view/account.php?username=".$test["mentions"]."'>" . $test["mentions"][$i] . "</a>", $results["content"]);
                    }
                }
            }
            if ($test["hashtags"] != NULL) {
                for ($i = 0; $i < count($test["hashtags"]); $i++) {
                    var_dump($test["hashtags"]);
                    if ($arr[0]) {
                        $arr[0] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $arr[0]);
                    } else {
                        $results["content"] = str_replace($test["hashtags"][$i], "<a href='../view/search.php'>" . $test["hashtags"][$i] . "</a>", $results["content"]);
                    }
                }
            }
            if ($arr[0]) {
                echo $arr[0];

            } else {
                echo $results["content"];
            }
            echo '</p>
        </div>
        <div class="flex justify-center py-4">';
            if ($str != "../") {
                echo '<div  class="imgwidth">
                   <img src="' . $str . '" onclick="window.open(this.src)">
                   </div>';
            }
            echo '
        </div>
        <div class="max-w-screen-xl px-4 py-3 mx-auto bordertweet">
            <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                <li>
                    <a href="tweetresponse.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
                </li>
                <li>
                    <a href="tweet.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                </li>
            </ul>
        </div>
        </div>';
        }
    }
}
