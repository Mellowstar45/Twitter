<?php
  session_start();

  include '../../model/conndb.php';
  include '../../model/messages.php';

class Messagesctrl extends Messages {
  private $id;
  private $convo_id;

  public function __construct($id, $convo_id)
  {
    $this->id       = $id;
    $this->convo_id = $convo_id;
  }

  public function searchMessages(){;
    $this->getMessages($this->id, $this->convo_id);
  }
}

$call = new Messagesctrl($_SESSION["id_user"],  $_SESSION['convo_id']);
$call->searchMessages();
