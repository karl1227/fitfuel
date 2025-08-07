<?php
session_start();
// Clear all session data
session_unset();
session_destroy();

// Redirect to login page or homepage after logout
header("Location: index.php");
exit;
?>
