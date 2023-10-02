
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
<?php while ($row = $result->fetch_assoc()) : ?>
    <div class="product">
        <?php
        // Retrieve the first image URL for the product
        $productId = $row['product_id'];
        $imageSql = "SELECT image_url FROM product_images WHERE product_id = ? LIMIT 1";
        $stmt = $conn->prepare($imageSql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $imageResult = $stmt->get_result();

        if ($imageResult->num_rows === 1) {
            $imageRow = $imageResult->fetch_assoc();
            $firstImageUrl = $imageRow['image_url'];
        } else {
            // No image found, use a default image
            $firstImageUrl = "default_image.jpg";
        }
        ?>
        <img src="<?php echo $firstImageUrl; ?>" alt="<?php echo $row['product_name']; ?>">
        <button class="delete-button" onclick="deleteProduct(<?php echo $row['product_id']; ?>)">Delete</button>
        <button class="update-button" onclick="updateProduct(<?php echo $row['product_id']; ?>)">Update</button>
    </div>
<?php endwhile; ?>

</div>

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


    <?php include_once('../assets/includes/footer.php') ?>
