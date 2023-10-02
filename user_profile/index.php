<?php
//session_start();
$user_id = $_SESSION['SESSION_EMAIL'];

if (!isset($user_id)) {
    header('location:../login');
    exit();
}

include_once('../assets/setup/db.php');
include_once('../assets/includes/header.php');
include_once('../assets/includes/navbar.php');

// Retrieve user information
$query_user = "SELECT * FROM user_info WHERE email = '$user_id'";
$result_user = mysqli_query($conn, $query_user);

$userName = ''; // Initialize the user name variable

if ($result_user->num_rows > 0) {
    $row = $result_user->fetch_assoc();
    // Store the retrieved data in variables
    $userName = $row['name'];
    // ... (repeat for other user-related columns)
} else {
    echo "User information not found!";
}

// Retrieve the most recent order for the user
// Retrieve the most recent order for the user
$query_order = "SELECT * FROM orders WHERE email = '$user_id' ORDER BY order_time DESC LIMIT 1";
$result_order = mysqli_query($conn, $query_order);

$orderName = '';
$orderEmail = '';

if ($result_order->num_rows > 0) {
    $row = $result_order->fetch_assoc();
    // Store the retrieved data in variables
    $orderName =  $userName;
    $orderEmail = $row['email'];
    // ... (repeat for other columns)
} else {
    echo "Order not found!";
}

 ?>
 <style>
    

/* Apply basic styling to header and sections */
.profile,{
    
}
.profile, .main-profile {
  padding: 20px;
  
}

.profile {
    margin-top: 50px;
  background-color: #333;
  color: #fff;
  text-align: center;
}

.profile-header img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
}

.profile-header h1 {
  font-size: 24px;
}

.profile-link {
  color: #007BFF;
  text-decoration: none;
}

/* Style each section as needed */
.order-history, .wishlist, .address-book, .payment-methods, .account-settings {
  /* margin-bottom: 30px;
  padding: 20px;
  border: 1px solid #ddd;
  background-color: #f9f9f9; */
}


  /* Style the Order History section */
  .order-history {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
  }
  
  .order-history h2 {
      font-size: 20px;
      margin-bottom: 10px;
  }
  
  /* Style the individual order items */
  .order-item {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
  }
  
  .order-info {
      flex-grow: 1;
  }
  
  .order-info p {
      margin: 5px 0;
  }
  
  .order-actions a {
      color: #007BFF;
      text-decoration: none;
      margin-left: 10px;
  }
  
  /* Style the order status based on its state (you can add more styles as needed) */
  .order-info p:contains("Status: Shipped") {
      color: #28a745; /* Green for shipped orders */
  }
  
  .order-info p:contains("Status: Processing") {
      color: #ffc107; /* Yellow for processing orders */
  }
  
  .order-info p:contains("Status: Delivered") {
      color: #007BFF; /* Blue for delivered orders */
  }
  
  .order-info p:contains("Status: Cancelled") {
      color: #dc3545; /* Red for cancelled orders */
  }
  
  /* Style the Wishlist section */
  .wishlist {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
  }
  
  .wishlist h2 {
      font-size: 20px;
      margin-bottom: 10px;
  }
  
  /* Style the individual wishlist items */
  .wishlist-item {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
  }
  
  .wishlist-item img {
      max-width: 100px;
      max-height: 100px;
      margin-right: 10px;
  }
  
  .wishlist-details {
      flex-grow: 1;
  }
  
  .wishlist-details h3 {
      font-size: 18px;
      margin-bottom: 5px;
  }
  
  .wishlist-details p {
      margin: 5px 0;
  }
  
  /* Style the "Remove" button */
  .remove-from-wishlist {
      background-color: #dc3545; /* Red */
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
  }
  
  /* Style the "Remove" button on hover */
  .remove-from-wishlist:hover {
      background-color: #c82333; /* Darker red */
  }
  
  
  /* Style the Address Book section */
  .address-book {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
  }
  
  .address-book h2 {
      font-size: 20px;
      margin-bottom: 10px;
  }
  
  /* Style the individual address items */
  .address-item {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
  }
  
  .address-details {
      flex-grow: 1;
  }
  
  .address-details h3 {
      font-size: 18px;
      margin-bottom: 5px;
  }
  
  .address-details p {
      margin: 5px 0;
  }
  
  /* Style the "Edit" and "Delete" buttons */
  .edit-address, .delete-address {
      background-color: #007BFF; /* Blue for Edit button and Red for Delete button */
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      margin-right: 5px;
  }
  
  /* Style the "Add New Address" button */
  .add-address {
      background-color: #28a745; /* Green */
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      margin-top: 10px;
  }
  
  /* Style buttons on hover */
  .edit-address:hover, .delete-address:hover, .add-address:hover {
      filter: brightness(1.2); /* Slightly increase brightness on hover */
  }
  /* Style the Payment Methods section */
  .payment-methods {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
  }
  
  .payment-methods h2 {
      font-size: 20px;
      margin-bottom: 10px;
  }
  
  /* Style the individual payment method items */
  .payment-item {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
  }
  
  .payment-details {
      flex-grow: 1;
  }
  
  .payment-details img {
      max-width: 50px;
      max-height: 30px;
      margin-right: 10px;
  }
  
  .payment-details p {
      margin: 5px 0;
  }
  
  /* Style the "Edit" and "Delete" buttons */
  .edit-payment, .delete-payment {
      background-color: #007BFF; /* Blue for Edit button and Red for Delete button */
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      margin-right: 5px;
  }
  
  /* Style the "Add New Payment Method" button */
  .add-payment {
      background-color: #28a745; /* Green */
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      margin-top: 10px;
  }
  
  /* Style buttons on hover */
  .edit-payment:hover, .delete-payment:hover, .add-payment:hover {
      filter: brightness(1.2); /* Slightly increase brightness on hover */
  }
  
  /* Style the Account Settings section */
  .account-settings {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
  }
  
  .account-settings h2 {
      font-size: 20px;
      margin-bottom: 10px;
  }
  
  /* Style the settings form */
  .settings-form {
      max-width: 400px;
      margin: 0 auto;
  }
  
  .form-group {
      margin-bottom: 20px;
  }
  
  label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
  }
  
  input[type="password"],
  select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
  }
  
  /* Style the "Save Settings" button */
  .save-settings {
      background-color: #007BFF; /* Blue */
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
  }
  
  /* Style button on hover */
  .save-settings:hover {
      filter: brightness(1.2); /* Slightly increase brightness on hover */
  }
  

