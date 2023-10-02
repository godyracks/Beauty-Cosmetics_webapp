
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('../assets/includes/header.php') ?>
<?php include_once('../assets/includes/navbar.php') ?>
<?php
 // Connect to your MySQL database
 include_once('../assets/setup/db.php');
     // Query to fetch three products from the database along with their images
     $sql = "SELECT p.product_id, p.category, p.product_name, p.price, pi.image_url
     FROM products p
     LEFT JOIN product_images pi ON p.product_id = pi.product_id
     LIMIT 3";
     $result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form submission
   

    $category = $_POST["category"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];

    // Insert product into products table
    $sql = "INSERT INTO products (category, product_name, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $category, $productName, $price);
    
    if ($stmt->execute()) {
        $productId = $conn->insert_id;

        // Handle product images
        $targetDir = "../uploads/";
        $uploadedFiles = $_FILES["images"]["name"];
        $imageUrls = [];

        foreach ($uploadedFiles as $key => $fileName) {
            $targetFile = $targetDir . basename($fileName);
            if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFile)) {
                $imageUrls[] = $targetFile;

                // Insert image URLs into product_images table
                $sql = "INSERT INTO product_images (product_id, image_url) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is", $productId, $targetFile);
                $stmt->execute();
            }
        }

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }

    
}


?>
<style>
    .product {
        /* Style for the product card */
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
    }

    .image-container {
        /* Enable horizontal scrolling */
        overflow-x: scroll;
        white-space: nowrap;
    }

    .image-container img {
        /* Style for individual images */
        width: 100px; /* Adjust the image width as needed */
        height: auto;
        margin-right: 10px; /* Add spacing between images */
    }
</style>



    <h1>Admin Panel</h1>
    <form id="productForm" enctype="multipart/form-data" action="" method="POST">
        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
        </div>
        <div>
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>
        </div>
        <div>
            <label for="images">Images:</label>
            <input type="file" id="images" name="images[]" multiple accept="image/*" required>
        </div>
        <button type="submit">Add Product</button>
    </form>
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
<!-- Add a "View All Products" button -->
<button onclick="viewAllProducts()">View All Products</button>
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

    function viewAllProducts() {
        // Redirect to the "View All Products" page
        window.location.href = "admin-all-products.php";
    }
</script>


    <?php include_once('../assets/includes/footer.php') ?>
