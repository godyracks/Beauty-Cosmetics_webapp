<?php
// Include database connection
include_once('../assets/setup/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the product_id to delete
    $productId = $_POST["product_id"];

    // Perform the deletion operation in the database
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        // Deletion was successful
        echo json_encode(["success" => true]);
    } else {
        // Deletion failed
        echo json_encode(["success" => false]);
    }
} else {
    // Invalid request method
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
