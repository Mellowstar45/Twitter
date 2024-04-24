<?php
session_start();
if (!isset ($_SESSION["thatusername"])) {
  $dateElems = explode("-", $_SESSION['birthdate']);
  $year = $dateElems[0];
  $month = $dateElems[1];
  $day = $dateElems[2];
  $monthNum = $month;
  $dateObj = DateTime::createFromFormat('!m', $monthNum);
  $monthName = $dateObj->format('F');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../stylesheet/accountTail.css">
  <link rel="stylesheet" href="../stylesheet/layouts/general.css">
  <link rel="stylesheet" href="../stylesheet/mainpageTail.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="shortcut icon" href="#">
  <title>Your account</title>
</head>

<body class="dark">
  <script src="../stylesheet/modifyaccount.js"></script>
  <script src="../stylesheet/darkmode.js"></script>
  <div class="grid lg:grid-cols-3">
    <div class="hidden4">
      <?php
      include ("../controllers/followctrl.php");
      include ("shared/navbarPc.php");
      ?>
    </div>
    <div id="accountpage">
      <div class="grid md:grid-cols-1">
        <!-- DEBUT SIDEBAR -->
        <div class="hidden5">
          <?php
          include ("shared/navbarIpad.php")
            ?>
        </div>
        <!-- FIN SIDEBAR -->
        <div class="padding-left p-0">
          <header class="mx-10">

            <div class="banner flex justify-between">
              <button class="p-1"><span
                  class="material-symbols-outlined rounded-full bg-button text-white">arrow_back</span></button>
              <form action="">
                <button class="p-1"><span
                    class="material-symbols-outlined rounded-full bg-button text-white">search</span></button>
              </form>
            </div>

            <div class="container">

              <div class="flex justify-between items-center">
                <button class="btn-edit border p-1" id="showForm"><span class="text-sm">Modify account</span></button>
                <a class="btn-edit border p-1" href="../model/logout.php"><span class="text-sm">Log out</span></a>
                <?php if (isset ($_SESSION["thatusername"])) {
                  include ("../model/account.php");
                } ?>
              </div>
              <div>
                <img src="../img/pp-logo-with-circle-rounded-negative-space-design-vector-29230298.jpg"
                  class="avatar rounded-full" alt="">
              </div>
              <div class="flex items-center">
                <span>
                  <?php
                  if (isset ($_SESSION["thatusername"])) {
                    echo $_SESSION["thatusername"];
                  } else {
                    echo $_SESSION["username"];
                  } ?>

                </span>
                <span class="material-symbols-outlined">lock</span>
              </div>
              <p class="text-sm m-bottom text-gray-600">
                <?php
                if (isset ($_SESSION["thatatusername"])) {
                  echo $_SESSION["thatatusername"];
                } else {
                  echo $_SESSION["atusername"];
                } ?>
              </p>
              <p>
                <?php
                if (isset ($_SESSION["thatbio"])) {
                  echo $_SESSION["thatbio"];
                } else {
                  echo $_SESSION['bio'];
                } ?>
              </p>

              <br>

              <div class="flex">
                <div class="flex items-center">
                  <span class="material-symbols-outlined text-sm text-gray-600">
                    location_on
                  </span>
                  <span class="text-sm text-gray-600">
                    <?php echo $_SESSION['city'] ?>
                  </span>
                </div>
                <div class="flex items-center">
                  <span class="material-symbols-outlined text-gray-600 px-1">
                    cake
                  </span>
                  <span class="text-sm text-gray-600">
                    Born on the
                    <?php
                    if (!isset ($_SESSION["thatusername"])) {
                      echo ("$day of $monthName $year");
                    } else
                      echo $_SESSION["thatbirthday"] ?>

                    </span>
                  </div>
                </div>

                <div class="flex items-center">
                  <span class="material-symbols-outlined text-gray-600">
                    calendar_month
                  </span>
                  <span class="text-sm text-gray-600 ">
                    Joined twitter on the
                  <?php if (isset ($_SESSION["thatcreation"])) {
                      echo $_SESSION["thatcreation"];
                    } else {
                      echo $_SESSION['creationtime'];
                    }
                    ?>
                </span>
              </div>

              <div class="flex">
                <span class="text-sm px-1">
                  <?php if (isset ($_SESSION["userfollowing"]) && isset ($_GET["username"])) {
                    echo $_SESSION["userfollowing"];
                  } else {
                    if (isset ($_SESSION["following"])) {
                      echo $_SESSION["following"];
                    }
                  }
                  ?>
                </span>
                <span class="text-sm  text-gray-600">
                  <a href="followlist.php">
                    Following
                  </a>
                </span>
                <span class="text-sm px-1">
                  <?php
                  if (isset ($_SESSION["userfollowers"]) && isset ($_GET["username"])) {
                    echo $_SESSION["userfollowers"];
                  } else {
                    echo $_SESSION["followers"];
                  }
                  ?>
                </span>
                <span class="text-sm text-gray-600">
                  Followers
                </span>
              </div>
            </div>
          </header>
          <?php include ("../controllers/tweetctrl.php");
          ?>
      <!--     </div>
        </div>
      </div>
    </div> -->
  <form id="modifyForm" method="POST" class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8"
    name="modifyForm" action="../controllers/updatectrl.php">
    <button id="return" class="p-1"><span
        class="material-symbols-outlined rounded-full bg-button text-white">arrow_back</span></button>
    <div>
      <label for="modifyUsername" class="block text-sm font-medium leading-6 text-gray-900"> Username </label>
      <div class="mt-2">
        <input id="modifyUsername" name="modifyUsername" value="<?= $_SESSION["username"] ?>"
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>

    <div>
      <label for="profile_picture" class="block text-sm font-medium leading-6 text-gray-900"> Image de profil </label>
      <div class="mt-2">
        <input id="profile_picture" accept="image/png, image/jpeg, image/jpg" type="file" name="profile_picture"
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>

    <div>
      <label for="bio" class="block text-sm font-medium leading-6 text-gray-900"> Bio </label>
      <div class="mt-2">
        <input id="bio" name="bio" value="<?= $_SESSION["bio"] ?>"
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>

    <div>
      <label for="banner" class="block text-sm font-medium leading-6 text-gray-900"> Bannière </label>
      <div class="mt-2">
        <input id="banner" name="banner" accept="image/png, image/jpeg, image/jpg" type="file"
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>

    <div>
      <label for="modifyEmail" class="block text-sm font-medium leading-6 text-gray-900"> Email </label>
      <div class="mt-2">
        <input id="modifyEmail" name="modifyEmail" value='<?= $_SESSION["mail"] ?>'
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>

    <div>
      <label for="modifyPassword" class="block text-sm font-medium leading-6 text-gray-900"> Mot de passe </label>
      <div class="mt-2">
        <input id="modifyPassword" name="modifyPassword" type="password"
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>

    <div>
      <label for="confModifyPassword" class="block text-sm font-medium leading-6 text-gray-900"> Confirmation du mot
        de passe </label>
      <div class="mt-2">
        <input id="confModifyPassword" name="confModifyPassword" required type="password"
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>

    <div>
      <label for="birth" class="block text-sm font-medium leading-6 text-gray-900"> Date de naissance </label>
      <div class="mt-2">
        <input id="birth" name="birth" type="date" disabled value='<?= $_SESSION["birthdate"] ?>'
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>

    <div>
      <label for="city" class="block text-sm font-medium leading-6 text-gray-900"> Ville </label>
      <div class="mt-2">
        <input id="city" name="city" required value='<?= $_SESSION["city"] ?>'
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
    </div>
    <div>
      <button type="submit" id="endModify" name="wesh"
        class="justify-center rounded-md bg-amber-300 px-3 py-1.5 text-sm font-semibold leading-6 text-black">
        Modifier </button>
    </div>
  </form>
  </div>

  <!-- DEBUT FOOTER -->
  <footer class="sticky bottom-0 bg-slate-300 blop3 hidden3">
    <div class="grid sm:grid-cols-1 hidden3">
      <?php
      include ("shared/navbar.php")
        ?>
    </div>
  </footer>

  <!-- FIN FOOTER -->
</body>

</html>