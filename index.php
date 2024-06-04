<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src='https://cdn.tailwindcss.com'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.5.0/tabler-icons.min.css'>
    <link rel="stylesheet" href="public/assets/css/index.css">
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
        <button class="bg-pinky hover:bg-yellow font-normal px-4 py-1 rounded-lg" onclick="window.location.href='pages/login.php'">Login</button>
    </div>
</header>
<section class="grid grid-cols-2 justify-items-center mt-20 gap-20">
    <div>
        <h1 class="text-[2em] mb-4">
            Eat What You Cook
            <br>
            With Us Together!
        </h1>

        <p class="text-slate-400 font-normal">When you eat something that cooked by <br> yourself, the happiness is priceless.</p>

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
        <p>Healty Food</p>
        <p>Luch</p>
        <p>Vege Desert</p>
        <p>Shake</p>
    </div>

    <div class="flex gap-8">
        <div class="flex flex-col gap-2 items-center w-[220px]">
            <img src="public/assets/image4.png"
                 alt=""
                 class="rounded-lg"
            >

            <p class="font-normal">Salad Kiwi Sugga</p>

            <p class="font-light text-slate-400 text-sm">Amir Samantha</p>
            <div class="flex gap-2 w-3 h-3 justify-center">
                <img src="public/assets/Star.png" alt="bintang1">
                <img src="public/assets/Star.png" alt="bintang2">
                <img src="public/assets/Star.png" alt="bintang3">
                <img src="public/assets/Star.png" alt="bintang4">
                <img src="public/assets/Star.png" alt="bintang5">
            </div>
        </div>
        <div class="flex flex-col gap-2 items-center w-[220px]">
            <img src="public/assets/avocado.png"
                 alt=""
                 class="rounded-lg"
            >

            <p class="font-normal">Avocado Muscle</p>

            <p class="font-light text-slate-400 text-sm">John Lennonk</p>
            <div class="flex gap-2 w-3 h-3 justify-center">
                <img src="public/assets/Star.png" alt="bintang1">
                <img src="public/assets/Star.png" alt="bintang2">
                <img src="public/assets/Star.png" alt="bintang3">
                <img src="public/assets/Star.png" alt="bintang4">
                <img src="public/assets/Star.png" alt="bintang5">
            </div>
        </div>
        <div class="flex flex-col gap-2 items-center w-[220px]">
            <img src="public/assets/bayam.png"
                 alt=""
                 class="rounded-lg"
            >

            <p class="font-normal">Bayam Red Poppeye</p>

            <p class="font-light text-slate-400 text-sm">Toekang Sayur</p>
            <div class="flex gap-2 w-3 h-3 justify-center">
                <img src="public/assets/Star.png" alt="bintang1">
                <img src="public/assets/Star.png" alt="bintang2">
                <img src="public/assets/Star.png" alt="bintang3">
                <img src="public/assets/Star.png" alt="bintang4">
                <img src="public/assets/Star.png" alt="bintang5">
            </div>
        </div>
        <div class="flex flex-col gap-2 items-center w-[220px]">
            <img src="public/assets/naga.png"
                 alt=""
                 class="rounded-lg"
            >

            <p class="font-normal">Naga Fruity Joss</p>

            <p class="font-light text-slate-400 text-sm">Imelda Saranghae</p>
            <div class="flex gap-2 w-3 h-3 justify-center">
                <img src="public/assets/Star.png" alt="bintang1">
                <img src="public/assets/Star.png" alt="bintang2">
                <img src="public/assets/Star.png" alt="bintang3">
                <img src="public/assets/Star.png" alt="bintang4">
                <img src="public/assets/Star.png" alt="bintang5">
            </div>
        </div>
    </div>
</section>
</body>
</html>