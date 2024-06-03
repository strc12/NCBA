
<?php
#header("Location:admin.php");
print_r($_POST);
try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
    $ext = pathinfo($_FILES["imagey"]["name"], PATHINFO_EXTENSION);
    $name = str_replace(' ', '', $_FILES["imagey"]["name"]);
    
   
    
	$stmt = $conn->prepare("INSERT INTO TblImages(ImageID,filename,dateadded,type)VALUES 
    (NULL,:fn, :dateadded,:type)");
    $stmt->bindParam(':fn', $_FILES["imagey"]["name"]);
    $stmt->bindParam(':dateadded', $_POST["dateofupload"]);
    $stmt->bindParam(':type', $_POST["typeofdoc"]);
    $stmt->execute();
    $target_dir = "gallery/";

    $target_file = $target_dir . basename($name);
    echo $target_file;
    
    

   
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["imagey"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["imagey"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    #cropper
    $imagePath = "./gallery/".$name;
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
    
    // Set the desired aspect ratio
    if ($_POST["typeofdoc"]=="Panorama"){
        $targetAspectRatio = 20 / 9;
    }elseif ($_POST["typeofdoc"]=="Landscape"){
        $targetAspectRatio = 4 / 3;
    }elseif ($_POST["typeofdoc"]=="Portrait"){
        $targetAspectRatio = 3 / 4;
    }else{
        $targetAspectRatio = 1 / 1;
    }
    
    // Calculate the new dimensions
    $originalAspectRatio = $originalWidth / $originalHeight;
    echo($originalHeight ." orig ". $originalWidth."<br>");
    if ($originalAspectRatio > $targetAspectRatio) {
        // Original image is wider than target aspect ratio
        $newHeight = $originalHeight;
        $newWidth = $originalHeight * $targetAspectRatio;
        $cropX = ($originalWidth - $newWidth) / 2;
        echo($newHeight ." wide ". $newWidth."<br>");
        #$cropY = 0;
    } 
    if ($originalAspectRatio <= $targetAspectRatio){
        // Original image is taller than target aspect ratio
        $newWidth = $originalWidth;
        $newHeight = $originalWidth / $targetAspectRatio;
        #$cropX = 0;
        $cropY = ($originalHeight - $newHeight) / 2;
        echo($newHeight ." tall ". $newWidth."<br>");
    }
    if (!isset($cropX)){
        $cropX=0;
    }
    if (!isset($cropY)){
        $cropY=0;
    }
    // Create a new image canvas with the new dimensions
    $croppedImage = imagecreatetruecolor($newWidth, $newHeight);
    
    // Copy and resize the original image to the new canvas
    imagecopyresampled($croppedImage, $image, 0, 0, $cropX, $cropY, $newWidth, $newHeight, $newWidth, $newHeight);
    
    // Save or output the cropped image
    $outputPath = "./gallery/".$name;
    imagejpeg($croppedImage, $outputPath, 90);
    
    // Clean up
    imagedestroy($image);
    imagedestroy($croppedImage);
    
    echo "Image cropped and saved to $outputPath";

   
}
catch(PDOException $e)
{
    echo "error".$e->getMessage();
}
$conn=null; 
?>