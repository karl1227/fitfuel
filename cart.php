<?php
session_start();
require 'database.php'; // Your DB connection file

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items from database
$stmt = $conn->prepare("
    SELECT ci.cart_item_id, ci.product_id, ci.quantity, 
           p.product_name, p.price, p.image_url 
    FROM cart_items ci 
    JOIN products p ON ci.product_id = p.product_id 
    WHERE ci.user_id = ?
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$total = 0;

while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total += $row['price'] * $row['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="icon" href="imgs/FFLogoB.png" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">

</head>
<body>
    
    <div class="navbar">
        <div class="primary-nav">
            <li><a href="reviews.html" target="_blank">Review</a> |</li>
            <li><a href="faqs.html" target="_blank">Help</a> |</li>
            <li><a href="account.php">Account</a> |</li>
            <li><a href="login.php">Login</a></li>
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
                    <li><a class="active" href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    <li><a href="account.php"><i class="fa-solid fa-user"></i></a></li>
                </div>
            </div>
        </div>
        <hr style="height: 1.5px; background-color: rgb(114, 114, 114); border: none; box-shadow: 1px 1.5px 5px;">
    </div>

    <div class="container">
    <div class="banner-con">
        <img src="imgs/Banner/CartBanner.png" alt="Cart Banner">
    </div>

    <form action="update_cart.php" method="POST">
    <table class="my-table">
        <thead>
            <tr>
                <th class="item1">Product</th>
                <th class="item2">Unit Price</th>
                <th class="item2">Quantity</th>
                <th class="item2">Total Price</th>
                <th class="item2">Action</th>
            </tr>
        </thead>
<tbody>
<?php if (!empty($cart_items)): ?>
    <?php foreach ($cart_items as $item): ?>
        <tr>
            <td>
                <img src="<?php echo $item['image_url']; ?>" width="100" alt="<?php echo $item['product_name']; ?>" />
                <h3><?php echo $item['product_name']; ?></h3>
            </td>
            <td>₱<?php echo number_format($item['price'], 2); ?></td>
<td>
    <form action="update_cart.php" method="POST" class="quantity-form">
        <input type="hidden" name="cart_item_id" value="<?php echo $item['cart_item_id']; ?>">
        <button type="submit" name="action" value="decrease">-</button>
        <?php echo $item['quantity']; ?>
        <button type="submit" name="action" value="increase">+</button>
    </form>
</td>


            <td>₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
            <td><a href="remove.php?id=<?php echo $item['cart_item_id']; ?>">Remove</a></td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
</tbody>
    </table>
    </form>


    <div class="cart-summary">
        <h4>Total: ₱
            <?php 
            $total = 0;
            // Calculate the total price of the cart items
           $total = 0;
            foreach ($cart_items as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            echo number_format($total, 2);

            ?>
        </h4>
        <button class="checkout-btn">Proceed to Checkout</button>
    </div>
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


<script>
document.querySelectorAll('.quantity-btn').forEach(button => {
    button.addEventListener('click', function () {
        const form = this.closest('.quantity-form');
        const cartItemId = form.getAttribute('data-cart-id');
        const action = this.getAttribute('data-action');

        console.log(`Sending request: cart_item_id=${cartItemId}, action=${action}`);

        fetch('update_cart_quantity.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `cart_item_id=${cartItemId}&action=${action}`
        })
        .then(response => response.text())
        .then(newQty => {
            console.log('Response from server:', newQty);
            if (parseInt(newQty) > 0) {
                document.getElementById(`qty-${cartItemId}`).textContent = newQty;
            } else {
                console.log('Quantity zero or invalid.');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
    });
});

</script>



</body>
</html>