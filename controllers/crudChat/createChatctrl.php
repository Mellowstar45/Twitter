<?php
include("../../model/conndb.php");
include("../../model/chatList.php");

session_start();

$id_chatUser = $_POST["id_chat_user"];
$convo_name = $_POST["convo_name"];

class CreateChat extends Chatlist
{
    private $id_chatUser;
    private $id_user;
    private $convo_name;

    public function __construct($id_chatUser, $id_user, $convo_name)
    {
      $this->id_chatUser = $id_chatUser;
      $this->id_user = $id_user;
      $this->convo_name = $convo_name;
    }
    public function callCreateChat(){
      $this->createChat($this->id_chatUser, $this->id_user, $this->convo_name);
    }
}

$call = new CreateChat($id_chatUser, $_SESSION["id_user"], $convo_name);
$call->callCreateChat();
