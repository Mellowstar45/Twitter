<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../stylesheet/chatlistTail.css">
  <link rel="stylesheet" href="../stylesheet/chatlist.css">
  <link rel="stylesheet" href="../stylesheet/layouts/general.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="#">
  <script src="../script/chatListSideBar.js"></script>
  <script src="../script/ajax/createChat.js"></script>
  <script src="../script/ajax/getAllChatList.js"></script>
  <title>Chat List</title>
</head>
<body>
  <div class="mx-auto grid grid-cols-1">

    <div class="p-4 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">All Chats</h3>
        <a class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500"><span class="material-symbols-outlined" onclick="openNav()">add</span></a>
        <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <?php
          include("../controllers/newChatctrl.php");
          ?>
        </div>
      </div>
      <div id="allChats">
      </div>
    </div>
  </div>
  <?php
    include("shared/navbar.php")
  ?>
</body>
</html>
