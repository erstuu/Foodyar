<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../repository/csvRepository.php";
require_once __DIR__ . "/../domain/Csv.php";

$db = new Database();
$connection = $db->getConnection();
$repository = new csvRepository($connection);

function uploadCsv($file): array
{
    $file = fopen($file, "r");
    $csv = [];
    $index = 0;
    while ($data = fgetcsv($file, 1000, ",")) {
        if (count($data) >= 12) { // Ensure there are at least 12 columns
            $csv[] = [
                "Index" => $index,
                "Customer_Id" => $data[1] ?? '',
                "First_Name" => $data[2] ?? '',
                "Last_Name" => $data[3] ?? '',
                "Company" => $data[4] ?? '',
                "City" => $data[5] ?? '',
                "Country" => $data[6] ?? '',
                "Phone_1" => $data[7] ?? '',
                "Phone_2" => $data[8] ?? '',
                "Email" => $data[9] ?? '',
                "Subscription_Date" => $data[10] ?? '',
                "Website" => $data[11] ?? '',
            ];
            $index++;
        }
    }
    fclose($file);
    return $csv;
}

if (isset($_FILES['csv']) && $_FILES['csv']['error'] == 0) {
    $name = $_FILES['csv']['name'];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    $csv = uploadCsv($tmpName);

    foreach ($csv as $data) {
        $csv = new Csv();
        $csv->id = $data['Index'];
        $csv->customer_id = $data['Customer_Id'];
        $csv->first_name = $data['First_Name'];
        $csv->last_name = $data['Last_Name'];
        $csv->company = $data['Company'];
        $csv->city = $data['City'];
        $csv->country = $data['Country'];
        $csv->phone_1 = $data['Phone_1'];
        $csv->phone_2 = $data['Phone_2'];
        $csv->email = $data['Email'];
        $csv->subscription_date = $data['Subscription_Date'];
        $csv->website = $data['Website'];

        $repository->save($csv);
        header("Location: dataCsv.php");
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
        </div>
    </div>
</div>
</body>
</html>
