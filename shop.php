<?php
session_start();
include("database.php");

// Fetch all categories
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Determine selected category
$category_id = isset($_GET['category']) && $_GET['category'] !== 'all' ? (int)$_GET['category'] : 'all';

// Build product query based on selected category
if ($category_id === 'all') {
    $productQuery = "SELECT * FROM products";
} else {
    $productQuery = "SELECT * FROM products WHERE category_id = $category_id";
}
$productResult = mysqli_query($conn, $productQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>
    <link rel="icon" href="imgs/FFLogoB.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/shop.css">

    <style>
                .category-filter {
            text-align: center;
            margin: 20px 0;
        }
        .category-filter button {
            margin: 5px;
            padding: 10px 15px;
            font-size: 14px;
            background-color: #ff6f61;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .category-filter button:hover {
            background-color: #e65a4d;
        }
        .shop-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .product-card {
            width: 300px;
            margin: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: scale(1.03);
        }
        .pro-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .pro-info {
            padding: 15px;
        }
        .pro-info-left h3,
        .pro-info-left p {
            margin: 0 0 10px;
        }
        .pro-info-left span {
            font-weight: bold;
            color: #333;
        }
        .pro-info-right form {
            margin-top: 10px;
        }
        .pro-info-right input[type="number"] {
            width: 50px;
            padding: 5px;
        }
        .pro-info-right button {
            background-color: #ff6f61;
            color: white;
            padding: 10px 15px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 5px;
        }
        .pro-info-right button:hover {
            background-color: #e65a4d;
        }
    </style>



    </style>

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
                <li><a class="active" href="#">SHOP</a></li>
                <li><a href="blog.html">BLOG</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="contact.html">CONTACT</a></li>
                <div class="search-bar">
                    <li><a href="#" onclick="window.alert('Sorry, this feature is not available'); return false;">Search <i class="fa-solid fa-magnifying-glass"></i></a></li> 
                </div>
    
                <div class="nav-icon">
                    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    <li><a href="account.php"><i class="fa-solid fa-user"></i></a></li>
                </div>
            </div>
        </div>
        <hr style="height: 1.5px; background-color: rgb(114, 114, 114); border: none; box-shadow: 1px 1.5px 5px;">
    </div>
    
<div class="container">
    <div class="shop-banner">
        <img src="imgs/Banner/ShopBanner.png" alt="Cart Banner">
    </div>

<!-- Category filter buttons -->
    <div class="category-filter">
        <button onclick="filterCategory('all')">All</button>
        <?php while ($categoryRow = mysqli_fetch_assoc($categoryResult)) { ?>
            <button onclick="filterCategory(<?php echo (int)$categoryRow['category_id']; ?>)">
                <?php echo htmlspecialchars($categoryRow['category_name']); ?>
            </button>
        <?php } ?>
    </div>
<!-- Products list -->
 <div class="shop-container">
        <?php while ($productRow = mysqli_fetch_assoc($productResult)) {
            $productName = htmlspecialchars($productRow['product_name']);
            $productDescription = htmlspecialchars($productRow['description']);
            $productPrice = number_format($productRow['price'], 2);
            $productImage = !empty($productRow['image_url']) ? $productRow['image_url'] : 'imgs/default.png';
        ?>
            <div class="product-card">
                <div class="pro-image">
                    <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
                </div>
                <div class="pro-info">
                    <div class="pro-info-left">
                        <h3><?php echo $productName; ?></h3>
                        <p><?php echo $productDescription; ?></p>
                        <span>₱<?php echo $productPrice; ?></span>
                    
                    </div>
                    <div class="pro-info-right">
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo (int)$productRow['product_id']; ?>">
                           
                            <button type="submit"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
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

<script src="js/shop.js"></script>




</body>
</html>