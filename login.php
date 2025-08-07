<?php
session_start();
include("database.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['register_id'] = $user['register_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: account.php");
        exit();
    }
    else {
            $_SESSION['error_message'] = "Invalid password!";
        }
    } else {
        $_SESSION['error_message'] = "User not found!";
    }
}
?>


<!-- Login Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="imgs/FFLogoB.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/root.css">

    <style>
        body {
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-image: url('imgs/LS.png');
        }
         .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-alert {
            width: 150px;
            height: 150px;
            background-color: #f0f0f0;
            border: 2px solid #ccc;
            border-radius: 6px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .modal-header {
            background-color: #0078D7;
            color: white;
            padding: 4px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .modal-title {
            font-weight: bold;
        }

        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .modal-body {
            padding: 10px;
            text-align: center;
            font-size: 13px;
            color: #333;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-footer {
            padding: 5px;
            text-align: center;
            background-color: #f5f5f5;
        }

        .modal-footer button {
            padding: 5px 15px;
            font-size: 12px;
            background-color: #0078D7;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .modal-footer button:hover {
            background-color: #005a9e;
        }

    </style>

</head>
<body>
    <?php if (isset($_SESSION['error_message'])): ?>
<div class="modal-overlay">
    <div class="modal-alert">
        <div class="modal-header">
            <span class="modal-title">Alert</span>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p><?php echo $_SESSION['error_message']; ?></p>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal()">OK</button>
        </div>
    </div>
</div>
<?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

    <div class="container">
        <div class="left-col">
            <div class="img-con">
                <img src="imgs/ITFUEL2.png" alt="Logo">
            </div>
            <h3>
                Fuel your fitness, <br>
                find the right supplements, <br>
                track your orders & power up <br>
                your performance.
            </h3>
            <div class="con-social">
                <h2>Connect with us </h2>
                <div class="soc-imgs">
                    <li><a href=""><img src="imgs/social/facebook.png" alt="facebook logo"></a></li>
                    <li><a href=""><img src="imgs/social/google.png" alt="google logo"></a></li>
                    <li><a href=""><img src="imgs/social/instagram.png" alt="instagram logo"></a></li>
                    <li><a href=""><img src="imgs/social/tiktok.png" alt="tiktok logo"></a></li>
                </div>
            </div>
        </div>

        <div class="right-col">
            <form action="login.php" method="POST"> 
                <h1>Login</h1>
                <input type="text" name="username" id="username" placeholder="Username" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br>

                <div class="cb-sec">
                    <div class="cb-left">
                        <input type="checkbox" class="checkbox" name="remember-me"> <p>Remember me</p>
                    </div>
                    <a href="forgot-password.html">Forgot password?</a>
                </div>

                <div class="btn-container">
                    <button type="submit">LOGIN</button>
                </div>

                <div class="or-divider">
                    <span>OR</span>
                </div>

                <div class="btn-container">
                    <button type="button" class="scndy-btn"><i class="fa-brands fa-facebook"></i> Facebook</button>
                    <button type="button" class="scndy-btn">
                        <a href="https://google.com" target="_blank"><img src="imgs/goolge-icon.png" width="40" height="40" alt="Google Icon"> Google</a>
                    </button>
                </div>

                <p class="sign-text">
                    Don’t have an account? <a href="signup.php"><b><span>Signup</span></b></a>
                </p><br>
            </form>
        </div>
    </div>


    <script>
function closeModal() {
    document.querySelector('.modal-overlay').style.display = 'none';
}
</script>

   

</body>
</html>
