
<?php
#header("Location:admin.php");
print_r($_POST);
try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	//create order if not already created
    

	
	$stmt = $conn->prepare("INSERT INTO TblCommittee(comitteeID,Name,Post, Pic)
    VALUES (NULL,:name,:post,:pic)");
    $stmt->bindParam(':name', $_POST["name"]);
    $stmt->bindParam(':post', $_POST["post"]);
    $stmt->bindParam(':pic', $_FILES["comm"]["name"]);
    $stmt->execute();
    $target_dir = "comm/";
    #print_r($_FILES);
    $target_file = $target_dir . basename($_FILES["comm"]["name"]);
    #echo $target_file;
    #$uploadOk = 1;
    

    echo("<img src-".$_FILES["comm"]["name"]."><br>");
    echo("<img src-".$_FILES["comm"]["name"]."><br>");  
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["comm"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["comm"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    #thumbnail creator
    // load your source image
    $bigim="./comm/".$_FILES["comm"]["name"];

//Your Image

//getting the image dimensions
list($width, $height) = getimagesize($bigim);

//saving the image into memory (for manipulation with GD Library)
$myImage = imagecreatefromjpeg($bigim);

// calculating the part of the image to use for thumbnail
if ($width > $height) {
  $y = 0;
  $x = ($width - $height) / 2;
  $smallestheight = $height;

  $v = 0;
  $w = ($height - $width) / 2;
  $smallestwidth = $width;
}

// copying the part into thumbnail
$thumbwidth = 200;
$thumbheight= 300;
$thumb = imagecreatetruecolor($thumbwidth,$thumbheight );
imagecopyresampled($thumb, $myImage, 0, 0, $x, $y,  $thumbwidth, $thumbheight, $smallestwidth, $smallestheight);

//final output
#header('Content-type: image/jpeg');
imagejpeg($thumb,$bigim);
}
catch(PDOException $e)
{
    echo "error".$e->getMessage();
}
$conn=null; 
?>