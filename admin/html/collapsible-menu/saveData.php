
<?php
$host = 'localhost';
$db   = 'your_database_name';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];


try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}

$data = json_decode(file_get_contents("php://input"));


if(isset($_POST["submit"])) {
    // Check if file was uploaded without errors
    if(isset($_FILES["imageUpload"]) && $_FILES["imageUpload"]["error"] == 0) {
        $imageData = file_get_contents($_FILES["imageUpload"]["tmp_name"]);

        $stmt = $pdo->prepare("INSERT INTO mytable (ImageData) VALUES (?)");
        $stmt->execute([$imageData]);

        echo "Image uploaded successfully!";
    } else {
        echo "Error uploading image!";
    }
}

if($data) {
    try {
        $stmt = $pdo->prepare("INSERT INTO mytable (Name, Description, ImagePath, Chariot, Pont, Palan) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data->name, $data->description, $data->imagePath, $data->chariot, $data->pont, $data->palan]);
        echo "Data saved successfully!";
    } catch (\PDOException $e) {
        echo "Error inserting data: " . $e->getMessage();
    }
} else {
    echo "Error: No data received!";
}
?>
