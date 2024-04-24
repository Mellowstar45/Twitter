<?php

  session_start();

  $message = $_POST["name"];

  include '../../model/conndb.php';
  include '../../model/messages.php';

class AddMessagesctrl extends Messages {
  private $id ;
  private $convo_id;
  private $content;

  public function __construct($id, $convo_id, $content)
  {
    $this->id       = $id;
    $this->convo_id = $convo_id;
    $this->content = $content;
  }

  public function searchMessages(){;
    $this->addMessages($this->id, $this->convo_id, $this->content);
  }

}

if (trim($message) != "") {
  $call = new AddMessagesctrl($_SESSION["id_user"],  $_SESSION['convo_id'], $message);
  $call->searchMessages();
}
