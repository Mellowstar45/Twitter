<?php
  session_start();
  $convo_id = $_GET["convoname"];
  $_SESSION["convo_id"] = $convo_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../stylesheet/chatTail.css">
  <link rel="stylesheet" href="../stylesheet/layouts/general.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="../script/ajax/getChat.js"></script>
  <script src="../script/ajax/addMessage.js"></script>
  <link rel="shortcut icon" href="#">
  <title>Chat</title>
</head>
<body>

  <div class="grid grid-cols-1">

    <div class="bg-gray-100 h-screen flex flex-col ">
    <div class="bg-gray-100 h-screen flex flex-col">
      <div class="bg-amber-300 p-4 text-white flex justify-between items-center">
        <a href="chat_list.php"><span class="material-symbols-outlined rounded-full bg-button text-white">arrow_back</span></a>
        <span>Chat App</span>
        <div class="relative inline-block text-left">
          <button id="setting" class="hover:bg-blue-400 rounded-md p-1 relative inline-block text-left"><span class="material-symbols-outlined">info</span></button>
        </div>
      </div>

      <div class="flex-1 overflow-y-auto p-4">
        <div id="allMessages"class="flex flex-col space-y-2">

        </div>
      </div>

      <div class="bg-white p-4 flex items-center justify-center">
        <form method="POST" onsubmit="addMessage();return false">
          <input type="text" id="inputMessage" name ="inputMessage" placeholder="Type your message..." class="flex-1 border rounded-full px-4 py-2 focus:outline-none" onfocus="this.value=''" style="width: 202px;">
          <input type="submit" class="bg-amber-300 text-white rounded-full p-2 ml-2 hover:bg-blue-600 focus:outline-none">
        </form>
      </div>

    </div>
  </div>

</body>
</html>
