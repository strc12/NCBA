<?php
require_once(__DIR__ . '/sessions.php');


include_once("connection.php");
array_map("htmlspecialchars", $_POST);

$username = $_POST['clubname'];
$password = $_POST['password'];

// Check in TBLADMIN first
$adminStmt = $conn->prepare("SELECT * FROM TblAdmin WHERE Username = :username");
$adminStmt->bindParam(':username', $username);
$adminStmt->execute();

$adminFound = false;

if ($adminRow = $adminStmt->fetch(PDO::FETCH_ASSOC)) {
    #print_r($adminRow);
    $hashed = $adminRow['Password'];
    #echo($hashed);
    if (password_verify($password, $hashed)) {
        // Admin login successful
        $_SESSION['clubid'] = $adminRow["Username"];
        $_SESSION['adloggedin'] = true;
        
        header("Location: " . dirname($_SERVER['PHP_SELF']) . "/index.php");
        exit;
    
       
        $adminFound = true;
    }
}
echo($adminFound);
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
            $_SESSION['promrel']=0;
            #print_r($_SESSION);
            #echo("SD");
            header("Location: " . dirname($_SERVER['PHP_SELF']) . "/index.php");
            exit;
            
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
