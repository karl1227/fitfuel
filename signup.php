<?php
session_start();


include("database.php");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into register table
        $stmt = $conn->prepare("INSERT INTO register (firstname, lastname, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $firstname, $lastname, $email);
        if ($stmt->execute()) {
            $register_id = $stmt->insert_id;

            // Insert into user table
            $stmt2 = $conn->prepare("INSERT INTO user (username, password, register_id) VALUES (?, ?, ?)");
            $stmt2->bind_param("ssi", $username, $hashed_password, $register_id);

            if ($stmt2->execute()) {
                $_SESSION['user_id'] = $stmt2->insert_id;
                $_SESSION['username'] = $username;
                 $_SESSION['firstname'] = $firstname;

                 echo 
                "<script>
                alert('Successfully created an account');
                window.location.href = 'login.php';
                </script>";
                exit();

                header("Location: login.php");
                exit();
            } else {
                $error = "Error creating user: " . $stmt2->error;
            }
        } else {
            $error = "Error creating account: " . $stmt->error;
        }
    }
}
?>

<!-- HTML STARTS HERE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Signup</title>
    <link rel="icon" href="imgs/FFLogoB.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Cousine:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/root.css" />
    <link rel="stylesheet" href="css/signup.css" />


    <style>
        body {
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-image: url('imgs/LS.png');
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-col">
            <div class="img-con">
                <img src="imgs/ITFUEL2.png" alt="" />
            </div>
            <h3>
                Join the movement, <br>
                discover premium supplements, <br>
                fuel your goals, <br>
                and elevate your performance.
            </h3>
            <div class="con-social">
                <h2>Connect with us</h2>
                <div class="soc-imgs">
                    <li><a href="#"><img src="imgs/social/facebook.png" alt="facebook logo" /></a></li>
                    <li><a href="#"><img src="imgs/social/google.png" alt="google logo" /></a></li>
                    <li><a href="#"><img src="imgs/social/instagram.png" alt="instagram logo" /></a></li>
                    <li><a href="#"><img src="imgs/social/tiktok.png" alt="tiktok logo" /></a></li>
                </div>
            </div>
        </div>

        <div class="right-col">
            <form action="signup.php" method="POST">
                <h1>Signup</h1>

                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <input type="text" name="firstname" placeholder="Firstname" required /><br>
                <input type="text" name="lastname" placeholder="Lastname" required /><br>
                <input type="text" name="username" placeholder="Username" required /><br>
                <input type="email" name="email" placeholder="Email Address" required /><br>
                <input type="password" name="password" placeholder="Password" required /><br>
                <input type="password" name="confirm-password" placeholder="Confirm Password" required /><br>

                <div class="cb-sec">
                    <div class="cb-left">
                        <input type="checkbox" class="checkbox" required />
                        <p>I agree to the <a href="#">Terms of Service</a> & <a href="#">Privacy Policy</a></p>
                    </div>
                </div>

                <div class="btn-container">
                    <button type="submit">SIGNUP</button>
                </div>

                <p class="sign-text">
                    Already have an account? <a href="login.php"><b><span>Login</span></b></a>
                </p><br>
            </form>
        </div>
    </div>
</body>
</html>

