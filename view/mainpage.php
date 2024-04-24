<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheet/mainpageTail.css">
    <link rel="stylesheet" href="../stylesheet/mainpage.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="../script/ajax/allTweets.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../stylesheet/darkmode.js"></script>
    <title>Twitter</title>
</head>

<body class="dark">
    <!-- DEBUT SIDEBAR PC -->
    <div class="grid lg:grid-cols-3">
        <div class="hidden4">
            <?php
            session_start();
            unset($_SESSION["thatusername"]);
            unset($_SESSION["thatatusername"]);
            unset($_SESSION["thatbirthday"]);
            unset($_SESSION["thatid"]);
            unset($_SESSION["thatbio"]);
            unset($_SESSION["thatpfp"]);
            unset($_SESSION["thatbanner"]);
            unset($_SESSION["thatcreation"]);
            unset($_SESSION["userfollowing"]);
            include ("shared/navbarPc.php");
            ?>
        </div>
        <!-- FIN SIDEBAR PC -->
        <div class="grid md:grid-cols-1">
            <!-- DEBUT SIDEBAR -->
            <div class="hidden5">
                <?php
                include ("shared/navbarIpad.php")
                    ?>
            </div>
            <!-- FIN SIDEBAR -->

            <!-- DEBUT CONTENU -->
            <div class="sm:ml-30 padding-left p-0 ">
                <div class="p-4 grid padding-left p-0 padding-left">
                    <div class="sticky top-0 bg-white drop-shadow-2xl" id="testthree">
                        <div class="logos">
                            <a href="../view/account.php">
                                <span class="material-symbols-outlined">
                                    account_circle
                                </span>
                            </a>
                            <a href="#">
                                <img src="../stylesheet/asset/twitter.jpg" class="h-8 rounded-full" alt="Twitter Logo">
                            </a>
                            <a href="#">
                                <span class="material-symbols-outlined">
                                    settings
                                </span>
                            </a>
                        </div>
                        <header>
                            <div class="flex content-center justify-around space-x-4 p-3 border-b-4-yellow-400">
                                <input onclick="" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold items-center border border-gray-400 rounded shadow hover:bg-lime-200 p-3" type="button" value="For you">
                                <button onclick="myFunction()">Toggle dark mode</button>
                                <input onclick="window.location='followlist.php'" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold  items-center border border-gray-400 rounded shadow hover:bg-lime-200 p-3" type="button" value="Follower">
                            </div>
                        </header>
                    </div>
                    <!-- DEBUT TWEET -->
                    <div id="allTweets">
                    </div>
                    <!-- FIN TWEET -->
                </div>
            </div>
            <!-- FIN CONTENU -->
        </div>

        <!-- DEBUT SIDEBAR RIGHT FOR PC -->
        <div class="hidden4">
            <?php
            include ("shared/rightbarPc.php");
            ?>
        </div>
    </div>
    <!-- FIN SIDEBAR RIGHT FOR PC -->
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
