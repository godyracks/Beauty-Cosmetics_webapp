<?php
include_once('../assets/setup/db.php');

// Assuming you are using MySQLi for database connection
$sql = "SELECT p.*, i.image_url 
        FROM products p
        JOIN product_images i ON p.product_id = i.product_id";

$result = $conn->query($sql);

// Check for query execution success
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch only one row (assuming you want to display one product card)
$row = $result->fetch_assoc();
?>

<section class="products">
    <h2 style="background-color: #fff;">Lace Wigs</h2>
    <div class="all-products">
        <div class="product">
            <div class="product-image-container">
                <a href="../details" style="background-color: white;">
                    <img src="../uploads/<?php echo $row['image_url']; ?>">
                    <div class="product-icons">
                        <a href="../wishlist"><i class='bx bx-heart'></i></a>
                    </div>
                </a>
            </div>
            <div class="product-info">
                <h4 class="product-title"><?php echo $row['product_name']; ?></h4>
                <p class="product-price">KES <?php echo number_format($row['price'], 2); ?></p>
                <a class="product-btn" href="#">Buy Now</a>
            </div>
        </div>
    </div>
</section>
