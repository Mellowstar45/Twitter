<?php

Class ChatList extends MyDatabase{

  public function getNameList($id){

    $query = $this->connectDb()->prepare("SELECT convo.name, convo.id FROM convo_users JOIN convo ON convo_users.id_convo = convo.id WHERE convo_users.id_user = :id;");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $names = $query->fetchAll();

    if (!empty($names)) {
      foreach ($names as $name) {
        ?>
          <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              <a href="chat.php?convoname=<?php echo $name["id"]?>">
                <li class="py-3 sm:py-4">
                  <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                      <img class="w-8 h-8 rounded-full" src="../images/pp-logo-with-circle-rounded-negative-space-design-vector-29230298.jpg" alt="Neil image">
                    </div>
                    <div class="flex-1 min-w-0">
                      <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                        <?php echo $name["name"]; ?>
                      </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                      <span class="material-symbols-outlined">chat_bubble</span>
                    </div>
                  </div>
                </li>
              </a>
            </ul>
          </div>
        <?php
      }
    }
    else {
      ?>
        <p class="text-sm font-medium text-gray-900 truncate dark:text-white text-center">No chat List ...</p>
      <?php
    }
  }

  public function selectChat($id_user){
    $stmt = $this->connectDb()->prepare("SELECT * FROM follow JOIN user ON follow.id_user=user.id WHERE id_follow=:id_user");
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll();
    if ($results) {
      foreach ($results as $result) {
        try {
          $receiver_id = $result['id_user'];
          $stmt2 = $this->connectDb()->prepare("SELECT * FROM follow JOIN user ON follow.id_user=user.id WHERE id_user=:id_user AND id_follow=:receiver_id");
          $stmt2->bindParam(':id_user', $receiver_id, PDO::PARAM_INT);
          $stmt2->bindParam(':receiver_id', $id_user, PDO::PARAM_INT);
          $stmt2->execute();
          $result2 = $stmt2->fetchAll();
          if ($result2) {
           ?>
            <button onclick="createChat(<?php echo $result2[0]['id']?>)"><?php echo $result2[0]["username"]?></button>
            <br>
           <?php
          }
        } catch (PDOException $e) {
          var_dump($e->getMessage());
        }
      }
    }
  }

  public function createChat($id_chatUser, $id_user, $convo_name){
    $query = $this->connectDb()->prepare("SELECT id_convo FROM convo_users WHERE id_user IN (:id_user, :id_chatUser) GROUP BY id_convo HAVING COUNT(DISTINCT id_user) = 2;");
    $query->bindparam(":id_user", $id_user, PDO::PARAM_INT);
    $query->bindparam(":id_chatUser", $id_chatUser, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();

    if ($result) {
      header("Location:../../view/chat.php?convoname=" . $result["id_convo"]);
      exit;
    } else {
      $query = $this->connectDb()->prepare("SELECT id_convo from convo_users WHERE id_user = :id_chatUser");
      $query->bindparam(":id_chatUser", $id_chatUser, PDO::PARAM_INT);
      $query->execute();
      $result = $query->fetch();

      $query = $this->connectDb()->prepare("INSERT INTO convo (name) VALUES (:name_convo)");
      $query->bindparam(":name_convo", $convo_name, PDO::PARAM_STR);
      $query->execute();

      $query = $this->connectDb()->prepare("SELECT id FROM convo WHERE name = :name_convo");
      $query->bindparam(":name_convo", $convo_name, PDO::PARAM_STR);
      $query->execute();
      $id_convo = $query->fetchAll();

      $query = $this->connectDb()->prepare("INSERT INTO convo_users (id_convo,id_user) VALUES (:id_convo, :id_chatUser)");
      $query->bindparam(":id_convo", $id_convo[0]["id"], PDO::PARAM_INT);
      $query->bindparam(":id_chatUser", $id_chatUser, PDO::PARAM_INT);
      $query->execute();

      $query = $this->connectDb()->prepare("INSERT INTO convo_users (id_convo,id_user) VALUES (:id_convo, :id_user)");
      $query->bindparam(":id_convo", $id_convo[0]["id"], PDO::PARAM_INT);
      $query->bindparam(":id_user", $id_user, PDO::PARAM_INT);
      $query->execute();

    }
  }
}
