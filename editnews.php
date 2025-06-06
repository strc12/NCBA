<?php
session_start();

include_once("connection.php");
array_map("htmlspecialchars", $_POST);
$current = isset($_POST['active']) ? 1 : 0;

print_r($_POST);
print_r($_SESSION);
print_r($_FILES);
echo $current;

// Get file extension
$ext = pathinfo($_FILES["imagey"]["name"], PATHINFO_EXTENSION);

// Prepare the base SQL for update
$sql = "UPDATE TblNews SET Heading = :HD, Details = :DET, Link = :LK, Linktext = :LINKT, Active = :ACT";
$params = [
    ':HD' => $_POST['heading'],
    ':DET' => $_POST['details'],
    ':LK' => $_POST['link'],
    ':LINKT' => $_POST['linktext'],
    ':ACT' => $current,
    ':id' => $_POST['id']
];

// If a new image is uploaded, rename it to NewsID + extension and update DB accordingly
if (!empty($_FILES["imagey"]["name"])) {
    $newsId = $_POST['id'];
    $newFileName = $newsId . '.' . $ext;
    $target_dir = "news/";
    $target_file = $target_dir . $newFileName;

    // Move uploaded file to the new location with new filename
    if (move_uploaded_file($_FILES["imagey"]["tmp_name"], $target_file)) {
        echo "The file has been uploaded as $newFileName.<br>";
        // Add Picture field update to SQL and parameters
        $sql .= ", Picture = :PIC";
        $params[':PIC'] = $newFileName;
    } else {
        echo "Sorry, there was an error uploading your file.";
        // Optionally, handle error or exit here
    }
}

$sql .= " WHERE NewsID = :id";

$stmt = $conn->prepare($sql);
$stmt->execute($params);

// Redirect logic
$redirectUrl = isset($_SESSION['adloggedin']) ? "admin.php" : "clubadmin.php";

echo "<script>
    alert('News Item Updated');
    window.location.href='$redirectUrl';
</script>";
?>
