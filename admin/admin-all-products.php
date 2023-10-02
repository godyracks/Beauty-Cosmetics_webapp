<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('../assets/includes/header.php');
include_once('../assets/includes/navbar.php');

// Connect to your MySQL database
include_once('../assets/setup/db.php');

// Query to fetch all products from the database along with their images
$sql = "SELECT p.product_id, p.category, p.product_name, p.price, pi.image_url
        FROM products p
        LEFT JOIN product_images pi ON p.product_id = pi.product_id";
$result = $conn->query($sql);
?>

<h1>All Products</h1>
<div id="productList">
 <!-- Product list will be displayed here -->
<?php
$previousProductId = null; // Keep track of the previous product ID
while ($row = $result->fetch_assoc()) :
    $productId = $row['product_id'];
    if ($productId !== $previousProductId) {
        // Only display a product card if it's a new product
?>
        <div class="product">
            <h2><?php echo $row['product_name']; ?></h2>
            <p>Category: <?php echo $row['category']; ?></p>
            <p>Price: KES <?php echo $row['price']; ?></p>

            <div class="image-container">
                <?php
                // Retrieve all image URLs for the product
                $imageSql = "SELECT image_url FROM product_images WHERE product_id = ?";
                $stmt = $conn->prepare($imageSql);
                $stmt->bind_param("i", $productId);
                $stmt->execute();
                $imageResult = $stmt->get_result();

                while ($imageRow = $imageResult->fetch_assoc()) :
                    $imageUrl = $imageRow['image_url'];
                ?>
                    <img src="<?php echo $imageUrl; ?>" alt="<?php echo $row['product_name']; ?>">
                <?php endwhile; ?>
            </div>

            <button class="delete-button" onclick="deleteProduct(<?php echo $productId; ?>)">Delete</button>
            <button class="update-button" onclick="updateProduct(<?php echo $productId; ?>)">Update</button>
        </div>
<?php
    }
    $previousProductId = $productId;
endwhile;
?>
</div>

<!-- JavaScript functions for handling delete and update -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function deleteProduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            // Send an AJAX request to delete the product
            $.ajax({
                type: "POST",
                url: "delete_product.php", // Replace with the actual URL for deleting a product
                data: { product_id: productId },
                success: function (response) {
                    if (response.success) {
                        // Reload the page or update the product list
                        location.reload();
                    } else {
                        alert("Failed to delete the product.");
                    }
                },
                error: function () {
                    alert("An error occurred while deleting the product.");
                }
            });
        }
    }

    function updateProduct(productId) {
        // Redirect to a product update page with the product ID
        window.location.href = "update_product.php?product_id=" + productId;
    }
</script>

<?php include_once('../assets/includes/footer.php'); ?>
