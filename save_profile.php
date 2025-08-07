<?php
session_start();
include 'database.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['register_id'])) {
    $register_id = $data['register_id'];
    $email = $data['email'] ?? '';
    $telephone = $data['telephone'] ?? '';
    $address = $data['address'] ?? '';
    $dob = $data['dob'] ?? '';

    $stmt = $conn->prepare("UPDATE register SET email = ?, telephone = ?, address = ?, dob = ? WHERE register_id = ?");
    $stmt->bind_param("ssssi", $email, $telephone, $address, $dob, $register_id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Profile updated successfully.']);
    } else {
        echo json_encode(['message' => 'Update failed.']);
    }
} else {
    echo json_encode(['message' => 'Invalid data.']);
}
?>
