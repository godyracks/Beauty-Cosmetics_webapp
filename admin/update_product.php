<?php
// Include database connection
include_once('../assets/setup/db.php');

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Get the product_id from the query parameter
    $productId = $_GET["product_id"];

    // Retrieve the product information from the database
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Product found, display the update form
        $productData = $result->fetch_assoc();
        ?>
        <h1>Update Product</h1>
        <form id="updateProductForm" action="update_product.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $productData['product_id']; ?>">
            <div>
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="<?php echo $productData['category']; ?>" required>
            </div>
            <div>
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" value="<?php echo $productData['product_name']; ?>" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $productData['price']; ?>" required>
            </div>
            <button type="submit">Update Product</button>
        </form>
        <?php
    } else {
        // Product not found
        echo "Product not found.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the product update form submission here
    $productId = $_POST["product_id"];
    $category = $_POST["category"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];

    // Update the product in the database
    $sql = "UPDATE products SET category = ?, product_name = ?, price = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $category, $productName, $price, $productId);

    if ($stmt->execute()) {
        // Update was successful, redirect to the admin panel
        header("Location: ../admin/"); // Replace with the actual URL of your admin panel page
        exit; // Make sure to exit to prevent further script execution
    } else {
        echo "Failed to update the product.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
