<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../stylesheet/mainpageTail.css">
  <link rel="stylesheet" href="../stylesheet/mainpage.css">
  <link rel="stylesheet" href="../stylesheet/search.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="../script/ajax/getAllSearch.js"></script>
  <title>Document</title>
</head>
<!-- DEBUT SIDEBAR -->
<div>
  <?php
  include("shared/navbarIpad.php")
  ?>
</div>
<!-- FIN SIDEBAR -->

<body>
  <div class="marginbottom">
    <div class="flex justify-center h-full px-3 py-4 overflow-y-auto bg-gray-50 border-l-2 border-yellow-400 ml-30">
      <ul class="flex flex-row font-medium mt-0 space-y-50 text-sm flex items-center fixed text-slate-500">
        <li>
          <span class="material-symbols-outlined py-7">search</span>
        </li>
        <form method="POST" class="drop-shadow-xl bg-gray" onsubmit="tryto();return false">
          <input type="text" id="searchInput" name="searchInput" size="30" placeholder=" Search" onclick="this.value=''" />
          <input type="submit" name="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded-full">
        </form>
      </ul>
    </div>

    <br><br><br>

    <div id="displaySearch" class="padding-left">
    </div>
  
  </div>


  <footer class="sticky bottom-0 bg-slate-300 blop3 hidden3 margintop">
    <div class="grid sm:grid-cols-1 hidden3">
      <?php
        include("shared/navbar.php")
      ?>
    </div>
  </footer>
</body>

</html>
