<?php
session_start();
include('database.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$current_user_id = $_SESSION['user_id'];

// Check if logged-in user is admin
$stmt = $conn->prepare("SELECT is_admin FROM user WHERE register_id = ?");
$stmt->bind_param("i", $current_user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if (!$user || $user['is_admin'] != 1) {
    echo "Access denied.";
    exit();
}

// Get the user ID to edit from query parameter
if (!isset($_GET['id'])) {
    header("Location: account.php");
    exit();
}

$edit_user_id = intval($_GET['id']);

// Fetch user data to edit
$stmt = $conn->prepare("SELECT firstname, lastname, email, telephone, address, dob FROM register WHERE register_id = ?");
$stmt->bind_param("i", $edit_user_id);
$stmt->execute();
$result = $stmt->get_result();
$edit_user = $result->fetch_assoc();

if (!$edit_user) {
    echo "User not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $address = $_POST['address'] ?? '';
    $dob = $_POST['dob'] ?? '';

    // Basic validation (you can expand this)
    if (!$firstname || !$lastname || !$email) {
        $error = "Firstname, Lastname, and Email are required.";
    } else {
        $update_stmt = $conn->prepare("UPDATE register SET firstname=?, lastname=?, email=?, telephone=?, address=?, dob=? WHERE register_id=?");
        $update_stmt->bind_param("ssssssi", $firstname, $lastname, $email, $telephone, $address, $dob, $edit_user_id);
        if ($update_stmt->execute()) {
            header("Location: account.php?updated=1");
            exit();
        } else {
            $error = "Failed to update user.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit User</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }

        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 1rem;
        }

        form label {
            display: block;
            margin-bottom: 1rem;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 1rem;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit User ID: <?php echo $edit_user_id; ?></h1>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="post">
            <label>First Name:
                <input type="text" name="firstname" value="<?php echo htmlspecialchars($edit_user['firstname']); ?>" required>
            </label>
            <label>Last Name:
                <input type="text" name="lastname" value="<?php echo htmlspecialchars($edit_user['lastname']); ?>" required>
            </label>
            <label>Email:
                <input type="email" name="email" value="<?php echo htmlspecialchars($edit_user['email']); ?>" required>
            </label>
            <label>Telephone:
                <input type="text" name="telephone" value="<?php echo htmlspecialchars($edit_user['telephone']); ?>">
            </label>
            <label>Address:
                <input type="text" name="address" value="<?php echo htmlspecialchars($edit_user['address']); ?>">
            </label>
            <label>Date of Birth:
                <input type="date" name="dob" value="<?php echo htmlspecialchars($edit_user['dob']); ?>">
            </label>
            <button type="submit">Save Changes</button>
            <a href="account.php">Cancel</a>
        </form>
    </div>
</body>
</html>
