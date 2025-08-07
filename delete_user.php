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

if (!isset($_GET['id'])) {
    header("Location: account.php");
    exit();
}

$delete_user_id = intval($_GET['id']);

// Prevent admin deleting themselves
if ($delete_user_id === $current_user_id) {
    header("Location: account.php?error=cant_delete_self");
    exit();
}

// Delete user from 'register' table (consider also deleting from 'user' if FK exists or on cascade)
$stmt = $conn->prepare("DELETE FROM register WHERE register_id = ?");
$stmt->bind_param("i", $delete_user_id);
if ($stmt->execute()) {
    header("Location: account.php?deleted=1");
    exit();
} else {
    header("Location: account.php?error=delete_failed");
    exit();
}