/* Add more specific CSS as needed for each section */
/* Style the user's first initial */
.user-initial {
    display: inline-block;
    width: 50px;
    height: 50px;
    background-color: #007BFF; /* Choose your desired background color */
    color: #fff;
    text-align: center;
    font-size: 24px;
    line-height: 50px;
    border-radius: 50%;
    margin-right: 15px;
}



 </style>

<header class="profile">
        <div class="profile-header">
        <div class="profile-initial">
            <?php
                // Extract the first initial of the user's name
                $userInitial = substr($orderName, 0, 1);
            ?>
            <span class="user-initial"><?php echo $userInitial; ?></span>
        </div>
            <h1>Hi, <?php echo $orderName; ?> !</h1>
            <p>Email: <?php echo $orderEmail; ?></p>
            <a href="edit-profile.html" class="profile-link">Edit Profile</a>
        </div>
    </header>

    <main class="main-profile">
        <section class="order-history">
            <h2>Order History</h2>
            <ul class="order-list">
                <li class="order-item">
                    <div class="order-info">
                        <p>Order Number: #123456</p>
                        <p>Date: January 15, 2023</p>
                        <p>Status: Shipped</p>
                    </div>
                    <div class="order-actions">
                        <a href="order-details.html" class="profile-link" >View Details</a>
                        <a href="#" class="profile-link">Track Order</a>
                    </div>
                </li>
                <!-- Repeat this structure for each order -->
            </ul>
        </section>
        

        <section class="wishlist">
            <h2>Wishlist</h2>
            <ul class="wishlist-items">
                <li class="wishlist-item">
                    <img src="product1.jpg" alt="Product 1">
                    <div class="wishlist-details">
                        <h3>Product Name 1</h3>
                        <p>Price: $29.99</p>
                        <button class="remove-from-wishlist">Remove</button>
                    </div>
                </li>
                <!-- Repeat this structure for each wishlist item -->
            </ul>
        </section>
        

        <section class="address-book">
            <h2>Address Book</h2>
            <ul class="address-list">
                <li class="address-item">
                    <div class="address-details">
                        <h3>Shipping Address</h3>
                        <p>Name: John Doe</p>
                        <p>Address: 123 Main St, Apt 4B</p>
                        <p>City: Anytown</p>
                        <p>State: CA</p>
                        <p>ZIP: 12345</p>
                    </div>
                    <div class="address-actions">
                        <button class="edit-address">Edit</button>
                        <button class="delete-address">Delete</button>
                    </div>
                </li>
                <!-- Repeat this structure for each address -->
            </ul>
            <button class="add-address">Add New Address</button>
        </section>
        

        <section class="payment-methods">
            <h2>Payment Methods</h2>
            <ul class="payment-list">
                <li class="payment-item">
                    <div class="payment-details">
                        <img src="card-icon.png" alt="Credit Card">
                        <p>Card Type: Visa</p>
                        <p>Card Number: **** **** **** 1234</p>
                        <p>Expiry Date: 12/24</p>
                    </div>
                    <div class="payment-actions">
                        <button class="edit-payment">Edit</button>
                        <button class="delete-payment">Delete</button>
                    </div>
                </li>
                <!-- Repeat this structure for each payment method -->
            </ul>
            <button class="add-payment">Add New Payment Method</button>
        </section>
        

        <section class="account-settings">
            <h2>Account Settings</h2>
            <form class="settings-form">
                <div class="form-group">
                    <label for="password">Change Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password">
                </div>
                <div class="form-group">
                    <label for="email-preferences">Email Preferences:</label>
                    <select id="email-preferences" name="email-preferences">
                        <option value="1">Receive newsletters and promotions</option>
                        <option value="0">Do not receive newsletters and promotions</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="privacy-settings">Privacy Settings:</label>
                    <select id="privacy-settings" name="privacy-settings">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>
                <button type="submit" class="save-settings">Save Settings</button>
            </form>
        </section>
        

        <!-- Other profile sections go here -->
    </main>


    <?php include_once('../assets/includes/footer.php') ?>
