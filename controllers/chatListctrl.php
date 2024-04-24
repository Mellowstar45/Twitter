<?php

session_start();

include '../model/conndb.php';
include '../model/ChatList.php';

class ChatListctrl extends ChatList {
    private $Listname;
    private $id;

    public function __construct($id)
    {
        $this->id       = $id;
    }

    public function searchNameList(){;
      $this->getNameList($this->id);
    }
}

$call = new ChatListctrl($_SESSION["id_user"]);
$call->searchNameList();
