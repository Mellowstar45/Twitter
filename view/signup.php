<!DOCTYPE html>
<html lang="fr" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheet/signupTail.css">
    <link rel="icon" href="../stylesheet/asset/yellowtwitter.jpg">
    <title>TwitterWish</title>
</head>

<body class="h-full">
    <script src="../stylesheet/switchconnexion.js"></script>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-24 rounded-full max-w-md" src="../stylesheet/asset/yellowtwitter.jpg" alt="Twitter logo">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form id="formsignup" class="space-y-6" action="../controllers/signupctrl.php" method="POST">
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900"> Username </label>
                    <div class="mt-2">
                        <input id="username" name="signusername" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="at" class="block text-sm font-medium leading-6 text-gray-900"> @ </label>
                    <div class="mt-2">
                        <input id="at" name="at" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900"> Email</label>
                    </div>
                    <div class="mt-2">
                        <input id="email" name="signemail" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900"> Mot de passe </label>
                    <div class="mt-2">
                        <input id="password" type="password" name="signpassword" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="confirmsignpassword" class="block text-sm font-medium leading-6 text-gray-900"> Confirmation du mot de passe </label>
                    <div class="mt-2">
                        <input id="confirmsignpassword" type="password" name="confirmsignpassword" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="birthdate" class="block text-sm font-medium leading-6 text-gray-900"> Date de naissance</label>
                    </div>
                    <div class="mt-2">
                        <input id="birthdate" name="birthdate" type="date" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-amber-300 px-3 py-1.5 text-sm font-semibold leading-6 text-white"> Inscription </button>
                </div>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Déjà inscrit ?
                    <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500" id="login"> Connexion </a>
                </p>
            </form>

            <form id="formlogin" class="space-y-6" action="../controllers/loginctrl.php" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900"> Email</label>
                    <div class="mt-2">
                        <input id="emaillogin" name="logemail" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900"> password</label>
                    </div>
                    <div class="mt-2">
                        <input id="passwordlogin" name="logpassword" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-amber-300 px-3 py-1.5 text-sm font-semibold leading-6 text-white"> Connexion</button>
                </div>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Pas de compte ?
                    <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500" id="signup"> Crée un compte </a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
