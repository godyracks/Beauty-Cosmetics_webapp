<?php
//session_start();

// Include your database connection code here
include('../assets/setup/db.php');

// Check if the user is logged in or set a user identifier (e.g., session ID)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : session_id();

// Check if the user wants to update quantities or remove items
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']); // Convert to an integer

    // Update the quantity in the cart
    $updateQuery = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "iss", $quantity, $user_id, $product_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the cart page
        header("Location: ../cart");
        exit();
    } else {
        die("Quantity update error: " . mysqli_error($conn));
    }

    //mysqli_stmt_close($stmt);
}

// Retrieve cart items for the user from the database
$query = "SELECT products.product_name, products.price, cart.quantity, cart.product_id
          FROM cart
          INNER JOIN products ON cart.product_id = products.product_id
          WHERE cart.user_id = ?";
$stmt = mysqli_prepare($conn, $query);

// Check for errors during query preparation
if (!$stmt) {
    die("Query preparation error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $user_id);

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are items in the cart
    if (mysqli_num_rows($result) > 0) {
        ?>
        <!-- Cart -->
        <div class="cart-wrapper" style="background-color: #fff;">
            <h1>Shopping Bag</h1>
            <div class="project">
                <form method="post" action="">
                <div class="shop">
                    <?php
                    // Loop through cart items and display them
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="box">
                            <!-- Adjust the image source as needed -->
                            <img src="../assets/img/curl-wig.png" class="cart-image">
                            <div class="content">
                                <h6><?php echo $row['product_name']; ?></h6>
                                <h5>Price: KES <?php echo number_format($row['price'], 2); ?></h5>
                                <p class="unit">Quantity: 
                                    <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <button type="submit" name="update_quantity">Update</button>
                                </p>
                                <!-- Add a button to remove items from the cart -->
                                <p class="btn-area">
                                    <a href="../cart/?product_id=<?php echo $row['product_id']; ?>">Remove</a>
                                </p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                </form>
                <!-- Calculate and display cart totals -->
                <div class="right-bar">
                    <?php
                    // Calculate subtotal, tax (5% in this example), shipping (replace with actual shipping cost), and total
                    $subtotal = 0;
                    mysqli_data_seek($result, 0); // Reset result set pointer
                    while ($row = mysqli_fetch_assoc($result)) {
                        $subtotal += $row['price'] * $row['quantity'];
                    }
                    $tax = $subtotal * 0.01; // 1% tax
                    $shipping = 150; // Replace with actual shipping cost
                    $total = $subtotal + $tax + $shipping;
                    ?>
                    <p><span>Subtotal</span> <span>KES <?php echo number_format($subtotal, 2); ?></span></p>
                    <hr>
                    <p><span>Tax (1%)</span> <span>KES <?php echo number_format($tax, 2); ?></span></p>
                    <hr>
                    <p><span>Shipping</span> <span>KES <?php echo number_format($shipping, 2); ?></span></p>
                    <hr>
                    <p><span>Total</span> <span>KES <?php echo number_format($total, 2); ?></span></p>
                    <a href="#"><i class="fa fa-shopping-cart"></i>Checkout</a>
                </div>
            </div>
        </div>
        <!-- /Cart -->
    <?php
    } else {
        echo "<p>Your cart is empty.</p>";
    }
} else {
    die("Query execution error: " . mysqli_error($conn));
}

mysqli_stmt_close($stmt);
//mysqli_close($conn);
?>
