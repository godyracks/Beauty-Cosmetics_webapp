<?php


// Include your database connection code here
include('../assets/setup/db.php');

// Check if the user is logged in or set a user identifier (e.g., session ID)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : session_id();

// Retrieve cart items for the user from the database
$query = "SELECT products.product_name, products.price, cart.quantity
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
        <div class="cart-wrapper">
            <h1>Shopping Bag</h1>
            <div class="project">
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
                                <p class="unit">Quantity: <input name="" value="<?php echo $row['quantity']; ?>"></p>
                                <!-- Add a button to remove items from the cart -->
                                <p class="btn-area">
                                    <i aria-hidden="true" class="fa fa-trash"></i>
                                    <span class="btn2"></span>
                                </p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- Calculate and display cart totals -->
                <div class="right-bar">
                    <?php
                    // Calculate subtotal, tax (5% in this example), shipping (replace with actual shipping cost), and total
                    $subtotal = 0;
                    mysqli_data_seek($result, 0); // Reset result set pointer
                    while ($row = mysqli_fetch_assoc($result)) {
                        $subtotal += $row['price'] * $row['quantity'];
                    }
                    $tax = $subtotal * 0.05; // 5% tax
                    $shipping = 1450; // Replace with actual shipping cost
                    $total = $subtotal + $tax + $shipping;
                    ?>
                    <p><span>Subtotal</span> <span>KES <?php echo number_format($subtotal, 2); ?></span></p>
                    <hr>
                    <p><span>Tax (5%)</span> <span>KES <?php echo number_format($tax, 2); ?></span></p>
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
