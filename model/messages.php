<?php

Class Messages extends MyDatabase{

  public function getMessages($id, $convo_id){
    $query = $this->connectDb()->prepare("SELECT content, user.id AS 'id_user' FROM messages JOIN user ON messages.id_user = user.id JOIN convo ON messages.id_convo = convo.id WHERE messages.id_convo = :convo_id ORDER BY messages.time ASC");
    $query->bindParam(':convo_id', $convo_id, PDO::PARAM_INT);
    $query->execute();
    $messages = $query->fetchAll();
    json_encode($messages);

    if (!empty($messages)) {
      foreach ($messages as $message) {
        if ($message["id_user"] == $id) {
          ?>
            <div class="flex justify-end">
              <div class="bg-amber-100 text-black p-2 rounded-lg max-w-xs">
                <?php echo $message["content"] ?>
              </div>
            </div>
          <?php
        }
        else {
          ?>
            <div class="flex">
              <div class="bg-gray-300 text-black p-2 rounded-lg max-w-xs">
                <?php echo $message["content"] ?>
              </div>
            </div>
          <?php
        }
      }
    }
    else {
      ?>
        <p class="text-sm font-medium text-gray-900 truncate dark:text-white text-center">No message yet here ...</p>
      <?php
    }
  }

  public function addMessages($id, $convo_id, $content){
    $query = $this->connectDb()->prepare("INSERT INTO messages (id_convo, id_user, content) VALUES (:convo_id, :id, :content)");
    $query->bindParam(':convo_id', $convo_id, PDO::PARAM_INT);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->execute();
    header("Location: ../../view/chat.php?convoname=$convo_id");
  }
}
