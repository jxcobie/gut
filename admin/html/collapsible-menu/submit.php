<?php
include 'config.php';

// Handle the product form submission
if (isset($_POST['product_submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $chariot_tb = isset($_POST['chariot_tb']) ? 1 : 0;
    $pont_tb = isset($_POST['pont_tb']) ? 1 : 0;
    $palan_tb = isset($_POST['palan_tb']) ? 1 : 0;
    $image = null;
    if (isset($_FILES['imageInput']) && $_FILES['imageInput']['error'] == 0) {
        $image = file_get_contents($_FILES['imageInput']['tmp_name']);
    }
    $stmt = $conn->prepare("INSERT INTO products (name, description, image, chariot_tb, pont_tb, palan_tb) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssss", $name, $description, $image, $chariot_tb, $pont_tb, $palan_tb);
        if (!$stmt->execute()) {
            echo "Error submitting product data: " . $stmt->error;
        } else {
            echo "Product data submitted successfully";
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Handle the contact form submission
if (isset($_POST['contact_submit'])) {
    $name = $_POST['Name_Ins'];
    $order = $_POST['Order_Ins'];
    $address = $_POST['inputAddress_Ins'];
    $city = $_POST['inputCity'];
    $zip = $_POST['inputZip'];
    $invoice = $_POST['Invoice_Ins'];
    $inspector = $_POST['inspector_Ins'];
    $date = $_POST['date_Ins'];
    $emplacement = $_POST['Emplacement_Ins'];
    $palan = $_POST['Palan_Ins'];
    $model = $_POST['Model_Ins'];
    $chaine = $_POST['Chaine_Ins'];
    $capacite = $_POST['Capacité_Ins'];
    $serie = $_POST['Serie_Ins'];
    $manufacturier = $_POST['manufacturier_Ins'];
    $stmt = $conn->prepare("INSERT INTO contacts (Name, OrderBy, Address, City, Zip, InvoiceNumber, InspectedBy, InspectionDate, Emplacement, Palan, Model, Chaine, Capacite, Serie, Manufacturier) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssssssssssssss", $name, $order, $address, $city, $zip, $invoice, $inspector, $date, $emplacement, $palan, $model, $chaine, $capacite, $serie, $manufacturier);
        if (!$stmt->execute()) {
            echo "Error submitting contact data: " . $stmt->error;
        } else {
            echo "Contact data submitted successfully";
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

header("Location: index.php");  // Redirect back to the main page after form submission
?>
