<?php

require_once "../controller/DashboardController.php";

$dashboardController = new DashboardController();
$result = $dashboardController->showAll();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'delete') {
        $dashboardController->delete($id);
    }

    header("Location: admin.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Foodyar</title>
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
            <div class="flex gap-3 items-center bg-slate-200 hover:bg-slate-200 hover:text-slate-900 p-2 rounded-md">
                <i class="fa-solid fa-cart-shopping"></i>
                <a href="admin.php" class="flex gap-2 w-full pr-5">Products</a>
            </div>
            <div class="flex gap-3 items-center hover:text-slate-900 hover:bg-slate-100 p-2 rounded-md">
                <i class="fa-solid fa-cart-plus"></i>
                <a href="insert.php" class="flex gap-2 w-full pr-5">Add Products</a>
            </div>
            <div class="flex gap-3 items-center hover:text-slate-900 hover:bg-slate-100 p-2 rounded-md">
                <i class="fa-solid fa-file-import"></i>
                <a href="uploadCsv.php" class="flex gap-2 w-full pr-5">Upload CSV</a>
            </div>
            <div class="flex gap-3 items-center hover:text-slate-900 hover:bg-slate-100 p-2 rounded-md">
                <i class="fa-solid fa-file-csv"></i>
                <a href="dataCsv.php" class="flex gap-2 w-full pr-5">CSV Data</a>
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
    <div class="bg-slate-50 w-full text-xl items-center font-bold">
        <h1 class="bg-slate-100 text-xl font-medium px-8 py-4">List of Products</h1>
        <hr>
        <div class="my-8 mx-10">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                <div class="relative w-full overflow-auto">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="border-b">
                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                            <th class="h-12 px-4 text-left align-middle font-medium pr-0">
                                No
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium pr-0">
                                Nama
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium pr-0">
                                Harga
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium pr-0">
                                Image
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium pr-0">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="border-0">
                        <?php foreach ($result as $no => $data): ?>
                            <tr class="border-b transition-colors hover:bg-muted/50">
                                <td class="border-b p-4 align-middle pr-0 font-medium"><?= $no + 1 ?></td>
                                <td class="border-b p-4 align-middle pr-0"><?= $data->name ?></td>
                                <td class="border-b p-4 align-middle pr-0">Rp <?= $data->price ?></td>
                                <td class="border-b p-4 align-middle pr-0 text-right">
                                    <img src="../uploads/<?= $data->image ?>"
                                         alt="<?= $data->image ?>"
                                         class="w-20 min-w-20 max-w-28">
                                </td>
                                <td>
                                    <a href="update.php?id=<?= $data->id ?>"
                                       class="bg-green-500 text-white px-2 py-1 rounded-md">Edit</a>
                                    <a href="?action=delete&id=<?= $data->id ?>"
                                       class="bg-red-500 text-white px-2 py-1 rounded-md"
                                       onclick="return confirmDelete()"
                                    >Delete
                                    </a>
                                    <a href=" invoice.php?id=<?= $data->id ?>"
                                       class=" bg-blue-500 text-white px-2 py-1 rounded-md">Invoice</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function resetFormInputs() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.value = '';
        });
    }

    function confirmDelete() {
        return confirm('Are you sure you want to delete this item?');
    }
</script>
</body>
</html>