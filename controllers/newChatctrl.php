<?php

  session_start();

  include_once("../model/conndb.php");
  include_once("../model/chatList.php");

class NewChatctrl extends ChatList {
  private $id_user;

  public function __construct($id_user,)
  {
    $this->id_user       = $id_user;
  }

  public function callSelectChat(){;
    $this->selectChat($this->id_user);
  }
}

$call = new NewChatctrl($_SESSION["id_user"]);
$call->callSelectChat();
