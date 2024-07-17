<?php

$csv = array();

if (isset($_FILES['csv']) && $_FILES['csv']['error'] == 0) {
    $name = $_FILES['csv']['name'];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    if ($ext === 'csv') {
        if (($handle = fopen($tmpName, 'r')) !== FALSE) {

            $row = 0;

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $col_count = count($data);

                if ($col_count >= 12) {
                    $csv[$row]['Index'] = $data[0] ?? '';
                    $csv[$row]['Customer_Id'] = $data[1] ?? '';
                    $csv[$row]['First_Name'] = $data[2] ?? '';
                    $csv[$row]['Last_Name'] = $data[3] ?? '';
                    $csv[$row]['Company'] = $data[4] ?? '';
                    $csv[$row]['City'] = $data[5] ?? '';
                    $csv[$row]['Country'] = $data[6] ?? '';
                    $csv[$row]['Phone_1'] = $data[7] ?? '';
                    $csv[$row]['Phone_2'] = $data[8] ?? '';
                    $csv[$row]['Email'] = $data[9] ?? '';
                    $csv[$row]['Subscription_Date'] = $data[10] ?? '';
                    $csv[$row]['Website'] = $data[11] ?? '';
                }

                $row++;
            }
            fclose($handle);
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://cdn.tailwindcss.com'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.5.0/tabler-icons.min.css'>
    <link rel='stylesheet' href='../public/assets/css/index.css'>
    <script src="https://kit.fontawesome.com/1659def098.js" crossorigin="anonymous"></script>
    <title>Upload CSV</title>
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
            <div class="flex gap-3 items-center hover:bg-slate-200 hover:text-slate-900 p-2 rounded-md">
                <i class="fa-solid fa-cart-shopping"></i>
                <a href="admin.php" class="flex gap-2 w-full pr-5">Products</a>
            </div>
            <div class="flex gap-3 items-center hover:text-slate-900 hover:bg-slate-100 p-2 rounded-md">
                <i class="fa-solid fa-cart-plus"></i>
                <a href="insert.php" class="flex gap-2 w-full pr-5">Add Products</a>
            </div>
            <div class="flex gap-3 items-center bg-slate-200 hover:text-slate-900 hover:bg-slate-100 p-2 rounded-md">
                <i class="fa-solid fa-file-import"></i>
                <a href="" class="flex gap-2 w-full pr-5">Upload CSV</a>
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
        <h1 class="bg-slate-100 text-xl font-medium px-8 py-4">Upload File CSV</h1>
        <hr>
        <div>
            <form action="" method="post" enctype="multipart/form-data" class="mb-10">
                <div class="w-auto h-auto">
                    <div class="ml-10 mt-7">
                        <label for="csv" class="block font-medium leading-6 text-lg text-gray-900">
                            Upload your CSV file here!
                        </label>
                        <div class="mt-2">
                            <div class="shadow-sm sm:max-w-md">
                                <input type="file" name="csv" id="csv"
                                       class="block w-full shadow-sm text-sm text-slate-500 ring-1 ring-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-slate-100 mt-5 mb-10"
                                       placeholder="your_file.csv">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-start gap-x-4 ml-10">
                        <button type="submit" class="text-sm font-semibold leading-6 bg-slate-50 text-gray-900">
                            Back
                        </button>
                        <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Upload
                        </button>
                    </div>
                </div>
            </form>
            <div class="m-10 relative w-auto overflow-auto">
                <table class="table-auto caption-bottom text-sm w-auto">
                    <thead class="border-b">
                    <tr>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">No</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Customers Id</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">First Name</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Last Name</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Company</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">City</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Country</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Phone 1</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Phone 2</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Email</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Subscription Date</th>
                        <th class="h-12 px-4 text-left align-middle font-medium pr-0">Website</th>
                    </tr>
                    </thead>
                    <tbody class="border-0">
                    <?php foreach ($csv as $index => $data): ?>
                        <tr class="border-b">
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Index"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Customer_Id"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["First_Name"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Last_Name"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Company"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["City"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Country"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Phone_1"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Phone_2"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Email"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Subscription_Date"] ?></td>
                            <td class="border-b p-4 align-middle pr-0 font-normal"><?= $data["Website"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
