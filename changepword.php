<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
include_once 'connection.php'; // Make sure this file contains your PDO connection setup

// Check if the user is logged in
if (!isset($_SESSION['clubid'])) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['OldPword'];
    $newPassword = $_POST['NewPword'];
    
    print_r($_POST);
    // Fetch the current password hash from the database
    $userId = $_SESSION['clubid'];
    $stmt = $conn->prepare("SELECT password FROM tblclub WHERE ClubID = :id");
    $stmt->execute([':id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($currentPassword, $user['password'])) {
        
        echo '<script>
            alert("Current password is incorrect!");
            window.history.back();
        </script>'; 
        exit;
    }

    // Update the password in the database
    $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE tblclub SET Password = :password WHERE ClubID = :id");
    $stmt->execute([':password' => $newPasswordHash, ':id' => $userId]);

    echo '<script>
        alert("Password changed successfully!");
        setTimeout(function() {
            window.location.href = "index.php"; // Redirect to a profile page or wherever you want
        }, 1000);
    </script>';
}
?>
