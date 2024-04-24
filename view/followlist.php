<html>
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../stylesheet/followlistTail.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="../script/ajax/allTweets.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
    </header>
    <!-- DEBUT SIDEBAR PC -->
    <div class="grid lg:grid-cols-3">
        <div class="hidden4">
            <?php
            include("shared/navbarPc.php");
            ?>
        </div>
        <div class="grid md:grid-cols-1">
            <!-- DEBUT SIDEBAR -->
            <div class="hidden5">
                <?php
                include("shared/navbarIpad.php")
                ?>
            </div>
            <!-- FIN SIDEBAR -->
            <div class="sm:ml-30 padding-left p-0 ">
                <div class="p-4 grid padding-left p-0 padding-left">
                    <div class="sticky top-0 bg-white drop-shadow-2xl">
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
                        <div class="w-full max-w-md mx-auto">
                            <div class="flex border-b border-gray-300">
                                <button class="w-1/2 py-4 text-center font-medium text-gray-700 bg-white-100 rounded-tl-lg focus:outline-none active:bg-gray-200" onclick="openTab(event, 'tab1')">Following</button>
                                <button class="w-1/2 py-4 text-center font-medium text-gray-700 bg-white-100 rounded-tr-lg focus:outline-none" onclick="openTab(event, 'tab2')">Follower</button>
                            </div>
                            <?php
                            include("../controllers/followctrl.php");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN CONTENU -->
        </div>

            <script>
                function openTab(evt, tabName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].classList.add("hidden");
                    }
                    tablinks = document.getElementsByTagName("button");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].classList.remove("active:bg-gray-200");
                    }
                    document.getElementById(tabName).classList.remove("hidden");
                    evt.currentTarget.classList.add("active:bg-gray-200");
                }
            </script>
                <!-- DEBUT SIDEBAR RIGHT FOR PC -->
                <div class="hidden4">
            <?php
            include("shared/rightbarPc.php");
            ?>
        </div>
    </div>
        <!-- FIN SIDEBAR RIGHT FOR PC -->
        <!-- DEBUT FOOTER -->
        <footer class="sticky bottom-0 bg-slate-300 blop3 hidden3">
            <div class="grid sm:grid-cols-1 hidden3">
                <?php
                include("shared/navbar.php")
                ?>
            </div>
        </footer>
        <!-- FIN FOOTER -->
</body>

</html>