<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }

include_once ("connection.php");
array_map("htmlspecialchars", $_POST);
print_r($_POST);




$stmt = $conn->prepare("SELECT * FROM TblClub WHERE Clubname =:club ;" );
$stmt->bindParam(':club', $_POST['clubname']);

$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $hashed= $row['Password'];
    $attempt= $_POST['password'];
    echo($attempt);
    echo($hashed);
    if(password_verify($attempt,$hashed)){
        $_SESSION['clubid']=$row["ClubID"];
        $_SESSION['clubname']=$row["Clubname"];
        
        header('Location: index.php');
    }else{
        echo '<script>
        alert("Password is incorrect!");
        window.history.back();
    </script>';
        
    }
}
$conn=null;
//header('Location: index.php');

?>
