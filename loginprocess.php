<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include_once("connection.php");
array_map("htmlspecialchars", $_POST);

$username = $_POST['clubname'];
$password = $_POST['password'];

// Check in TBLADMIN first
$adminStmt = $conn->prepare("SELECT * FROM tbladmin WHERE username = :username");
$adminStmt->bindParam(':username', $username);
$adminStmt->execute();

$adminFound = false;

if ($adminRow = $adminStmt->fetch(PDO::FETCH_ASSOC)) {

    $hashed = $adminRow['Password'];
    if (password_verify($password, $hashed)) {
        // Admin login successful
        $_SESSION['clubid'] = $adminRow["Username"];
        $_SESSION['adloggedin'] = true;
        header('Location: index.php');
        $adminFound = true;
    }
}

if (!$adminFound) {
    // If not found or password incorrect in TBLADMIN, check in TblClub
    $stmt = $conn->prepare("SELECT * FROM TblClub WHERE Clubname = :club");
    $stmt->bindParam(':club', $username);
    $stmt->execute();

    $userFound = false;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $hashed = $row['Password'];
        if (password_verify($password, $hashed)) {
            // Regular user login successful
            $_SESSION['clubid'] = $row["ClubID"];
            $_SESSION['clubname'] = $row["Clubname"];
            
            header('Location: index.php');
            $userFound = true;
            break; // Exit the loop once a match is found
        }
    }

    if (!$userFound) {
        echo '<script>
            alert("Password is incorrect or user not found!");
            window.history.back();
        </script>';
    }
}

$conn = null;
?>
