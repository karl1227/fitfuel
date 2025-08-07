<?php
session_start();
if (isset($_GET['updated'])) {
    echo "<p style='color:green;'>User updated successfully.</p>";
} elseif (isset($_GET['deleted'])) {
    echo "<p style='color:green;'>User deleted successfully.</p>";
} elseif (isset($_GET['error'])) {
    if ($_GET['error'] === 'cant_delete_self') {
        echo "<p style='color:red;'>You cannot delete your own account.</p>";
    } elseif ($_GET['error'] === 'delete_failed') {
        echo "<p style='color:red;'>Failed to delete user.</p>";
    }
}

include('database.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$stmt = $conn->prepare("
    SELECT r.firstname, r.lastname, r.email, r.telephone, r.address, r.dob, u.is_admin
    FROM register r
    JOIN user u ON r.register_id = u.register_id
    WHERE r.register_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}

// Fetch cart items
if ($user['is_admin']) {
    // Admin: get all cart items
    $cart_stmt = $conn->prepare("
        SELECT 
            ci.cart_item_id,
            ci.quantity,
            ci.added_at,
            p.product_name,
            r.firstname
        FROM cart_items ci
        JOIN products p ON ci.product_id = p.product_id
        JOIN register r ON ci.user_id = r.register_id
        ORDER BY ci.added_at DESC
    ");
} else {
    // Regular user: get own cart items
    $cart_stmt = $conn->prepare("
        SELECT 
            ci.cart_item_id,
            ci.quantity,
            ci.added_at,
            p.product_name,
            r.firstname
        FROM cart_items ci
        JOIN products p ON ci.product_id = p.product_id
        JOIN register r ON ci.user_id = r.register_id
        WHERE ci.user_id = ?
        ORDER BY ci.added_at DESC
    ");
    $cart_stmt->bind_param("i", $user_id);
}

$cart_stmt->execute();
$cart_result = $cart_stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="icon" href="imgs/FFLogoB.png" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/account.css">

    <style>
.container {
    margin: 2rem 8%; 
    padding: 0 1rem;
    font-family: 'Cousine', monospace, Arial, sans-serif;
    color: #222;
    display: flex;
    flex-direction: column;
    min-height: 80vh;
}

h1 {
    margin-bottom: 2rem;
    font-weight: 700;
    font-size: 2.2rem;
    text-align: center;
    color: #111;
}


.admin-dashboard {
    margin-top: auto; 
    background: #fff;
    padding: 1.5rem;
    border-radius: 6px;
    box-shadow: 0 0 12px rgb(0 0 0 / 0.05);
    color: #333;
}

.admin-dashboard h2 {
    font-weight: 600;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    border-bottom: 1px solid #ddd;
    padding-bottom: 0.5rem;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

thead tr {
    background-color: #f5f5f5;
}

th, td {
    padding: 15px 12px;
    text-align: left;
    border-bottom: 1px solid #eee;
    color: #444;
}

th {
    font-weight: 600;
    background: black;
    color: white;
}


a.delete-link {
    color: #d9534f;
}

a.delete-link:hover {
    color: #b52b27;
}

    </style>


</head>
<body>
  <?php if (isset($_GET['updated'])): ?>
    <p style="color: green;">✅ Info updated successfully!</p>
<?php endif; ?>
    
    <div class="navbar">
        <div class="primary-nav">
            <li><a href="reviews.html" target="_blank">Review</a> |</li>
            <li><a href="faqs.html" target="_blank">Help</a> |</li>
            <li><a href="account.php">Account</a> |</li>
            <li><a href="logout.php">Logout</a></li>

        </div>
    
        <div class="secondary-nav">
            <div class="logo">
                <img src="imgs/FFLogoB.png" alt="Logo" style="height: 100px; width: 100%;">
            </div>
            
            <div class="navigation">
                <li><a href="index.php">HOME</a></li>
                <li><a href="shop.php">SHOP</a></li>
                <li><a href="blog.html">BLOG</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="contact.html">CONTACT</a></li>
    
                <div class="search-bar">
                    <li><a href="#" onclick="window.alert('Sorry, this feature is not available'); return false;">Search <i class="fa-solid fa-magnifying-glass"></i></a></li> 
                </div>
    
                <div class="nav-icon">
                    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    <li><a class="active" href="account.php"><i class="fa-solid fa-user"></i></a></li>
                </div>
            </div>
        </div>
        <hr style="height: 1.5px; background-color: rgb(114, 114, 114); border: none; box-shadow: 1px 1.5px 5px;">
    </div>

 <div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($user['firstname']); ?>!</h1>
<?php if ($user['is_admin'] == 1): ?>

<div class="admin-dashboard" style="margin-top: 2rem;">

    <h2>👥 User Accounts Table (Admin View)</h2>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; background: #fff;">
        <thead>
            <tr style="background-color: #ddd;">
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all users for admin view
            $all_users_stmt = $conn->prepare("
                SELECT r.register_id, r.firstname, r.lastname, r.email, r.telephone, r.address, r.dob
                FROM register r
                JOIN user u ON r.register_id = u.register_id
            ");
            $all_users_stmt->execute();
            $all_users_result = $all_users_stmt->get_result();

            while ($row = $all_users_result->fetch_assoc()):
            ?>
                <tr>
                    <td><?php echo $row['register_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                    <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['dob']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['register_id']; ?>" style="color: blue;">Edit</a> |
                        <a href="delete_user.php?id=<?php echo $row['register_id']; ?>" style="color: red;" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

        <?php endif; ?>


        <h2>My Cart Items</h2>
<?php if ($cart_result->num_rows > 0): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Cart Item ID</th>
            <th>First Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Added At</th>
        </tr>
        <?php while ($item = $cart_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $item['cart_item_id']; ?></td>
                <td><?php echo htmlspecialchars($item['firstname']); ?></td>
                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['added_at']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No cart items found.</p>
<?php endif; ?>

    </div>


    
    <div class="footer">
      <hr style="margin-top: 8%;">
      <div class="primary-footer">
          <div class="ftr-col">
              <h4>Need Help?</h4>
              <br><br>
              <li><a href="faqs.html" target="_blank">FAQ</a></li>
              <li><a href="faqs.html" target="_blank">Get Help</a></li>
              <li><a href="debug.html" target="_blank">Order Status</a></li>
              <li><a href="debug.html" target="_blank">Delivery</a></li>
              <li><a href="debug.html" target="_blank">Returns</a></li>
              <li><a href="debug.html" target="_blank">Payment Options</a></li>
              <li><a href="contact.html" target="_blank">Contact Us</a></li>
          </div>
  
          <div class="ftr-col">
              <h4>My Account</h4>
              <br><br>
              <li><a href="account.php">Account</a></li>
              <li><a href="signup.php">Register</a></li>
              <li><a href="cart.php" target="_blank">View Cart</a></li>
              <li><a href="debug.html" target="_blank">Wish List</a></li>
              <li><a href="reviews.html" target="_blank">Reviews</a></li>
          </div>
  
          <div class="ftr-col">
              <h4>Follow us</h4>
              <br><br>
              <li><a href="https://www.facebook.com/share/16CgNcHnRo/?mibextid=qi2Omg" target="_blank">Facebook</a></li>
              <li><a href="https://www.instagram.com/fitfuel.ph?igsh=MTZqcXJ3M2FuNGNkaQ%3D%3D&utm_source=qr" target="_blank">Instagram</a></li>
              <li><a href="https://x.com/fitfuel_ph?s=21&t=Fgr1mL3INxQ3v-nXiXqD2g" target="_blank">Twitter/X</a></li>
              <li><a href="https://www.tiktok.com/@fitfuelph?_t=ZS-8w4AO2n3AsD&_r=1" target="_blank">Tiktok</a></li>
              <li><a href="https://youtube.com/@fitfuel-supplements?si=bY4Ym0-A3u4eYnwk" target="_blank">Youtube</a></li>
          </div>
      </div>
  
      <div class="secondary-footer">
          <h3>© 2025 FitFuel | All rights reserved.</h3>
          <div class="ftr-li-a">
              <li><a href="ToS.html" target="_blank"><h3>Terms of Service</h3></a></li>
              <li><a href="PP.html" target="_blank"><h3>Privacy Policy</h3></a></li>
              <li><a href="CP.html" target="_blank"><h3>Cookie Policy</h3></a></li>
          </div>

      </div>
  </div>




</body>
</html>