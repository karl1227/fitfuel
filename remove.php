<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit;
}

$cart_item_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_item_id = ? AND user_id = ?");
$stmt->bind_param("ii", $cart_item_id, $user_id);
$stmt->execute();

header("Location: cart.php");
exit;
