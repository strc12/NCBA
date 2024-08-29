
<?php
#header("Location:admin.php");
print_r($_POST);
try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	//create order if not already created
   print_r($_FILES["comm"]); 
   $string = str_replace(' ', '', $_POST["name"]);
if ($_FILES["comm"]["name"]==""){
  $name="genericicon.jpg";
}else{
	$name=$string.".jpg";
}
print($name);
	$stmt = $conn->prepare("INSERT INTO TblCommittee(CommitteeID,Name,Post, Pic)
    VALUES (NULL,:name,:post,:pic)");
    $stmt->bindParam(':name', $_POST["name"]);
    $stmt->bindParam(':post', $_POST["post"]);
    $stmt->bindParam(':pic', $name);
    $stmt->execute();
    $target_dir = "comm/";
    #print_r($_FILES);
    $target_file = $target_dir . basename($name);
    echo $target_file;
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
    $bigim="./comm/".$name;
Echo($bigim);
//getting the image dimensions
list($width, $height) = getimagesize($bigim);

//saving the image into memory (for manipulation with GD Library)
$myImage = imagecreatefromjpeg($bigim);

// calculating the part of the image to use for thumbnail
if ($width > $height) {
  $y = 0;
  $x = ($width - $height) / 2;
  $smallestSide = $height;
} else {
  $x = 0;
  $y = ($height - $width) / 2;
  $smallestSide = $width;
}

// copying the part into thumbnail
$thumbSize = 300;
$thumb = imagecreatetruecolor($thumbSize, $thumbSize);
imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

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