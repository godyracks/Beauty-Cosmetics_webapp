<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    // Retrieve and sanitize input values
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']); // Convert to an integer

    // You can add additional validation here, such as checking if the product exists in the database.

    // Check if the user is logged in or set a user identifier (e.g., session ID)
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : session_id();

    // Include your database connection code here
    include('../assets/setup/db.php');

    // Insert the product into the cart table
    $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "ssi", $user_id, $product_id, $quantity);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['cart_message'] = "Product added to cart successfully!";
        $_SESSION['cart_message_class'] = "success";
    } else {
        $_SESSION['cart_message'] = "Failed to add product to cart. Please try again.";
        $_SESSION['cart_message_class'] = "error";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    // Redirect back to the product listing page
    header("Location: ../categories/?name=$productName");
    exit();
} else {
    // Handle invalid requests or direct access to this script
    echo "Invalid request.";
}
?>
