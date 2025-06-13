<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
print_r($_SESSION);
/* if (!isset($_SESSION['adloggedin']))
{
    header("Location:index.php");
}
header("Location:admin.php"); */

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
print_r($_SESSION);

print_r($_FILES);

try {
    $currentDate = date('Y-m-d');
    include_once('connection.php');
    array_map("htmlspecialchars", $_POST);

    // Step 1: Insert the record without the image name
    $stmt = $conn->prepare("INSERT INTO TblNews(NewsID, Heading, Details, Dateadded, Link, Linktext, Picture, Active)
                            VALUES (NULL, :HD, :DET, :DA, :LNK, :LNKT, '', Default)");

    $stmt->bindParam(':HD', $_POST["heading"]);
    $stmt->bindParam(':DET', $_POST["details"]);
    $stmt->bindParam(':DA', $currentDate);
    $stmt->bindParam(':LNK', $_POST["link"]);
    $stmt->bindParam(':LNKT', $_POST["linktext"]);
    $stmt->execute();

    // Step 2: Get the last inserted NewsID
    $newsID = $conn->lastInsertId();

    // Step 3: Rename the uploaded file to match the NewsID
    $ext = pathinfo($_FILES["imagey"]["name"], PATHINFO_EXTENSION);
    $newFileName = $newsID . '.' . $ext;

    $target_dir = "news/";
    $target_file = $target_dir . $newFileName;

    // Step 4: Move the uploaded file
    if (move_uploaded_file($_FILES["imagey"]["tmp_name"], $target_file)) {
        echo "The file has been uploaded as $newFileName.";

        // Step 5: Update the record with the new image name
        $updateStmt = $conn->prepare("UPDATE TblNews SET Picture = :PIC WHERE NewsID = :ID");
        $updateStmt->bindParam(':PIC', $newFileName);
        $updateStmt->bindParam(':ID', $newsID);
        $updateStmt->execute();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}

$conn = null;
?>
