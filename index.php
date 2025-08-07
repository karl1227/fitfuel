<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="imgs/FFLogoB.png" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
    
    <div class="navbar">
        <div class="primary-nav">
            <!-- <h1 style="margin-right: 35%;">This website is for academic purposes</h1> -->
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
                <li><a class="active" href="#">HOME</a></li>
                <li><a href="shop.php">SHOP</a></li>
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
    
    <div class="slider-img">
        <img src="imgs/Slider/Home1.png" alt="IMGS">
        <button class="slider-btn"> <a href="shop.php">Shop Now</a></button>
    </div>
    
    <div class="container">
         <!--  CATEGORY -->

        <div class="category">
            <div class="pro-cat">
                <img src="imgs/Categories/1.png" alt="Whey Protein">
            </div>
            <div class="pro-cat">
                <img src="imgs/Categories/2.png" alt="BCAAs">
            </div>
            <div class="pro-cat">
                <img src="imgs/Categories/3.png" alt="Fat Burner">
            </div>
            <div class="pro-cat">
                <img src="imgs/Categories/4.png" alt="Pre Workout">
            </div>
            <div class="pro-cat">
                <img src="imgs/Categories/5.png" alt="Creatine">
            </div>
        </div>
  

        <!--  NEW ARRIVALS SECTION  -->

        <div class="new-arrivals">
            <div class="na-info">
                <h2>New Arrivals</h2>
                <div class="na-info-icon">
                    <a href="#"><i class="fa-solid fa-less-than"></i></a>
                    <a href="#"><i class="fa-solid fa-greater-than"></i></a>
                </div>
            </div>

            <div class="na-products">
              <div class="na-pro-con">

                <a href="product.html" target="_blank">
                    <div class="na-pro-img">
                        <img src="imgs/NewArrivals/NA1.png" alt="Intra-workout">
                    </div>
                </a>
                
                <div class="na-pro-info">
                    <div class="na-pro-info-left">
                        <h3>Intra-workout</h3>
                        <br>
                        <p>Prodcut Description</p>
                        <br>
                        <h3 class="price">₱ 2,499</h3>
                    </div>
                    <div class="na-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
              </div>

              
              <div class="na-pro-con">
                <a href="product.html" target="_blank">
                    <div class="na-pro-img">
                        <img src="imgs/NewArrivals/NA2.png" alt="Pre-workout">
                    </div>
                </a>
                
                <div class="na-pro-info">
                    <div class="na-pro-info-left">
                        <h3>Pre-workout</h3>
                        <br>
                        <p>Prodcut Description</p>
                        <br>
                        <h3 class="price">₱ 2,900</h3>
                    </div>
                    <div class="na-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
              </div>
              <div class="na-pro-con">
                <a href="product.html" target="_blank">
                    <div class="na-pro-img">
                        <img src="imgs/NewArrivals/NA3.png" alt="VitaHD">
                    </div>
                </a>
                
                <div class="na-pro-info">
                    <div class="na-pro-info-left">
                        <h3>VitaHD</h3>
                        <br>
                        <p>Prodcut Description</p>
                        <br>
                        <h3 class="price">₱ 4,499</h3>
                    </div>
                    <div class="na-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
              </div>
            </div>
        </div>
       

        <!--  BEST SELLER SECTION  -->

        <div class="best-seller">
            <div class="bs-info">
                <h2>Best seller</h2>
                <div class="bs-info-icon">
                    <a href="#"><i class="fa-solid fa-less-than"></i></a>
                    <a href="#"><i class="fa-solid fa-greater-than"></i></a>
                </div>
            </div>

            <div class="bs-products">
              <div class="bs-pro-con">
                <a href="product.html" target="_blank">
                    <div class="bs-pro-img">
                        <img src="imgs/BestSeller/BS1.png" alt="Intra-workout">
                    </div>
                </a>
                
                <div class="bs-pro-info">
                    <div class="bs-pro-info-left">
                        <h3>Muscle Tech Whey Protein</h3>
                        <br>
                        <p>4lbs Whey Protein</p>
                        <br>
                        <h3 class="price">₱ 3,899</h3>
                    </div>
                    <div class="bs-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
              </div>
              <div class="bs-pro-con">
                <a href="product.html" target="_blank">
                    <div class="bs-pro-img">
                        <img src="imgs/BestSeller/BS2.png" alt="Intra-workout">
                    </div>
                </a>
                <div class="bs-pro-info">
                    <div class="bs-pro-info-left">
                        <h3>Muscle Tech Fat Burner</h3>
                        <br>
                        <p>Fat Burner</p>
                        <br>
                        <h3 class="price">₱ 2,000</h3>
                    </div>
                    <div class="bs-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
              </div>
              <div class="bs-pro-con">
                <a href="product.html" target="_blank">
                    <div class="bs-pro-img">
                        <img src="imgs/BestSeller/BS3.png" alt="Intra-workout">
                    </div>
                </a>
                <div class="bs-pro-info">
                    <div class="bs-pro-info-left">
                        <h3>Muscle Tech Creatine</h3>
                        <br>
                        <p>2lbs Creatine</p>
                        <br>
                        <h3 class="price">₱ 1,899</h3>
                    </div>
                    <div class="bs-pro-info-right">
                        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
                    </div>
                </div>
              </div>
              
            
            </div>
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

    <div id="custom-alert" class="custom-alert">
        <div class="alert-box">
            <p id="custom-alert-message">Welcome!</p> <!-- Add the correct ID here -->
            <button onclick="closeAlert()">OK</button>
        </div>
    </div>



      <script>
        window.onload = function () {
    setTimeout(function () {
        var username = "<?php echo htmlspecialchars($username); ?>"; // Safe PHP-to-JS variable

        // Set the username in the alert box
        document.getElementById("custom-alert-message").innerHTML = "Welcome, <strong>" + username + "</strong>!" + " This Website is for academic purposes only";


        // Show the alert box
        document.getElementById("custom-alert").style.display = "flex";
    }, 1000); // 1-second delay
};

function closeAlert() {
    document.getElementById("custom-alert").style.display = "none";
}

</script>

</body>
</html>