<?php
class Search extends MyDatabase
{

  public function searchByInput($searchInput){
    try {
      $query = $this->connectDb()-> prepare("SELECT * FROM tweet INNER JOIN user ON id_user=user.id  WHERE tweet.content LIKE '%$searchInput%' AND id_response IS NULL ORDER BY time DESC");
      $query->execute();
      $result = $query->fetchAll();
      foreach ($result as $results) {
        $str = "";
        $arr = explode("../", $results["content"]);
        if (key_exists(1, $arr)) {
          $str = $arr[1];
          $str = "../" . $str;
      }

        echo
        '<head>
        <link rel="stylesheet" href="../stylesheet/mainpageTail.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
        </head>
        <div class="border-y border-yellow-400" style:"padding: 15px 0;">
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
        if ($arr[0]) {
            echo $arr[0];
        } else {
            echo $result["content"];
        }
        echo '</p>
          </div>
            <div class="flex justify-center py-4">';
            if ($str != "../") {
              echo '<div  class="arrondir">
                      <img src=' . $str . '>
                    </div>';
            }
        echo'
        </div>
          <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <ul class="flex justify-center flex-row font-medium mt-0 space-x-8 text-smn">
              <li>
                <a href="#"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
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
    } catch (Exception $e) {
      echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
  }

  public function searchByAtusername($atUsernames){
    try {
      foreach ($atUsernames as $atUsername) {
        $query = $this->connectDb()-> prepare("SELECT * FROM user WHERE at_user_name LIKE '$atUsername%'");
        // $query->bindParam(':atUsername', $atUsername, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll();
        foreach ($results as $result) {
          echo '<div class=" mt-2 flex flex-row justify-center" style="padding: 15px 0;">';
          echo '<img src="../img/pp-logo-with-circle-rounded-negative-space-design-vector-29230298.jpg"
          alt="logo test" class="avatar rounded-full" style="width: 70px; heigth: 50px;" >';
          echo '<div class="flex flex-col -mt-4 ml-2">';
          echo '<p class="text-sm">' . $result['username'] . '</p>';
          echo '<small>' . $result['at_user_name'] . '</small>';
          if ($result['bio'] !== NULL) {
              echo "<p class='py-2 text-xs'>" . $result['bio'] . "</p>";
          } else {
              echo "<p class='py-2 text-xs'>This user doesn't have a bio</p>";
          }
          echo '</div>';
          echo '</div>';
        }
      }
    } catch (Exception $e) {
      echo($e);
    }
  }


  public function searchByHashtag($hashtags){
    try {
      foreach ($hashtags as $hashtag) {
        $query = $this->connectDb()-> prepare("SELECT * FROM tweet INNER JOIN user ON id_user=user.id  WHERE tweet.content LIKE '$hashtag%' AND id_response IS NULL ORDER BY time DESC");
        // $query->bindParam(':hashtag', $hashtag, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $results) {
          $arr = explode("../", $results["content"]);

          if ($arr) {
            $str = $arr[1];
            $str = "../" . $str;
          }

          echo
          '<head>
          <link rel="stylesheet" href="../stylesheet/mainpageTail.css">
          <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
          </head>
          <div class="border-y border-yellow-400" style="padding: 15px 0;">
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
          if ($arr[0]) {
              echo $arr[0];
          } else {
              echo $result["content"];
          }
          echo '</p>
            </div>
              <div class="flex justify-center py-4">';
              if ($str != "../") {
                echo '<div  class="arrondir">
                        <img src=' . $str . '>
                      </div>';
            }
          echo'
          </div>
            <div class="max-w-screen-xl px-4 py-3 mx-auto">
              <ul class="flex justify-center flex-row font-medium mt-0 space-x-8 text-smn">
                <li>
                  <a href="#"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
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
    } catch (Exception $e) {

    }
  }
}
