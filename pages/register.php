<?php

require_once '../model/UserRegisterRequest.php';
require_once '../model/UserRegisterResponse.php';
require_once '../config/Database.php';
require_once '../repository/UserRepository.php';
require_once '../service/UserService.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $request = new UserRegisterRequest($username, $password);

    $database = new Database();
    $connection = $database->getConnection();
    $userRepository = new UserRepository($connection);
    $userService = new UserService($userRepository);

    try {
        $response = $userService->register($request);
        header('Location: /pages/login.php');

    } catch (Exception $exception) {
        $error = $exception->getMessage();
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://cdn.tailwindcss.com'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.5.0/tabler-icons.min.css'>
    <link rel='stylesheet' href='../public/assets/css/index.css'>
    <title>Register Foodyar</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pinky: '#FBE0DC',
                        yellow: '#F7C531',
                    }
                }
            }
        }
    </script>
    <style>
        .alert {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body class="text-indigo-950 h-auto flex flex-col justify-center items-center">
<div class="w-screen h-screen">
    <div class="w-1/4 h-screen mx-auto flex flex-col justify-center">
        <?php if (!empty($error)){ ?>
        <div class="w-100">
            <div class="text-center py-4 lg:px-4">
                <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-lg flex lg:inline-flex" role="alert">
                    <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">Error</span>
                    <span class="font-semibold mr-2 text-left flex-auto"><?= $error ?></span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="flex items-center gap-2 mb-4">
            <img src="/public/assets/burger.png"
                 alt="foodyar logo"
                 class="h-8"
            >

            <h1 class='text-[34px] font-semibold'>
                Daftar Akun
            </h1>
        </div>

        <form action="" method='post'>
            <div class="flex flex-col mb-2">
                <label for="username" class="text-[14px] mb-2">Nama Pengguna
                    <input name="username" type="text" class="w-full h-12 bg-neutral-100 rounded-lg px-4 ring-1 ring-inset ring-gray-300 outline-2 outline-yellow" placeholder="Masukkan nama pengguna...">
                </label>
            </div>

            <div class="flex flex-col">
                <label for="password" class="text-[14px]">Kata Sandi
                    <input name="password" type='text' class="w-full h-12 bg-neutral-100 rounded-lg px-4 ring-1 ring-inset ring-gray-300 outline-2 outline-yellow" placeholder="Masukkan kata sandi...">
                </label>
            </div>

            <button type="submit" class="h-12 bg-yellow my-[24px] rounded-lg font-semibold text-indigo-50 w-full ring-1 ring-inset ring-gray-300">
                Daftar
            </button>

            <p class="text-center">Sudah punya akun? <span class="cursor-pointer" onclick="window.location.href='login.php'">Masuk akun</span>
            </p>
        </form>
    </div>
</div>
</body>

</html>
