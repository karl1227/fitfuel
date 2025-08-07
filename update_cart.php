<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart_item_id'], $_POST['action'])) {
    $user_id = $_SESSION['user_id'];
    $cart_item_id = $_POST['cart_item_id'];
    $action = $_POST['action'];

    $stmt = $conn->prepare("SELECT quantity FROM cart_items WHERE cart_item_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_item_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item) {
        $quantity = $item['quantity'];
        if ($action === 'increase') {
            $quantity++;
        } elseif ($action === 'decrease' && $quantity > 1) {
            $quantity--;
        }

        $update = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_item_id = ? AND user_id = ?");
        $update->bind_param("iii", $quantity, $cart_item_id, $user_id);
        $update->execute();
    }
}

header("Location: cart.php");
exit;
