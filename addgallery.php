<?php
require_once(__DIR__ . '/sessions.php');

print_r($_SESSION);
 if (!isset($_SESSION['adloggedin'])) {
    header("Location:index.php");
    exit;
}else{
    header("Location:admin.php");
}

print_r($_POST);

try {
    include_once('connection.php');
    array_map("htmlspecialchars", $_POST);

    
        $stmt = $conn->prepare("INSERT INTO TblGallery(galleryID, galleryname) VALUES (NULL, :gn)");
        $stmt->bindParam(':gn', $_POST["Album_name"]);
    

    $stmt->execute();

} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}

$conn = null;
?>
