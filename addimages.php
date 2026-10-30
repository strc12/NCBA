<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
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

    $ext = pathinfo($_FILES["imagey"]["name"], PATHINFO_EXTENSION);
    
    // Insert record with temporary filename (can be blank or original name)
    if ($_POST['dateofupload'] != "") {
        $stmt = $conn->prepare("INSERT INTO TblImages(ImageID, filename, dateadded, description, type, current) VALUES (NULL, :fn, :dateadded, :desc, :type, DEFAULT)");
        $stmt->bindParam(':fn', $_FILES["imagey"]["name"]); // temporary name
        $stmt->bindParam(':dateadded', $_POST["dateofupload"]);
        $stmt->bindParam(':desc', $_POST["desc"]);
        $stmt->bindParam(':type', $_POST["typeofdoc"]);
    } else {
        $stmt = $conn->prepare("INSERT INTO TblImages(ImageID, filename, dateadded, description, type, current) VALUES (NULL, :fn, DEFAULT, :desc, :type, DEFAULT)");
        $stmt->bindParam(':fn', $_FILES["imagey"]["name"]);
        $stmt->bindParam(':desc', $_POST["desc"]);
        $stmt->bindParam(':type', $_POST["typeofdoc"]);
    }

    $stmt->execute();

    // Get last inserted ID
    $lastId = $conn->lastInsertId();

    // Create new filename: lastId.ext
    $newFileName = $lastId . '.' . $ext;

    $target_dir = "gallery/";
    $target_file = $target_dir . $newFileName;

    // Move the uploaded file to gallery folder with the new filename
    if (move_uploaded_file($_FILES["imagey"]["tmp_name"], $target_file)) {
        echo "The file has been uploaded as $newFileName.<br>";
    } else {
        die("Sorry, there was an error uploading your file.");
    }

    // Update database with the new filename
    $updateStmt = $conn->prepare("UPDATE TblImages SET filename = :fn WHERE ImageID = :id");
    $updateStmt->bindParam(':fn', $newFileName);
    $updateStmt->bindParam(':id', $lastId);
    $updateStmt->execute();

    #cropper
    $imagePath = "./gallery/" . $newFileName;
    list($originalWidth, $originalHeight, $imageType) = getimagesize($imagePath);

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($imagePath);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($imagePath);
            break;
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($imagePath);
            break;
        default:
            die('Unsupported image type');
    }

    // Set the desired aspect ratio and sizes
    if ($_POST["typeofdoc"] == "Panorama") {
        $targetAspectRatio = 20 / 9;
        $widthn = 1000;
        $heightn = 450;
    } elseif ($_POST["typeofdoc"] == "Landscape") {
        $targetAspectRatio = 4 / 3;
        $widthn = 800;
        $heightn = 600;
    } elseif ($_POST["typeofdoc"] == "Portrait") {
        $targetAspectRatio = 3 / 4;
        $widthn = 600;
        $heightn = 800;
    } else {
        $targetAspectRatio = 1 / 1;
        $widthn = 800;
        $heightn = 800;
    }

    // Calculate new crop dimensions
    $originalAspectRatio = $originalWidth / $originalHeight;
    echo($originalHeight . " orig " . $originalWidth . "<br>");
    if ($originalAspectRatio > $targetAspectRatio) {
        $newHeight = $originalHeight;
        $newWidth = $originalHeight * $targetAspectRatio;
        $cropX = ($originalWidth - $newWidth) / 2;
    } else {
        $newWidth = $originalWidth;
        $newHeight = $originalWidth / $targetAspectRatio;
        $cropY = ($originalHeight - $newHeight) / 2;
    }
    if (!isset($cropX)) {
        $cropX = 0;
    }
    if (!isset($cropY)) {
        $cropY = 0;
    }

    $croppedImage = imagecreatetruecolor($widthn, $heightn);
    imagecopyresampled($croppedImage, $image, 0, 0, $cropX, $cropY, $widthn, $heightn, $newWidth, $newHeight);
    imagejpeg($croppedImage, $imagePath, 90);

    imagedestroy($image);
    imagedestroy($croppedImage);

    echo "Image cropped and saved to $imagePath";

} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}

$conn = null;
?>
