<?php

require_once "controller/HomeController.php";

$controller = new HomeController();
$result = $controller->showAllProduct();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src='https://cdn.tailwindcss.com'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.5.0/tabler-icons.min.css'>
    <link rel="stylesheet" href="public/assets/css/index.css">
    <style>
        .custom-underline {
            text-decoration: underline;
            text-underline-offset: 7px;
        }
    </style>
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
    <title>Foodyar</title>
</head>
<body class="text-indigo-950 h-auto font-semibold h-auto">
<header class="grid grid-cols-2 z-50 border-neutral-100 h-20 bg-white flex px-20 sticky top-0 items-center justify-">
    <div class="flex items-center">
        <img src="public/assets/burger.png" alt="Foodyar Logo" class="h-6">

        <a class="text-[26px] ml-4" href="#">Foodyar</a>
    </div>
    <div class="flex gap-10 justify-end items-center">
        <div class="flex gap-6">
            <a href="" class=>Home</a>
            <a href="" class="text-gray-400 hover:text-indigo-950">Beverages</a>
            <a href="" class="text-gray-400 hover:text-indigo-950">Chef</a>
            <a href="" class="text-gray-400 hover:text-indigo-950">Ingredient</a>
            <a href="" class="text-gray-400 hover:text-indigo-950">Stories</a>
        </div>
        <button class="bg-pinky hover:bg-yellow font-normal px-4 py-1 rounded-lg"
                onclick="window.location.href='pages/login.php'">Login
        </button>
    </div>
</header>
<section class="grid grid-cols-2 justify-items-center mt-20 gap-20">
    <div>
        <h1 class="text-[2em] mb-4">
            Eat What You Cook
            <br>
            With Us Together!
        </h1>

        <p class="text-slate-400 font-normal">When you eat something that cooked by <br> yourself, the happiness is
            priceless.</p>

        <button class="bg-yellow hover:bg-pinky px-4 py-2 rounded-xl mt-8">Decide a Menu</button>
    </div>
    <div>
        <img src="public/assets/womanvid.png" alt="Woman Cooking" class="w-96 rounded-xl">
    </div>
</section>
<section class="flex flex-col gap-4 mt-20 items-center h-auto">
    <div class="flex flex-col items-center gap-2">
        <p class="font-normal text-md text-slate-400">Watch Now!</p>
        <p class="text-xl">Special to Try</p>
    </div>

    <div class="flex gap-6 font-normal mb-4">
        <a href="#Healthy" id="Healthy" class="text-yellow custom-underline">Healthy Food</a>
        <a href="#Lunch" id="Lunch">Luch</a>
        <a href="#Vege" id="Vege">Vege Desert</a>
        <a href="#Shake" id="Shake">Shake</a>
    </div>

    <div class="flex gap-8">
        <?php foreach ($result as $res) : ?>
            <div class="flex flex-col gap-2 items-center w-[220px]">
                <img src="uploads/<?= $res->image ?>"
                     alt="image of <?= $res->name ?>"
                     class="rounded-lg"
                >

                <p class="font-normal"><?= $res->name ?></p>

                <p class="font-light text-slate-400 text-sm">Rp <?= $res->price ?></p>
                <div class="flex gap-2 w-3 h-3 justify-center">
                    <img src="public/assets/Star.png" alt="bintang1">
                    <img src="public/assets/Star.png" alt="bintang2">
                    <img src="public/assets/Star.png" alt="bintang3">
                    <img src="public/assets/Star.png" alt="bintang4">
                    <img src="public/assets/Star.png" alt="bintang5">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="flex flex-col items-center mt-20">
        <div class="text-center text-2xl font-light">
            <p>" Awalnya saya malu dengan mertua karena</p>
            <p>Tidak bisa memasak, kini mereka lebih suka</p>
            <p>makan malam di rumah demi menyantap</p>
            <p>masakan yang saya buat sendiri "</p>
        </div>
        <div class="flex items-center mt-7">
            <img src="public/assets/sarah.png"
                 alt="photo of camelia sarah"
                 class="h-12 w-12 rounded-full"
            >
            <div class="flex flex-col pl-5">
                <p class="text-sm font-medium">Camelia Sarah</p>
                <p class="text-sm font-light">Vege Master</p>
            </div>
        </div>
    </div>
    <div class="flex flex-row gap-20 mt-10">
        <div class="text-center">
            <p class="text-xl">180.000+</p>
            <p class="text-sm text-slate-400 font-light">MENU FOOD</p>
        </div>
        <div class="text-center">
            <p class="text-xl">20.000</p>
            <p class="text-sm text-slate-400 font-light">CHEFS</p>
        </div>
        <div class="text-center">
            <p class="text-xl">400.000+</p>
            <p class="text-sm text-slate-400 font-light">COURSE</p>
        </div>
        <div class="text-center">
            <p class="text-xl">6.700.000</p>
            <p class="text-sm text-slate-400 font-light">ALUMNI</p>
        </div>
    </div>
    <div class="flex flex-row gap-32 mt-14">
        <div class="h-1/3 w-64">
            <img src="public/assets/app.png"
                 alt="image of an app"
                 class="h-1/3 w-64 rounded-t-[64px] rounded-b-[40px]"
            >
        </div>
        <div class="flex flex-col align-center justify-center gap-3">
            <div class="text-3xl leading-normal">
                <p>Download our App</p>
                <p>and join the contest</p>
            </div>
            <div class="text-sm font-light">
                <p>In order to improve our cooking skills,</p>
                <p>we do need photography</p>
            </div>
            <div class="flex flex-row gap-4 mt-5">
                <img src="public/assets/available-on-the-app-store-2.png"
                     alt="app store"
                     class="h-[35px] w-[118.69px]"
                >
                <img src="public/assets/google-play-download-android-app%20(1).png"
                     alt="google play"
                     class="h-[35px] w-[118.69px]"
                >
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="flex flex-row justify-evenly gap-20 mt-32">
        <div class="flex items-center">
            <img src="public/assets/burger.png" alt="Foodyar Logo" class="h-6">

            <a class="text-[26px] ml-4" href="#">Foodyar</a>
        </div>
        <div>
            <p class="font-normal text-lg">Special Course</p>
            <div class="text-sm font-light mt-2 leading-relaxed">
                <p>Wedding Foods</p>
                <p>Healthy and Muscle</p>
                <p>Office and Food Daily</p>
                <p>Happy Kids</p>
            </div>
        </div>
        <div>
            <p class="font-normal text-lg">Company</p>
            <div class="text-sm font-light mt-2 leading-relaxed">
                <p>APIs Developer</p>
                <p>Career</p>
                <p>Terms & Conditions</p>
                <p>Privacy Policy</p>
            </div>
        </div>
        <div>
            <p class="font-normal text-lg">Be Our Friend</p>
            <div class="text-sm font-light mt-2 leading-relaxed">
                <p>Jl. Situ Gunung, Gede Pangrango, Sukabumi</p>
                <p>Support Foodyar</p>
                <p>021 - 111 - 333</p>
            </div>
        </div>
    </div>
    <div class="mt-20 mb-4 pb-6">
        <p class="text-center text-sm font-light mt-10">© 2024 Made with Love. Restu Gede Purnama</p>
    </div>
</footer>
</body>
</html>