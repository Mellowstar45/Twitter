<?php
if (isset($_GET["tweetid"])) {
    session_start();
    $_SESSION["retweetid"] = $_GET["tweetid"];
    unset($_GET["tweetid"]);
}
?>
<!doctype html>
<html lang="en">
<div class="grid-cols-1">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="../stylesheet/mainpageTail.css">
        <link rel="stylesheet" href="../stylesheet/mainpage.css">
        <title>Twitter</title>
    </head>

    <body>


        <section>
            <div class='air air1'></div>
            <div class='air air2'></div>
            <div class='air air3'></div>
            <div class='air air4'></div>


            <nav>
                <div>
                    <a href="mainpage.php" class="p-4">
                        <img src="../stylesheet/asset/chevron-back-outline.svg" class="h-8 " alt="chevronback Logo" />
                    </a>
                </div>
                <div class="hidden6">
                <?php
                include("shared/tweetPhotoProfil.php")
                ?>
                </div>
                <div class="flex justify-center">
                    <div class="flex flex-row py-3 px-2 bg-slate-300 rounded-md">
                        <img src="../stylesheet/asset/imageprofile.avif" class="h-8 " alt="profile Logo" />
                    </div>
                    <form method="POST" name="tweet" action="../controllers/tweetctrl.php" enctype="multipart/form-data" class="bg-slate-400 p-5 rounded-md">
                        <textarea name="content" id="content" cols="28" rows="5" maxlength="144" class="border shadow-inner mx-3" style="resize: none;"></textarea>
                        <div class="p-3">
                        <input type="file" name="image" accept="image/png, image/jpeg, image/jpg">
                        </div>
                        <div class="p-3">
                        <button type="submit" class="border bg-white hover:bg-gray-100 text-gray-800 font-semibold  items-center border border-gray-400 rounded shadow hover:bg-lime-200 px-4 mx-2">send</button>
                        </div>
                    </form>
                </div>

        </section>
        </nav>
    </body>
</div>