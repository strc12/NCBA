<?php
header("Location:admin.php");
print_r($_POST);
try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	//create order if not already created
    

	
	$stmt = $conn->prepare("INSERT INTO TblDocs(DocID,filename,dateadded, type)
    VALUES (NULL,:doc,:dou,:type)");
    $stmt->bindParam(':type', $_POST["typeofdoc"]);
    $stmt->bindParam(':dou', $_POST["dateofupload"]);
    $stmt->bindParam(':doc', $_FILES["doc"]["name"]);
    $stmt->execute();
    $target_dir = "documents/";
    #print_r($_FILES);
    $target_file = $target_dir . basename($_FILES["doc"]["name"]);
    #echo $target_file;
    #$uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["doc"]["name"])). " has been uploaded.";
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