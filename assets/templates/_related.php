<?php
include_once('../assets/setup/db.php');

// Assuming you are using MySQLi for database connection
$sql = "SELECT p.*, i.image_url 
        FROM products p
        JOIN (
            SELECT product_id, MIN(image_id) AS min_image_id
            FROM product_images
            GROUP BY product_id
        ) min_images
        ON p.product_id = min_images.product_id
        JOIN product_images i
        ON min_images.min_image_id = i.image_id";

$result = $conn->query($sql);

// Check for query execution success
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<section class="products">
    <h2 style="background-color: #fff; color: grey;">Most Frequently Purchased</h2>
    <div class="all-products">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="product">
                <div class="product-image-container">
                    <a href="../details/?id=<?php echo $row['product_id']; ?>" style="background-color: white;">
                        <img src="../uploads/<?php echo $row['image_url']; ?>">
                        <div class="product-icons">
                            <a href="../wishlist"><i class='bx bx-heart'></i></a>
                        </div>
                    </a>
                </div>
                <div class="product-info">
                    <h4 class="product-title"><?php echo $row['product_name']; ?></h4>
                    <p class="product-price">KES <?php echo number_format($row['price'], 2); ?></p>
                    <form action="../cart/add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                        <input type="number" name="quantity" value="1" min="1">
                        <button type="submit" name="add_to_cart" class="product-btn" >Add To Bag</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
