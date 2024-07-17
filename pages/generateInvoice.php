<?php

require_once "../config/Database.php";
require_once "../domain/Invoice.php";
require_once "../repository/InvoiceRepository.php";
require_once "../vendor/pdf/fpdf.php";
require_once "../vendor/qrcode/qrlib.php";

$db = new Database();
$connection = $db->getConnection();

// Initialize PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

//    $imageName = $_FILES['image']['name'];

//    $target_dir = '../uploads/';

//    if (!is_dir($target_dir)) {
//        mkdir($target_dir, 0755, true);
//    }

    // Handle signature data
    if (isset($_POST['signed'])) {
        $signatureData = $_POST['signed'];

        // Remove the base64 URL part if present
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);

        // Decode the base64 string
        $decodedData = base64_decode($signatureData);

        $signatureName = uniqid() . '.png';

        // Specify the path where the signature image will be saved
        $baseDir = dirname(__DIR__);

        // Ensure the target directory exists
        $targetDir = $baseDir . '/ttd/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Define the signature file path relative to the base directory
        $signatureFilePath = $targetDir . $signatureName;

        // Save the decoded data as an image file
        if (file_put_contents($signatureFilePath, $decodedData) === false) {
            // Handle error
            exit('Failed to save the signature image.');
        }
    }

//    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
//    $newImageName = uniqid() . '.' . $extension;
//
//    $target_file = $target_dir . $newImageName;

    if (isset($name) && isset($price) && isset($signatureName)) {
        $invoice = new Invoice();
        $invoice->name = $name;
        $invoice->price = $price;
        $invoice->signature = $signatureName;

        $repository = new InvoiceRepository($connection);
        $repository->save($invoice);

        // Generate QR Code
        $qrDir = '../qrimg/';
        if (!is_dir($qrDir)) {
            mkdir($qrDir, 0755, true);
        }
        $qrFileName = uniqid() . '.png';
        $qrFilePath = $qrDir . $qrFileName;
        QRcode::png('https://kelasb.cerdasbelajar.xyz/2230511063', $qrFilePath);

        // Add product details to PDF
        // Add product details to PDF
        $pdf->SetFont('Times', 'B', 12);
// Adjust the cell widths as needed, here we keep the original widths for simplicity
//        $pdf->Cell(60, 10, 'Nama', 1, 0, 'C');
//        $pdf->Cell(30, 10, 'Harga', 1, 1, 'C'); // Note the change from 0 to 1 in the last parameter to move to the next line

        // Set font for the product details
        // Set font for the product details
        $pdf->SetFont('Times', '', 12);

// Check if the product information is available
        if ($row = $repository->findById($id)) {
            $productName = $row->name;
            $productPrice = $row->price;

            // Display product name
            $pdf->Ln(10); // Add a line break for spacing
            $pdf->Text(10, $pdf->GetY(), 'Nama: ' . $productName);

            // Move to the next line for the price
            $pdf->Ln(10); // Adjust the line height as needed
            // Display product price
            $pdf->Text(10, $pdf->GetY(), 'Harga: ' . $productPrice);

            // Add QR code to PDF (bottom-left corner)
            $pdf->Image($qrFilePath, 10, $pdf->GetY() + 20, 30); // Adjust Y position as needed

            // Add signature to PDF (bottom-right corner)
            $pdf->Image($signatureFilePath, 150, $pdf->GetY() + 20, 40, 30); // Adjust Y position as needed

            // Enable error reporting
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            $uniqueFileName = uniqid() . '.pdf';
            $filePath = '../files/' . $uniqueFileName;

// Check if the directory exists and is writable
            if (!is_dir('../files/') || !is_writable('../files/')) {
                die('Directory does not exist or is not writable.');
            }

// Output PDF to file
            $pdf->Output($filePath, 'F');

// Check if the file was created successfully
            if (!file_exists($filePath)) {
                die('Failed to create PDF file.');
            }

// Redirect to the PDF file
            header('Location: ' . $filePath);
            exit;
        }
    }
//    }
}
