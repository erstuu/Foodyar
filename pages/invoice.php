<?php

require_once "../config/Database.php";
require_once "../repository/DashboardRepository.php";

$id = $_GET["id"];

$db = new Database();
$connection = $db->getConnection();
$repository = new DashboardRepository($connection);
$data = $repository->findById($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script src="https://kit.fontawesome.com/1659def098.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="grid min-h-screen overflow-hidden lg:grid-cols-[280px_1fr] border-2 border-slate-200">
    <aside class="bg-slate-100 border-2 border-slate-200">
        <div class="flex flex-column content-center items-center">
            <a href="/admin" class="text-xl font-medium px-8 py-4">Foodyar Admin</a>
        </div>
        <hr>
        <div class="flex flex-col mx-5 mt-5 bg-slate-100 gap-2 text-sm text-slate-400">
            <div class="flex gap-3 items-center hover:bg-slate-200 hover:text-slate-900 p-2 rounded-md">
                <i class="fa-solid fa-house"></i>
                <a href="../index.php" class="flex gap-2 w-full pr-5 ">Home</a>
            </div>
            <div class="flex gap-3 items-center hover:text-slate-900 hover:bg-slate-100 p-2 rounded-md">
                <i class="fa-solid fa-folder-open"></i>
                <a href="admin.php" class="flex gap-2 w-full pr-5">Products</a>
            </div>
            <div class="flex gap-3 items-center hover:text-slate-900 hover:bg-slate-100 p-2 rounded-md">
                <i class="fa-solid fa-folder-open"></i>
                <a href="insert.php" class="flex gap-2 w-full pr-5">Add Products</a>
            </div>
            <div class="flex gap-3 items-center bg-slate-200 hover:text-slate-900 hover:bg-slate-100 p-2 rounded-md">
                <i class="fa-solid fa-folder-open"></i>
                <a href="" class="flex gap-2 w-full pr-5">Invoice</a>
            </div>
            <div class="flex gap-3 items-center hover:bg-slate-200 hover:text-slate-900 p-2 rounded-md">
                <i class="fa-solid fa-cart-shopping"></i>
                <a href="" class="flex gap-2 w-full pr-5">Orders</a>
            </div>
            <div class="flex gap-3 items-center hover:bg-slate-200 hover:text-slate-900 p-2 rounded-md">
                <i class="fa-solid fa-gears"></i>
                <a href="" class="flex gap-2 w-full pr-5">Setting</a>
            </div>
            <div class="flex gap-3 items-center hover:bg-slate-200 hover:text-slate-900 p-2 rounded-md">
                <i class="fa-solid fa-door-open"></i>
                <a href="../index.php" class="flex gap-2 w-full pr-5">Logout</a>
            </div>
        </div>
    </aside>
    <form id="form1" action="generateInvoice.php" method="post" class="ml-5">
        <div class="space-y-12">
            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6 mb-4">
                <input type="hidden" name="id" value="<?= $data->id ?>">
                <div class="sm:col-span-4">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name :</label>
                    <input type="hidden" name="name" value="<?= $data->name ?>">
                    <span class="block text-sm leading-6 text-gray-900"><?= $data->name ?></span>
                </div>
                <div class="sm:col-span-4">
                    <label for="price" class="block text-sm font-medium text-gray-900">Price :</label>
                    <input type="hidden" name="price" value="<?= $data->price ?>">
                    <span class="block text-sm leading-6 text-gray-900"><?= $data->price ?></span>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm mb-4 font-medium text-gray-900" for="signature-pad">Signature : </label>
            <div class="">
                <div id="sig"></div>
                <canvas id="signature-pad" name="signature-pad"
                        class="signature-pad border-solid border-2 border-slate-900 rounded-lg"></canvas>
                <input id="signed" name="signed" type="hidden">
            </div>
        </div>
        <div class="flex items-center justify-start gap-x-4">
            <button type="button"
                    onclick="savecanvas()"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Generate Invoice
            </button>
            <button type="button" id="reset-button"
                    class="rounded-md bg-gray-300 px-3 py-2 text-sm font-semibold text-black shadow-sm hover:bg-gray-400">
                Reset
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>

<script>
    function savecanvas() {
        let canvas = document.getElementById("signature-pad");
        canvas.fillStyle = "rgba(0, 0, 200, 0.5)";

        let dataURL = canvas.toDataURL("image/png");
        document.getElementById('signed').value = dataURL;
        document.forms["form1"].submit();
    }
</script>

<script>
    // script di dalam ini akan dijalankan pertama kali saat dokumen dimuat
    document.addEventListener('DOMContentLoaded', function () {
        resizeCanvas();
    })

    //script ini berfungsi untuk menyesuaikan tanda tangan dengan ukuran canvas
    function resizeCanvas() {
        let ratio = Math.max(window.devicePixelRatio || 1, 1);

        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    let canvas = document.getElementById('signature-pad');
    const min = Math.round(Math.random() * 70) / 10;
    const max = Math.round(Math.random() * 70) / 10;
    let signaturePad = new SignaturePad(canvas, {
        backgroundColor: '#fff',
        minWidth: 3,
        maxWidth: 3
    });

    //saat tombol clear diklik maka akan menghilangkan seluruh tanda tangan
    document.getElementById('reset-button').addEventListener('click', function () {
        signaturePad.clear();
    });

</script>

</body>
</html>