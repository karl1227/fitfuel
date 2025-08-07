<?php
session_start();
include("database.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user and product data
$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];  // Must come from a form input (see Step 2)
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

// Check if product is already in cart — if yes, just update quantity
$checkSql = "SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($checkSql);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing item
    $updateSql = "UPDATE cart_items SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("iii", $quantity, $user_id, $product_id);
    $stmt->execute();
} else {
    // Insert new item
    $insertSql = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    $stmt->execute();
}

// Redirect back to shop or product page
header("Location: shop.php?success=1");
exit();
?>
