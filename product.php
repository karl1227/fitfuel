<?php
include("database.php");

$product = null;
$error = '';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $product = $result->fetch_assoc();
    } else {
        $error = "Product not found.";
    }

    $stmt->close();
} else {
    $error = "Invalid product ID.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product ? htmlspecialchars($product['name']) : 'Product' ?></title>
    <link rel="icon" href="imgs/FFLogoB.png" type="image/png">
    <title>Products</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
</head>
<body>

<!-- Navbar -->
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
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li><a href="account.html"><i class="fa-solid fa-user"></i></a></li>
            </div>
        </div>
    </div>
    <hr style="height: 1.5px; background-color: rgb(114, 114, 114); border: none; box-shadow: 1px 1.5px 5px;">
</div>

<!-- Main Content -->
<div class="container">
    <?php if ($product): ?>
    <div class="pro-con">
        <div class="img-con">
            <img src="<?= htmlspecialchars($product['image_url'] ?? 'imgs/default.png') ?>" alt="<?= htmlspecialchars($product['product_name'] ?? 'Product') ?>">

        </div>
        <div class="info-con">
            <h2><?= htmlspecialchars($product['product_name']) ?></h2>
            <h3><?= number_format($product['rating'] ?? 4.9, 1) ?>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </h3>
            <h1>₱ <?= number_format($product['price'], 2) ?></h1>

            <div class="qnty-con">
                <p>Quantity</p>
                <div class="minus-box"><i class="fa-solid fa-circle-minus"></i></div>
                <div class="counting-box"><b>1</b></div>
                <div class="plus-box"><i class="fa-solid fa-circle-plus"></i></div>
            </div>

            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>">
                <input type="hidden" name="product_price" value="<?= htmlspecialchars($product['price']) ?>">
                <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image_url']) ?>">
                <input type="hidden" name="product_desc" value="<?= htmlspecialchars($product['description']) ?>">

                <div class="buttons">
                    <button class="atc-btn" type="submit">Add to cart</button>
                    <button class="bn-btn" type="button" onclick="window.location.href='checkout.php'">Buy Now</button>
                </div>
            </form>

            
        </div>
    </div>
    <?php else: ?>
        <p style="text-align: center; font-size: 1.5rem; margin: 2rem 0;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- May you like -->
    <div class="MYL">
        <div class="na-info">
            <h2>May you like</h2>
            <div class="na-info-icon">
                <a href="#"><i class="fa-solid fa-less-than"></i></a>
                <a href="#"><i class="fa-solid fa-greater-than"></i></a>
            </div>
        </div>

        <div class="na-products">
            <div class="na-pro-con">
                <a href="product.php?id=1" target="_blank">
                    <div class="na-pro-img">
                        <img src="imgs/NewArrivals/NA1.png" alt="Intra-workout">
                    </div>
                </a>
                <div class="na-pro-info">
                    <div class="na-pro-info-left">
                        <h3>Intra-workout</h3>
                        <p>Product Description</p>
                        <h3 class="price">₱ 2,499</h3>
                    </div>
                    <div class="na-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="na-pro-con">
                <a href="product.php?id=2" target="_blank">
                    <div class="na-pro-img">
                        <img src="imgs/NewArrivals/NA2.png" alt="Pre-workout">
                    </div>
                </a>
                <div class="na-pro-info">
                    <div class="na-pro-info-left">
                        <h3>Pre-workout</h3>
                        <p>Product Description</p>
                        <h3 class="price">₱ 2,900</h3>
                    </div>
                    <div class="na-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="na-pro-con">
                <a href="product.php?id=3" target="_blank">
                    <div class="na-pro-img">
                        <img src="imgs/NewArrivals/NA3.png" alt="VitaHD">
                    </div>
                </a>
                <div class="na-pro-info">
                    <div class="na-pro-info-left">
                        <h3>VitaHD</h3>
                        <p>Product Description</p>
                        <h3 class="price">₱ 4,499</h3>
                    </div>
                    <div class="na-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
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
