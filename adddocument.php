<?php
#header("Location:admin.php");
print_r($_FILES);
try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	//create order if not already created
  $ext = pathinfo($_FILES["doc"]["name"], PATHINFO_EXTENSION);
  $string = str_replace(' ', '', $_POST["title"]);
  $name=$string.".".$ext;
  echo($name);
  if ($_POST['dateofupload']!="") {
    $stmt = $conn->prepare("INSERT INTO TblDocs(DocID,filename,dateadded, type,title)
    VALUES (NULL,:doc,:dou,:type,:title)");
    $stmt->bindParam(':dou', $_POST['dateofupload']);
    
} else {
  $stmt = $conn->prepare("INSERT INTO TblDocs(DocID,filename,dateadded, type,title)
  VALUES (NULL,:doc,DEFAULT,:type,:title)");
  #if no date picked set to upload date
}
    $stmt->bindParam(':type', $_POST["typeofdoc"]);
    $stmt->bindParam(':title', $_POST["title"]);
    $stmt->bindParam(':doc', $name);
    $stmt->execute();
    $target_dir = "documents/";
    #print_r($_FILES);
    $target_file = $target_dir . basename($name);
    #echo $target_file;
    #$uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $name)). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    
}
catch(PDOException $e)
{
    echo "error".$e->getMessage();
}
$conn=null; 
?>