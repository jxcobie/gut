<?php
include 'config.php';

$id = intval($_GET['id']);

// Check if ID is provided and is not empty
if (!$id) {
    echo "Invalid ID provided.";
    exit;
}

$sql = "SELECT image1 FROM products WHERE ID = ?";
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if (!$stmt) {
    echo "Failed to prepare the SQL statement.";
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($imageData);

// Check if an image was found for the given ID
if (!$stmt->fetch()) {
    echo "No image found for the provided ID.";
    exit;
}

$stmt->close();

header("Content-type: image/jpeg");
echo $imageData;
?>
