<?php
include 'config.php';

$sql_products = "SELECT * FROM products";
$result_products = $conn->query($sql_products);

$sql_contacts = "SELECT * FROM contacts";
$result_contacts = $conn->query($sql_contacts);
// Assuming you've already set up a PDO connection named $pdo

$stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $result = $stmt->get_result();
$stmt = $pdo->query("SELECT chariot_tb, pont_tb, palan_tb FROM your_table_name WHERE some_condition");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Determine if checkboxes should be checked
$chariotChecked = $row['chariot_tb'] ? 'checked' : '';
$pontChecked = $row['pont_tb'] ? 'checked' : '';
$palanChecked = $row['palan_tb'] ? 'checked' : '';

?>

// Echo the checkboxes


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data from Database</title>
</head>
<body>
    
    <!-- Display data from products table -->
    <h2>Products</h2>
    <div class="table-responsive">
        <table class="table table-bordered" id="myTable" >
            <thead>

                <tr>
                    <th class="checkbox-area" scope="col">
                        #   
                    </th>
                    <th>items</th>
                    <th scope="col">description</th>
                    <th class="checkbox-area" scope="col">
                        Image
                    </th>
                    <th class="checkbox-area" scope="col">
                        Chariot
                    </th>
                    <th class="checkbox-area" scope="col">
                        Pont
                    </th>
                    <th class="checkbox-area" scope="col">
                        Palan   
                    </th>
                </tr>
            </thead>
        <tbody>
            <?php
            if ($result_products->num_rows > 0) {
                while($row = $result_products->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</line></td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["description"] . "</line></td>";
                    echo "<td><img src='image.php?id=" . $row["imageUpload"] . "' alt='Image'  width='100'></td>";
                    echo '<td>';
                    echo '    <div class="form-check form-check-primary">';
                    echo '        <input class="form-check-input checkbox_child" type="checkbox" name="chariot_tb" value="" ' . $chariotChecked . '>';
                    echo '    </div>';
                    echo '</td>';

                    echo '<td>';
                    echo '    <div class="form-check form-check-primary">';
                    echo '        <input class="form-check-input checkbox_child" type="checkbox" name="pont_tb" value="" ' . $pontChecked . '>';
                    echo '    </div>';
                    echo '</td>';

                    echo '<td>';
                    echo '    <div class="form-check form-check-primary">';
                    echo '        <input class="form-check-input checkbox_child" type="checkbox" name="palan_tb" value="" ' . $palanChecked . '>';
                    echo '    </div>';
                    echo '</td>';

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No products found</td></tr>";
            }
            ?>

    <!-- Display data from contacts table -->
    <h2>Contacts</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Order By</th>
                <th>Address</th>
                <th>city</th>
                <th>zip</th>
                <th>numero de facture</th>
                <th>inspecté par</th>
                <th>date d'inspection</th>
                <th>emplacement</th>
                <th>palan</th>
                <th>model</th>
                <th>chaine</th>
                <th>capacité</th>
                <th>séries</th>
                <th>manufacturier</th>
                <!-- Add other headers as needed -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_contacts->num_rows > 0) {
                while($row = $result_contacts->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["Name_Ins"] . "</td>";
                    echo "<td>" . $row["Order_Ins"] . "</td>";
                    echo "<td>" . $row["inputCity"] . "</td>";
                    echo "<td>" . $row["inputZip"] . "</td>";
                    echo "<td>" . $row["Invoice_Ins"] . "</td>";
                    echo "<td>" . $row["date_Ins"] . "</td>";
                    echo "<td>" . $row["Emplacement_Ins"] . "</td>";
                    echo "<td>" . $row["Palan_Ins"] . "</td>";
                    echo "<td>" . $row["Model_Ins"] . "</td>";
                    echo "<td>" . $row["Chaine_Ins"] . "</td>";
                    echo "<td>" . $row["Capacité_Ins"] . "</td>";
                    echo "<td>" . $row["Serie_Ins"] . "</td>";
                    echo "<td>" . $row["Chaine_Ins"] . "</td>";

                    // Add other columns as needed
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No contacts found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Product form -->
    <h2>Add Product</h2>
    <form action="submit.php" method="POST" enctype="multipart/form-data">
        <!-- Your product form fields here -->
        <input type="submit" name="product_submit" value="Submit Product">
    </form>


</body>
</html>

<?php
$conn->close();
?>
